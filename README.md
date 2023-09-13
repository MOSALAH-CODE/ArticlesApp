# ArticlesApp - Dynamic Articles Web Application with PHP

Welcome to the **ArticlesApp** project!

## Overview

ArticlesApp is a dynamic web application developed using PHP, designed to empower users to create, edit, and manage articles. This application places a strong emphasis on user authentication for data security and an improved user experience.

## Key Features

- **User Authentication:** We've implemented a robust user authentication system that includes user registration, secure login, and password reset functionalities. This ensures the security of user data and protects user privacy.

- **Dynamic Content Generation:** Our application utilizes PHP for server-side scripting. This enables us to efficiently process user requests, interact with the database, and generate dynamic HTML content. This dynamic content generation enhances the user experience and allows for seamless article management.

## Getting Started

To get started with this project:

1. **Install Dependencies:** Run `composer install` to install project dependencies.

2. **Configure Database:** Configure database settings in `Core/Config/database.php`.

3. **Run the Application:**

   To launch the web application, use the following command:

   ```bash
   php -S localhost:8888 -t public
  This command starts a PHP development server, making the application accessible at http://localhost:8888. You can adjust the port number if needed.
  1. Explore the Code: Dive into the codebase to understand how the app works.
  2. Customize and Extend: Customize and extend the app to meet your specific requirements.

## Directory Structure

The project's directory structure is organized to support the functionality mentioned above. Here's a brief overview of the key directories and components:

### `assets/images/articles`

This directory contains images related to your articles. You can place images here for use within articles or other parts of the application.

### `Core`

The `Core` directory contains core components of the application, including configuration, middleware, and essential classes:

- `Config`: Configuration files such as `database.php`, `remember.php`, and `sessions.php`.
- `Middleware`: Middleware classes like `Authenticated.php` and `Guest.php`.
- `App.php`: The main application class.
- `Authenticator.php`: Responsible for handling user authentication.
- `Container.php`: For dependency injection or managing application components.
- `Cookie.php`: Handling cookies.
- `Database.php`: Likely for database-related operations.
- `functions.php`: Custom functions used throughout the application.
- `Input.php`: Handling user input.
- `Mailer.php`: Handling email functionality.
- `Redirect.php`: Handling HTTP redirects.
- `Response.php`: Managing HTTP responses.
- `Router.php`: Handling routing within the application.
- `Session.php`: Managing user sessions.
- `User.php`: User-related functionality.
- `ValidationException.php`: Exception class for validation errors.
- `Validator.php`: Likely used for data validation.

### `Http`

The `Http` directory contains HTTP-related components, including controllers and form classes:

- `controllers`: Controllers for different parts of the application.
- `Forms`: Form classes for input validation and processing.

### `includes`

The `includes` directory might contain error and success pages:

- `errors`: Error pages, e.g., `403.php` and `404.php`.
- `success`: Success pages, e.g., `password_reset.php`.

### `public`

The `public` directory is the web server's public-facing directory:

- `index.php`: The entry point of the application.
- `playground.php`: Possibly a development/testing file.

### `vendor`

The `vendor` directory is where Composer dependencies are installed.

### `views`

The `views` directory contains templates and views:

- `articles`, `categories`, `contact`, `password_reset`, `profile`, `registration`, `session`: Views related to various aspects of the app.
- `partials`: Reusable view components like headers and footers.
- `about.view.php`: Possibly an "About" page.
- `index.view.php`: The main index view.

### Other Files

- `.gitignore`: Specifies files and directories ignored by version control.
- `bootstrap.php`: Likely for bootstrapping the application.
- `composer.json` and `composer.lock`: Files for Composer (PHP package manager).
- `createDB.php`: Possibly a script for creating the database.
- `phpunit.xml`: Configuration file for PHPUnit (testing framework).
- `routes.php`: Where application routes are defined.

## Testing

Consider writing and running tests using PHPUnit. Configure test suites and write tests in appropriate directories.

## Contributing

If you want to contribute, follow the contribution guidelines in the repository (if available). Contributions can include bug fixes, new features, and documentation improvements.

## Issues and Support

For issues or support, refer to the project's documentation or contact the maintainers.

Thank you for using **ArticlesApp**! We hope this README helps you navigate and understand the project effectively.
