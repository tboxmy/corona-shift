<p align="center"><a href="https://tboxmy.blogspot.com" target="_blank">Blogspot</a></p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Project setup

System environment:
PHP 7.4
NPM 6.14
Nodejs 12.22
MS Windows 10

## Installing this project

git clone <SSH><USER><URL>
php artisan migrate
php artisan db:seed --class=ShiftTypesSeeder
OR
php artisan migrate:fresh --seed --seeder=ShiftTypesSeeder
php artisan db:seed --class=DefaultDepartmentUserSeeder

## How this project was setup

composer create-project --prefer-dist laravel/laravel shift-scheduling
composer require laravel/ui
php artisan ui bootstrap --auth
npm install bootstrap@latest @popperjs/core --save-dev
npm install jquery jquery-ui --save-dev
npm install dateFns
npm install && npm run dev
php artisan storage:link

Note: post install message
C:\Users\nasbo\AppData\Roaming\npm-cache_logs\2022-11-26T02_23_56_425Z-debug.log

Folder storage should be allowed to write. Where higher folder security is applied such as SELINUX, then this needs to be allowed.

Example of php artisan used;
php artisan make:model ShiftUser -mcr
php artisan make:model DepartmentUsers -mcr
php artisan make:seeder DefaultUsersSeeder
php artisan make:seeder DefaultTypesSeeder

# Update .env with database details

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=scheduling
DB_USERNAME=postgres
DB_PASSWORD=postgres
==

php artisan migrate

## Bootstrap

npm install bootstrap
npm install sass && npm install sass-loader
npm run dev
