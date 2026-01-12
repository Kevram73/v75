#!/bin/bash
# Script to fix APP_KEY issues on production server
# Usage: ./fix-app-key.sh

set -e

echo "=== Laravel APP_KEY Fix Script ==="
echo ""

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "Error: This script must be run from the Laravel root directory"
    exit 1
fi

# Check if .env exists
if [ ! -f ".env" ]; then
    echo "Error: .env file not found!"
    if [ -f ".env.example" ]; then
        echo "Copying .env.example to .env..."
        cp .env.example .env
    else
        echo "Creating new .env file..."
        touch .env
    fi
fi

# Check current APP_KEY
echo "Current APP_KEY status:"
APP_KEY_LINE=$(grep "^APP_KEY=" .env 2>/dev/null || echo "")
if [ -z "$APP_KEY_LINE" ]; then
    echo "  ❌ APP_KEY is not set"
    NEEDS_FIX=true
else
    APP_KEY_VALUE=$(echo "$APP_KEY_LINE" | cut -d '=' -f2- | tr -d '[:space:]')
    KEY_LENGTH=${#APP_KEY_VALUE}
    echo "  APP_KEY found: ${APP_KEY_LINE:0:50}..."
    echo "  Length: ${KEY_LENGTH} characters"
    
    # Check for multiple base64: prefixes (duplicate keys concatenated)
    BASE64_COUNT=$(echo "$APP_KEY_VALUE" | grep -o "base64:" | wc -l)
    if [ "$BASE64_COUNT" -gt 1 ]; then
        echo "  ❌ APP_KEY contains multiple 'base64:' prefixes (duplicate keys detected)"
        echo "  Removing invalid APP_KEY line..."
        sed -i '/^APP_KEY=/d' .env
        NEEDS_FIX=true
    elif [[ ! "$APP_KEY_VALUE" =~ ^base64: ]]; then
        echo "  ❌ APP_KEY format is invalid (should start with 'base64:')"
        echo "  Removing invalid APP_KEY line..."
        sed -i '/^APP_KEY=/d' .env
        NEEDS_FIX=true
    elif [ "$KEY_LENGTH" -lt 50 ]; then
        echo "  ❌ APP_KEY is too short (should be at least 50 characters)"
        echo "  Removing invalid APP_KEY line..."
        sed -i '/^APP_KEY=/d' .env
        NEEDS_FIX=true
    elif [ "$KEY_LENGTH" -gt 200 ]; then
        echo "  ❌ APP_KEY is too long (may contain duplicate keys)"
        echo "  Removing invalid APP_KEY line..."
        sed -i '/^APP_KEY=/d' .env
        NEEDS_FIX=true
    else
        # Additional validation: check that there's only one base64: and it's at the start
        if [[ "$APP_KEY_VALUE" =~ base64:.*base64: ]]; then
            echo "  ❌ APP_KEY contains duplicate 'base64:' prefix"
            echo "  Removing invalid APP_KEY line..."
            sed -i '/^APP_KEY=/d' .env
            NEEDS_FIX=true
        else
            echo "  ✅ APP_KEY appears valid"
            echo ""
            echo "If you're still experiencing errors, try regenerating the key:"
            echo "  php artisan key:generate --force"
            exit 0
        fi
    fi
fi

if [ "$NEEDS_FIX" = true ]; then
    echo ""
    echo "Generating new APP_KEY..."
    php artisan key:generate --force
    
    # If artisan fails, try manual generation
    if [ $? -ne 0 ]; then
        echo "  Artisan command failed, trying alternative method..."
        # Generate a 32-byte key and encode it
        if command -v openssl >/dev/null 2>&1; then
            NEW_KEY=$(openssl rand -base64 32 | tr -d '\n')
            if grep -q "^APP_KEY=" .env 2>/dev/null; then
                sed -i "s|^APP_KEY=.*|APP_KEY=base64:${NEW_KEY}|" .env
            else
                echo "APP_KEY=base64:${NEW_KEY}" >> .env
            fi
            echo "  ✅ APP_KEY generated manually"
        else
            echo "  ❌ Cannot generate key: openssl not available"
            exit 1
        fi
    fi
fi

# Verify the new key
echo ""
echo "Verifying new APP_KEY..."
NEW_APP_KEY=$(grep "^APP_KEY=" .env | cut -d '=' -f2- | tr -d '[:space:]')
if [ -z "$NEW_APP_KEY" ]; then
    echo "  ❌ Failed to generate APP_KEY"
    exit 1
elif [[ ! "$NEW_APP_KEY" =~ ^base64: ]]; then
    echo "  ❌ Generated APP_KEY has invalid format"
    exit 1
else
    NEW_KEY_LENGTH=${#NEW_APP_KEY}
    echo "  ✅ APP_KEY generated successfully"
    echo "  Format: base64:..."
    echo "  Length: ${NEW_KEY_LENGTH} characters"
    echo ""
    echo "APP_KEY has been fixed! Please restart your application."
fi

