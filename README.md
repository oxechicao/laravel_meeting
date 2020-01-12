# LARAVEL MEETING APP DEMO - Meeting Scheduler

A sample of meeting scheduler application built with Laravel, Tailwind.css, Vuejs and PostgreSQL.

## Enviroment, dependencies and libraries version used to develop
* Xubuntu 18.04
* Docker version 19.03.5, build 633a0ea838
* Php 7.4
* Postgresql: `12.1 (Debian 12.1-1.pgdg100+1)`  
  * Docker image version 12.1
* Composer
* Laravel 6
* Phpunit 8
* Tailwind ^1.1.4
* jquery": ^3.2
* @mdi/font": ^4.7.95
* animate.css": ^3.7.2
* v-calendar": ^1.0.0
* vue-the-mask": "^0.11.1
* vuelidate": "^0.7.4


## Install and run locally

1. Install dependencies:  
   Run `composer install && npm install`
2. Copy .env.exameple to .env:  
   Run `cp .env.example .env`
3. Define database config on .env for both databases  
   ```shell script
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=laravel_meeting
    DB_USERNAME=postgres
    DB_PASSWORD=root
    
    DB_TESTING_CONNECTION=pgsql
    DB_TESTING_HOST=127.0.0.1
    DB_TESTING_PORT=5432
    DB_TESTING_DATABASE=testing_laravel_meeting
    DB_TESTING_USERNAME=postgres
    DB_TESTING_PASSWORD=root
   ```
4. Run the migrations:
   1. `php artisan migrate`
   2. `php artisan migrate --database="testing_pgsql"`
5. Generate the key:
   1. `php artisan key:generate`
6. Start server:
   1. Without docker:  
      `php artisan serve`  
      `Laravel development server started: http://127.0.0.1:8000`
   2. With docker-composer:  
      `docker-compose up -d`
        6. If the error shows:  
        `could not be opened: failed to open stream: Permission denied`  
        Give the permission 777 to the storage ./storage/logs/ and storage/framework/views/  
        It is not the best answer, but it works :)
        7. If database shows some error of connection:  
        Change the DB_HOST on .env file to the IP of postgresql on docker: 172.28.1.2


### Run tests

Before it, make sure to run the migration to testing_pgsql database:

> php artisan migrate --database="testing_pgsql" 


```shell script
clear; phpunit
```

## DATABASE STRUCTURE

For model details look at models classes: `User.php, Contact.php, Meeting.php`. Or the migrations files.

| TABLE                         | FIELDS                                                          | 
|-------------------------------|-----------------------------------------------------------------|
| users                          | name - email - password  |
| contacts                      |  user_id, phones, email, name |
| meetings                      | title, description, date, hour, participants, user_id |
