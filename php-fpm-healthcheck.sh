#!/bin/bash
# PHP-FPM Healthcheck script
# Check if PHP-FPM is listening on port 9000

# Check if port 9000 is listening
if command -v nc >/dev/null 2>&1; then
    if nc -z localhost 9000 2>/dev/null; then
        exit 0
    fi
fi

# Fallback: check if PHP-FPM process exists using ps
if ps aux | grep -q "[p]hp-fpm: master process"; then
    exit 0
fi

exit 1

