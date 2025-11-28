#!/bin/bash

# Start FrankenPHP first (this handles Laravel requests)
echo "Starting FrankenPHP with polling..."
<<<<<<< HEAD
php artisan octane:start --server=frankenphp --poll --host=0.0.0.0 --port=8000 &
=======
php artisan octane:start --server=frankenphp --poll  &
>>>>>>> a875d1ee2675b08a3f0e4e18fe4816738cd217ee

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