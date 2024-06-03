# Cars Shipping Project

This Project is based on Codeigniter 4.5.1
PHP version 8.2.2

## Script needs to Run in start

composer update

create new database and set its configuration in Config/Database.php

run cli commands after connect with database

1. php spark migrate
2. php spark db:seed UserSeeder
3. php spark db:seed CarsMakeSeeder
4. php spark serve (or used xampp or wamp)

## REST APIs

1. GET api/cars
2. GET api/cars-make
3. POST api/cars
    Params (make_id, model, year, vin, detail)
4. PUT api/cars/(:id)
    Params (shipping_status)

## Caching

Cars caching is page wise, every page have different key
when any record update or delete then caching will clear
by default caching will clear in an hour

## Extra

Create Cars Make table differently to avoid data redundancy
Add Image column in database but not functioned

## Possibilities 

Can create Logs of shipping status update
Can add registration of user or admin
