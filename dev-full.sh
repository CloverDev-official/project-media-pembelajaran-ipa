#!/bin/bash

# Start FrankenPHP first (this handles Laravel requests)
echo "Starting FrankenPHP with polling..."
php artisan octane:start --server=frankenphp --poll  &

# Start Vite dev server in background
echo "Starting Vite development server..."
npm run dev &

# Start queue listener (optional)
echo "Starting queue listener..."
php artisan queue:listen --tries=1 &

# Watch for PHP/Blade changes and reload Octane
echo "Watching for changes..."
inotifywait -m -r -e modify,create,delete,move app/ resources/views/ --format '%w%f' | while read file; do
    echo "File changed: $file"
    echo "Reloading Octane..."
    php artisan octane:reload
done