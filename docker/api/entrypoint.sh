#!/bin/bash

cd /app
php artisan key:generate
php artisan config:clear