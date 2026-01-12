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
    
    # If APP_KEY is missing, empty, or doesn't start with base64:, generate it
    if [ -z "$APP_KEY_VALUE" ] || [[ ! "$APP_KEY_VALUE" =~ ^base64: ]]; then
        echo "Generating APP_KEY..."
        php artisan key:generate --force 2>&1
        # Verify it was set correctly
        APP_KEY_VALUE=$(grep "^APP_KEY=" /var/www/.env 2>/dev/null | cut -d '=' -f2- | tr -d '[:space:]')
        if [ -z "$APP_KEY_VALUE" ] || [[ ! "$APP_KEY_VALUE" =~ ^base64: ]]; then
            echo "Warning: APP_KEY generation may have failed. Please run 'php artisan key:generate' manually."
        fi
    else
        # Validate key length (base64: prefix + 44 chars for 32 bytes = 50 chars minimum)
        KEY_LENGTH=${#APP_KEY_VALUE}
        if [ "$KEY_LENGTH" -lt 50 ]; then
            echo "APP_KEY appears invalid (too short: ${KEY_LENGTH} chars), regenerating..."
            php artisan key:generate --force 2>&1 || true
        else
            echo "APP_KEY is set and appears valid (${KEY_LENGTH} chars)"
        fi
    fi
fi

# Start Laravel development server on port 6700
echo "Starting Laravel development server on port 6700..."
exec php artisan serve --host=0.0.0.0 --port=6700
