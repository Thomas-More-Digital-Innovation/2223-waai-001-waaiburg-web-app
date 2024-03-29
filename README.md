# 2223-waai-001 webapp

## Requirements
1. Make sure you have xampp installed on your computer.
2. Make sure you have composer installed on your computer.
3. Make sure you have apache running on your computer (xampp).
4. Make sure you have MySQL running on your computer (xampp).

## Installation
1. Make sure to install this repository in your xampp/htdocs folder.
2. Then run the following commands in your terminal:
3. Do all these commands in the webapp folder! (2223-waai-001-waaiburg-web-app/code/webapp)
4. 'composer install'
5. 'npm install'
6. Copy .env.example to .env and change the mail settings to mail server waaiburg
7. Generate an app encryption key with 'php artisan key:generate'
8. Use 'php artisan serve' in your terminal to run the application
9. Use 'npm run dev' to compile the assets (use 2 terminals!)
10. Open the link to 127.0.0.1:8000 in your browser
11. Use 'php artisan migrate --seed' in your terminal to create the database
11. Use 'php artisan migrate:fresh --seed' in your terminal to update the existing database

## Documentation
1. Make sure the library l5-swagger is installed locally using composer install
2. Generate the documentation using php artisan l5-swagger:generate
3. See the documentation by 127.0.0.1/api/documentation

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=Thomas-More-Digital-Innovation_2223-waai-001-waaiburg-web-app&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=Thomas-More-Digital-Innovation_2223-waai-001-waaiburg-web-app)
