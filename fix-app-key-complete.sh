#!/bin/bash
# Complete APP_KEY fix script with diagnostics
# Usage: ./fix-app-key-complete.sh

set -e

echo "=========================================="
echo "  Laravel APP_KEY Complete Fix Script"
echo "=========================================="
echo ""

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: This script must be run from the Laravel root directory"
    exit 1
fi

# Step 1: Check .env file
echo "Step 1: Checking .env file..."
if [ ! -f ".env" ]; then
    echo "  ⚠️  .env file not found!"
    if [ -f ".env.example" ]; then
        echo "  📋 Copying .env.example to .env..."
        cp .env.example .env
    else
        echo "  📝 Creating new .env file..."
        touch .env
    fi
else
    echo "  ✅ .env file exists"
fi

# Step 2: Backup current .env
echo ""
echo "Step 2: Creating backup..."
cp .env .env.backup.$(date +%Y%m%d_%H%M%S) 2>/dev/null || true
echo "  ✅ Backup created"

# Step 3: Check current APP_KEY
echo ""
echo "Step 3: Analyzing current APP_KEY..."
APP_KEY_LINE=$(grep "^APP_KEY=" .env 2>/dev/null || echo "")
if [ -z "$APP_KEY_LINE" ]; then
    echo "  ❌ APP_KEY is not set"
    NEEDS_FIX=true
else
    APP_KEY_VALUE=$(echo "$APP_KEY_LINE" | cut -d '=' -f2- | tr -d '[:space:]')
    KEY_LENGTH=${#APP_KEY_VALUE}
    echo "  📋 Current APP_KEY: ${APP_KEY_LINE:0:60}..."
    echo "  📏 Length: ${KEY_LENGTH} characters"
    
    # Check for multiple base64: prefixes
    BASE64_COUNT=$(echo "$APP_KEY_VALUE" | grep -o "base64:" | wc -l)
    
    if [ "$BASE64_COUNT" -gt 1 ]; then
        echo "  ❌ Multiple 'base64:' prefixes detected (duplicate keys)"
        NEEDS_FIX=true
    elif [[ ! "$APP_KEY_VALUE" =~ ^base64: ]]; then
        echo "  ❌ Invalid format (should start with 'base64:')"
        NEEDS_FIX=true
    elif [ "$KEY_LENGTH" -lt 50 ]; then
        echo "  ❌ Too short (minimum 50 characters)"
        NEEDS_FIX=true
    elif [ "$KEY_LENGTH" -gt 200 ]; then
        echo "  ❌ Too long (may contain duplicates)"
        NEEDS_FIX=true
    elif [[ "$APP_KEY_VALUE" =~ base64:.*base64: ]]; then
        echo "  ❌ Contains duplicate 'base64:' prefix"
        NEEDS_FIX=true
    else
        echo "  ✅ APP_KEY format appears valid"
        NEEDS_FIX=false
    fi
fi

# Step 4: Fix APP_KEY if needed
if [ "$NEEDS_FIX" = true ]; then
    echo ""
    echo "Step 4: Fixing APP_KEY..."
    
    # Remove any existing APP_KEY line
    echo "  🗑️  Removing invalid APP_KEY..."
    sed -i '/^APP_KEY=/d' .env 2>/dev/null || true
    
    # Clear config cache
    echo "  🧹 Clearing config cache..."
    php artisan config:clear 2>/dev/null || true
    
    # Generate new key
    echo "  🔑 Generating new APP_KEY..."
    if php artisan key:generate --force 2>&1; then
        echo "  ✅ Key generation command executed"
    else
        echo "  ⚠️  Artisan command had issues, trying alternative..."
        # Fallback: manual generation
        if command -v openssl >/dev/null 2>&1; then
            NEW_KEY=$(openssl rand -base64 32 | tr -d '\n')
            if grep -q "^APP_KEY=" .env 2>/dev/null; then
                sed -i "s|^APP_KEY=.*|APP_KEY=base64:${NEW_KEY}|" .env
            else
                echo "APP_KEY=base64:${NEW_KEY}" >> .env
            fi
            echo "  ✅ Key generated manually using openssl"
        else
            echo "  ❌ Cannot generate key: openssl not available"
            exit 1
        fi
    fi
else
    echo ""
    echo "Step 4: APP_KEY appears valid, skipping generation"
fi

# Step 5: Verify new APP_KEY
echo ""
echo "Step 5: Verifying APP_KEY..."
NEW_APP_KEY_LINE=$(grep "^APP_KEY=" .env 2>/dev/null || echo "")
if [ -z "$NEW_APP_KEY_LINE" ]; then
    echo "  ❌ APP_KEY is still not set!"
    echo ""
    echo "  Manual fix required:"
    echo "  1. Open .env file"
    echo "  2. Add line: APP_KEY="
    echo "  3. Run: php artisan key:generate --force"
    exit 1
fi

NEW_APP_KEY_VALUE=$(echo "$NEW_APP_KEY_LINE" | cut -d '=' -f2- | tr -d '[:space:]')
NEW_KEY_LENGTH=${#NEW_APP_KEY_VALUE}

if [[ ! "$NEW_APP_KEY_VALUE" =~ ^base64: ]]; then
    echo "  ❌ Generated APP_KEY has invalid format"
    echo "  Current value: ${NEW_APP_KEY_LINE:0:60}..."
    exit 1
elif [ "$NEW_KEY_LENGTH" -lt 50 ] || [ "$NEW_KEY_LENGTH" -gt 200 ]; then
    echo "  ❌ Generated APP_KEY has invalid length: ${NEW_KEY_LENGTH}"
    exit 1
else
    echo "  ✅ APP_KEY is valid!"
    echo "     Format: base64:..."
    echo "     Length: ${NEW_KEY_LENGTH} characters"
    echo ""
    echo "  📋 APP_KEY value:"
    echo "     ${NEW_APP_KEY_LINE:0:80}..."
fi

# Step 6: Clear all caches
echo ""
echo "Step 6: Clearing all caches..."
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
echo "  ✅ All caches cleared"

# Step 7: Test configuration
echo ""
echo "Step 7: Testing configuration..."
if php artisan tinker --execute="echo config('app.key') ? 'OK' : 'FAIL';" 2>/dev/null | grep -q "OK"; then
    echo "  ✅ Configuration test passed"
else
    echo "  ⚠️  Configuration test had issues (this may be normal)"
fi

echo ""
echo "=========================================="
echo "  ✅ APP_KEY fix completed!"
echo "=========================================="
echo ""
echo "Next steps:"
echo "  1. Restart your application:"
echo "     docker-compose restart app"
echo "     or"
echo "     docker restart v75_app"
echo ""
echo "  2. If errors persist, check:"
echo "     - File permissions on .env"
echo "     - That .env is being read correctly"
echo "     - Application logs for other errors"
echo ""

