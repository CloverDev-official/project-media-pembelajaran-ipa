touch database/database.sqlite
php artisan migrate:fresh
php artisan db:seed --class=DummySeeder