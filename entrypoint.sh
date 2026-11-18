#!/bin/bash

# Run migrations
# The --force flag is needed for production environments
php artisan migrate --force
php artisan db:seed --force

# Start the main process (supervisord)
exec "$@"