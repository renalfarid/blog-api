## Brief 
Backend Restful API using laravel for simple blog apps. 

This Laravel application implements the repository pattern, which separates the business logic and data access logic layers. The architecture consists of the following components:

- Interface: Defines the contract that the repository must follow. It specifies the methods that need to be implemented for data operations.
- Repository: Implements the interface and contains the data access logic. This is where queries to the database are made.
- Controller: Handles HTTP requests, invokes the necessary services or repositories, and returns the appropriate responses. It acts as the intermediary between the model and the view.
- Model: Represents the data structure and contains the business logic related to the data. Models interact with the database using Eloquent ORM.
- Repository Service Provider: Registers the repositories with the Laravel service container, allowing for dependency injection.

This separation of concerns helps in maintaining and testing the application more effectively by decoupling the data access logic from the business logic.

Requirements for the apps is : 
- Blog posts have a title, content, author, published date, and status.
- Users have a name, email, password, and role (admin or regular user).
- Users can write blog posts.
- Users can leave comments on blog posts.
- Users can like and dislike blog posts and comments.

## Backend Task

Restfull Api that allows users to perform the following
actions:
- [x] Register and authenticate (login/logout).
- [x] Create, update, and delete blog posts.
- [x] Read and filter blog posts by status, author, and date.
- [x] Create, update, and delete comments on blog posts.
- [x] Like and dislike blog posts and comments.


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
