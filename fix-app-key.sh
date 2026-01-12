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
else
    APP_KEY_VALUE=$(echo "$APP_KEY_LINE" | cut -d '=' -f2- | tr -d '[:space:]')
    KEY_LENGTH=${#APP_KEY_VALUE}
    echo "  APP_KEY found: ${APP_KEY_LINE:0:20}..."
    echo "  Length: ${KEY_LENGTH} characters"
    
    if [[ ! "$APP_KEY_VALUE" =~ ^base64: ]]; then
        echo "  ❌ APP_KEY format is invalid (should start with 'base64:')"
    elif [ "$KEY_LENGTH" -lt 50 ]; then
        echo "  ❌ APP_KEY is too short (should be at least 50 characters)"
    else
        echo "  ✅ APP_KEY appears valid"
        echo ""
        echo "If you're still experiencing errors, try regenerating the key:"
        echo "  php artisan key:generate --force"
        exit 0
    fi
fi

echo ""
echo "Generating new APP_KEY..."
php artisan key:generate --force

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

