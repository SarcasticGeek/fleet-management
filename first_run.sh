#!/usr/bin/env bash

php artisan migrate
php artisan db:seed
