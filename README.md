<p align="center"><a href="https://tboxmy.blogspot.com" target="_blank">Blogspot</a></p>

## About Laravel

Corona Shift project provides a design framework to manage shift scheduling that leverage on Laravel programming environment.

![Screenshot](screenshot-initialtable.PNG)

## Project setup

| Component       | notes  |
| --------------- | ------ |
| PHP             | 7.4    |
| Nodejs          | 12.22  |
| Laravel         | 9      |
| Bootstrap (npm) | 5      |
| Popper (npm)    | 2.11.6 |
| dateFns         | 2.29.3 |

Notes:

-   JQuery is setup, however I have decided to continue without it at this stage as JavaScript is able to provide the required functions.
-   Moment is setup, however dateFns is now implemented where possible to leverage at lighter code.

## Installing this project

```
git clone <SSH><USER><URL>
php artisan migrate
php artisan db:seed --class=ShiftTypesSeeder
OR
php artisan migrate:fresh --seed --seeder=ShiftTypesSeeder
php artisan db:seed --class=DefaultDepartmentUserSeeder
```

-   Configure database settings in the file .env

## How this project was setup

```
composer create-project --prefer-dist laravel/laravel shift-scheduling
composer require laravel/ui
php artisan ui bootstrap --auth
npm install bootstrap@latest @popperjs/core --save-dev
npm install jquery jquery-ui --save-dev
npm install dateFns
npm install && npm run dev
php artisan storage:link
```

Note: post install message
C:\Users\nasbo\AppData\Roaming\npm-cache_logs\2022-11-26T02_23_56_425Z-debug.log

Folder storage should be allowed to write. Where higher folder security is applied such as SELINUX, then this needs to be allowed.

Example of php artisan used;

```
php artisan make:model ShiftUser -mcr
php artisan make:model DepartmentUsers -mcr
php artisan make:seeder DefaultUsersSeeder
php artisan make:seeder DefaultTypesSeeder
```

# Update .env with database details

DB Configuration with Postgresql

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=scheduling
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

## Bootstrap

```
npm install bootstrap
npm install sass && npm install sass-loader
npm run dev
```
