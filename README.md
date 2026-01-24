# TomTroc

![TomTroc logo](https://tomtroc.amtins.dev/img/logo.svg "TomTroc book sharing app")

This project is a web application allowing users to share books. Users can register, add their owns books, browse available books, view book details, manage their profiles, and communicate with other users through a chat.

## Features

* **User Authentication:** signup, signin, and signout functionalities
* **Book Management:** users can `add` new books, `edit` existing book details, view a catalog of all available books, and `delete` their own books
* **User Profiles:** each user has a profile page displaying their shared books and other relevant information
* **Chat:** a messaging system allows users to communicate directly with each other

## Technologies Used

The project is built primarily with PHP, utilizing a custom MVC-like architecture and powered by SQLite.

* **Backend:** PHP (Custom MVC)
* **Database:** SQLite
* **Frontend:** HTML, CSS, JavaScript

## Installation and Setup

Follow these steps to get the project up and running on your local machine:

1. **Clone the repository:**

   ```bash
   git clone https://github.com/nutbreaker/projet_4_b.git
   ```

2. **Navigate to the project directory:**

    ```bash
    cd projet_4_b
    ```

3. **Database Setup (optional):**
    initialize the SQLite database and seed it with initial data. _This step is optional since the project contains a prepotulated database_

    ```bash
    sqlite3 database/tomtroc.db < database/tomtroc.sql
    sqlite3 database/tomtroc.db < database/seed.sql
    ```

4. **Run the application:**
    start the PHP development server

    ```bash
    php -S localhost:8080 -t public -c config/php.ini
    ```

5. **Access in browser:**
    open your web browser and navigate to:

    ```text
    http://localhost:8080
    ```

## How to use the app

1. **Sign up:** create a new account using the `Inscrivez-vous` page
2. **Sign In:** log in to your account using the `Connexion` page
3. **Add a Book:** go to the `Mon compte` page then click `Ajouter un livre` to add a book.
4. **Browse Books:** go to `Nos livres à l'échange` page to explore available books on the platform
5. **Chat:** initiate a chat with a user by going to a user's profile page then clicking `Envoyer une message`

## Project Structure

The project follows an MVC-like pattern:

* [`src/controllers`](https://github.com/nutbreaker/projet_4_b/tree/main/src/controllers): handles incoming requests, interacts with models, and loads views
* [`src/models`](https://github.com/nutbreaker/projet_4_b/tree/main/src/models): represents the data structure
* [`src/repositories`](https://github.com/nutbreaker/projet_4_b/tree/main/src/repositories): manages database interactions for models
* [`src/services`](https://github.com/nutbreaker/projet_4_b/tree/main/src/services): contains various helper services (authentication, session management, view rendering...)
* [`src/utils`](https://github.com/nutbreaker/projet_4_b/tree/main/src/utils): provides utility functions (database connection, file handling...)
* [`public/`](https://github.com/nutbreaker/projet_4_b/tree/main/public): contains public assets and the [`index.php`](https://github.com/nutbreaker/projet_4_b/tree/main/public/index.php) entry point
* [`public/templates`](https://github.com/nutbreaker/projet_4_b/tree/main/public/templates): contains the PHP templates for rendering the user interface
* [`database/`](https://github.com/nutbreaker/projet_4_b/tree/main/database): stores database schema and seed data
