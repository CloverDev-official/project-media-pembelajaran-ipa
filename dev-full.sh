#!/bin/bash

# Start Vite dev server in background
echo "Starting Vite development server..."
npm run dev &

echo "starting php artisan serve..."
php artisan serve

# Start FrankenPHP with polling
echo "Starting FrankenPHP with polling..."
php artisan octane:start --server=frankenphp --poll &

# Watch for PHP/Blade changes and reload Octane
echo "Watching for changes..."
inotifywait -m -r -e modify,create,delete,move app/ resources/views/ --format '%w%f' | while read file; do
    echo "File changed: $file"
    echo "Reloading Octane..."
    php artisan octane:reload
done