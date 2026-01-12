#!/bin/bash
# Quick script to generate APP_KEY
# Usage: ./generate-key.sh

set -e

echo "Generating APP_KEY..."

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "Error: This script must be run from the Laravel root directory"
    exit 1
fi

# Remove any existing APP_KEY line
echo "Removing any existing APP_KEY..."
sed -i '/^APP_KEY=/d' .env 2>/dev/null || true

# Generate new key
echo "Generating new APP_KEY..."
php artisan key:generate --force

# Verify
echo ""
echo "Verifying APP_KEY..."
APP_KEY=$(grep "^APP_KEY=" .env | cut -d '=' -f2- | tr -d '[:space:]')
if [ -z "$APP_KEY" ]; then
    echo "❌ Failed to generate APP_KEY"
    exit 1
elif [[ ! "$APP_KEY" =~ ^base64: ]]; then
    echo "❌ Generated APP_KEY has invalid format"
    exit 1
else
    KEY_LENGTH=${#APP_KEY}
    echo "✅ APP_KEY generated successfully!"
    echo "   Format: base64:..."
    echo "   Length: ${KEY_LENGTH} characters"
    echo ""
    echo "APP_KEY value:"
    grep "^APP_KEY=" .env
fi

