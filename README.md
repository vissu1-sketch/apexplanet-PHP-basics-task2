# Basic CRUD Blog Application

## Overview
A simple blog management web application developed using PHP and MySQL as part of a Web Application Development Internship.

## Features
- Create, view, edit, and delete blog posts
- User registration and login
- Password hashing using PHP
- Session-based authentication
- MySQL database integration

## Technologies Used
- PHP
- MySQL
- HTML
- CSS
- XAMPP
- Git and GitHub

## Database Setup
Create a database named `blog` with the following tables:

### posts
- `id` — INT, Primary Key, Auto Increment
- `title` — VARCHAR(255)
- `content` — TEXT
- `created_at` — TIMESTAMP

### users
- `id` — INT, Primary Key, Auto Increment
- `username` — VARCHAR(100), Unique
- `password` — VARCHAR(255)

## How to Run
1. Install XAMPP.
2. Start Apache and MySQL.
3. Place the project folder inside `htdocs`.
4. Configure the database connection in `db.php`.
5. Import or create the required database tables.
6. Open `http://localhost/blog_app/` in a browser.

## Project Status
Developed as an internship learning project.
