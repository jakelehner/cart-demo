#!/usr/bin/env bash

if [ ! -f .env ]; then
    cp .env.example .env
fi

composer install
php artisan migrate
php artisan db:seed
