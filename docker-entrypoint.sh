#!/bin/bash
# Don't exit on error - we want the Laravel server to start even if some commands fail
set +e

# Quick essential setup
echo "Initializing..."

# Set critical permissions first (fast)
chmod -R 775 /var/www/storage /var/www/bootstrap/cache 2>/dev/null || true

# Fix Git ownership if needed
[ -d "/var/www/.git" ] && git config --global --add safe.directory /var/www 2>/dev/null || true

# Check vendor - install if missing (but don't block)
if [ ! -d "/var/www/vendor" ] || [ ! -f "/var/www/vendor/autoload.php" ]; then
    echo "Installing Composer dependencies..."
    composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts 2>&1 | head -20
fi

# Ensure .env exists
[ ! -f "/var/www/.env" ] && {
    [ -f "/var/www/.env.example" ] && cp /var/www/.env.example /var/www/.env 2>/dev/null || touch /var/www/.env 2>/dev/null
}

# Generate APP_KEY if missing or invalid
if [ -f "/var/www/vendor/autoload.php" ]; then
    # Check if APP_KEY exists and is valid (starts with base64: and has proper length)
    APP_KEY_VALUE=$(grep "^APP_KEY=" /var/www/.env 2>/dev/null | cut -d '=' -f2- | tr -d '[:space:]')
    
    # Check for duplicate base64: prefixes (multiple keys concatenated)
    BASE64_COUNT=$(echo "$APP_KEY_VALUE" 2>/dev/null | grep -o "base64:" | wc -l)
    
    # If APP_KEY is missing, empty, doesn't start with base64:, or has duplicates, remove it and generate new one
    if [ -z "$APP_KEY_VALUE" ] || [[ ! "$APP_KEY_VALUE" =~ ^base64: ]] || [ "$BASE64_COUNT" -gt 1 ] || [[ "$APP_KEY_VALUE" =~ base64:.*base64: ]]; then
        echo "APP_KEY is missing, invalid, or contains duplicates, removing old value and generating new one..."
        # Remove any existing invalid APP_KEY line
        sed -i '/^APP_KEY=/d' /var/www/.env 2>/dev/null || true
        # Clear config cache before generating (important!)
        php artisan config:clear 2>/dev/null || true
        # Generate new key
        php artisan key:generate --force 2>&1
        # Clear config cache again after generating (critical!)
        php artisan config:clear 2>/dev/null || true
        # Verify it was set correctly
        APP_KEY_VALUE=$(grep "^APP_KEY=" /var/www/.env 2>/dev/null | cut -d '=' -f2- | tr -d '[:space:]')
        if [ -z "$APP_KEY_VALUE" ] || [[ ! "$APP_KEY_VALUE" =~ ^base64: ]]; then
            echo "Warning: APP_KEY generation may have failed. Please run 'php artisan key:generate' manually."
        else
            echo "APP_KEY generated successfully"
        fi
    else
        # Validate key length (base64: prefix + 44 chars for 32 bytes = 50 chars minimum, max ~100 for safety)
        KEY_LENGTH=${#APP_KEY_VALUE}
        if [ "$KEY_LENGTH" -lt 50 ] || [ "$KEY_LENGTH" -gt 200 ]; then
            echo "APP_KEY appears invalid (length: ${KEY_LENGTH} chars, expected 50-100), removing and regenerating..."
            sed -i '/^APP_KEY=/d' /var/www/.env 2>/dev/null || true
            php artisan config:clear 2>/dev/null || true
            php artisan key:generate --force 2>&1 || true
            php artisan config:clear 2>/dev/null || true
        else
            echo "APP_KEY is set and appears valid (${KEY_LENGTH} chars)"
        fi
    fi
fi

# Start Laravel development server on port 6700
echo "Starting Laravel development server on port 6700..."
exec php artisan serve --host=0.0.0.0 --port=6700
