php artisan optimize:clear && php artisan optimize && ./vendor/bin/pint && ./vendor/bin/phpstan analyse --memory-limit 1G && php artisan serve --host=0.0.0.0
