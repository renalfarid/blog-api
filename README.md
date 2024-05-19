## Backend Task

Restfull Api that allows users to perform the following
actions:
- [x] Register and authenticate (login/logout).
- [x] Create, update, and delete blog posts.
- [x] Read and filter blog posts by status, author, and date.
- [x] Create, update, and delete comments on blog posts.
- [ ] Like and dislike blog posts and comments.


## How to deploy

- Clone Project
```bash
$ git clone git@gitlab.com:farid.enal/laravel-assesment.git
```
- Create Database
```bash
   create database eg. blogdb
```
- Setting Enviroment
```bash
$ copy .env.example .env
change : 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogdb
DB_USERNAME=root
DB_PASSWORD=<yourpassword>

```
- Install dependency
```bash
$ composer install
```
- Migrate Database
```bash
$ php artisan run migrate
```
- Run Apps
```bash
$ php artisan serve
you will see :  INFO  Server running on [http://127.0.0.1:8000]
your backend server : http://127.0.0.1:8000
```

## Api Endpoint Collections
- [x] User register endpoint 
```bash
POST /api/auth/signup
payload : 
{
  "name": <name>,
  "email": <email>,
  "password": <password>,
  "role": <role>
}
```
- [x] User login endpoint
- [x] User logout endpoint
- [x] Read blog post
- [x] Create comment blog post
