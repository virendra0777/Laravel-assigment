# Laravel-assigment Project

## Installation

First clone this repository, install the dependencies, and setup your .env file.

```
git clone https://github.com/virendra0777/Laravel-assigment.git
composer install
cp .env.example .env
```

Then create the necessary database.

```
php artisan db
create database demo
```

And run the initial migrations and seeders.

```
php artisan migrate
php artisan db:seed

```
For passport client token use
php artisan passport:client --personal
```
And Run the project
php artisan serve
```