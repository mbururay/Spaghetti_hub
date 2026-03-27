# Spaghetti Hub

## Description

Spaghetti Hub is a full-stack recipe-sharing web application where users can create, manage, and explore recipes. It includes authentication, CRUD functionality, and a structured database system.

This project focuses on building a complete web application from scratch, handling both frontend and backend logic.

## Tech Stack

* PHP (server-side logic)
* MySQL (database)
* HTML, CSS (frontend)

## Features

* User authentication (signup & login)
* Create, edit, and delete recipes
* Persistent data storage using MySQL
* Responsive UI for desktop and mobile

## How It Works

Users create an account and log in to access the platform. Recipes are stored in a MySQL database and linked to user accounts. PHP handles server-side logic, including authentication and CRUD operations, while the frontend renders dynamic content based on database queries.

## Challenges & Learning

* Implementing secure user authentication in PHP
* Structuring relational data for users and recipes
* Connecting frontend forms to backend logic
* Managing state without modern frameworks

## How to Run

1. Clone the repository:

   ```
   git clone <repository-url>
   ```
2. Set up a local PHP server (XAMPP, WAMP, etc.)
3. Import `database.sql` into MySQL
4. Update `config.php` with your database credentials
5. Open `localhost/spaghetti-hub` in your browser
