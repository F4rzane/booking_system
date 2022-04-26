
## About Booking System

### Requirments

- [Docker](https://docs.docker.com/engine) v1.13.0+ 
- [Docker Compose](https://docs.docker.com/compose) v3.0+ 


## Laravel Framework

[documentation](https://laravel.com/docs) 

## Packages

- [Laravel Actions](https://laravelactions.com)
- [Laravel 5 Repositories](http://andersonandra.de/l5-repository)
- [Data Transfer Object](https://github.com/spatie/data-transfer-object)


- CRUD for employees
- CRUD for Entity Types (Desk, Room, ...)
- CRUD For Entities (Desk 1, Room1, ..)
- CRUD For Facilities (Chair, Computer, ...)
- CRUD For Entity Facilities (connect entities to facilities)
- CRUD For Booking an Entity
- You are able to set Max simultaneous booking for entities or left it null
- you are able to set holiday check for entities.
- employees are allowed to book entities only in office opening hours


## How To run project

- docker-compose build
- docker-compose up
- docker-compose exec app php artisan migrate
- docker-compose exec app php artisan test
- 

