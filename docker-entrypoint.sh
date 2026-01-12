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

# Generate APP_KEY if missing (quick)
[ -f "/var/www/vendor/autoload.php" ] && ! grep -q "^APP_KEY=base64:" /var/www/.env 2>/dev/null && \
    php artisan key:generate --force 2>/dev/null || true

# Start Laravel development server on port 6700
echo "Starting Laravel development server on port 6700..."
exec php artisan serve --host=0.0.0.0 --port=6700
