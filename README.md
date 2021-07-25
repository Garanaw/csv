<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## How to

This is a Laravel based application to parse a CSV. It's served by Laravel Sail, and this is how to install and start it:

1. Run `composer install` from the root folder
2. Run `npm ci` from the root folder
3. Copy the file `.env.example` and rename it to `.env`
4. In this file, edit the last three lines and add the desired credentials.
5. Run `./vendor/bin/sail up`
6. If you want to log in to the application container, run `docker ps`, copy the container ID assigned to the image named `sail-8.0/app`, and run `docker exec -it ${container-id} /bin/bash`
7. The following commands can be run from inside or outside the container. If they are run from outside, replace `php` with `sail`
8. Run `php artisan migrate:install && php artisan migrate --step`
9. Run `npm run build`

Now the application is ready to use. First, you will need to log in with the credentials set in the `.env` file. Once done, the application will redirect you to the dashboard, from where CSV files can be uploaded.

You can select the file using the "Select" button or drag/drop it
