# Bonjour

## Clone Repository
git clone https://github.com/Hamzah-AJa/todo-rizkyterry.git nama_folder

cd nama_folder

## Install Dependency PHP
composer install

copy .env.example .env

php artisan key:generate

php artisan migrate:fresh --seed

## Install Dependency Frontend
npm install

## Menjalankan Program
php artisan serve
