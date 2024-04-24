Run
 - docker-compose up -d --build
 - docker compose exec php-interview bash
 - composer install
 - composer require barryvdh/laravel-dompdf
 - php artisan key:generate
 - php artisan migrate
 - php artisan db:seed

.env
DB_CONNECTION=mysql
DB_HOST=mysql-interview
DB_PORT=3306
DB_DATABASE=interview
DB_USERNAME=tranbinhan
DB_PASSWORD=123456

http://localhost:8080

account login
 email: staff@gmail.com
 password: password
