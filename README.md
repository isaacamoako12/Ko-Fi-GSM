# Rocksure Operator Management

A web application to manage operator information for Rocksure International.

## Project Structure

This project is a full-stack web application built with PHP, JavaScript, CSS, and MySQL. It also includes a `package.json` for potential Node.js-based frontend tooling.

- `backend/`: Contains the PHP backend scripts that handle the application's logic.
  - `db.php`: Manages the connection to the MySQL database. **Note:** It contains placeholder credentials. You should replace them with your actual database credentials and consider using environment variables for better security.
  - `add_operator.php`: Handles the submission of the "Add New Operator" form and saves the data to the database.
  - `get_operators.php`: Fetches the list of operators from the database and returns it as JSON.
  - `uploads/`: This directory is used to store the images of the operators.

- `database/`: Contains the database schema.
  - `schema.sql`: The SQL script to create the `operators` table in your MySQL database.

- `frontend/`: Contains the frontend assets.
  - `index.html`: The main HTML file for the user interface.
  - `style.css`: The stylesheet for the application.
  - `script.js`: The JavaScript file that handles form submissions and dynamically updates the UI.

- `package.json`: A standard Node.js manifest file. While this project doesn't currently use any npm packages, this file is included for potential future development, such as adding a build step for frontend assets.

## How to Run

1.  **Set up the database:**
    - Create a MySQL database named `rocksure_operators`.
    - Execute the `database/schema.sql` script to create the `operators` table.
    - Update the database credentials in `backend/db.php`.

2.  **Set up a web server:**
    - You will need a web server (like Apache or Nginx) with PHP support.
    - Configure the web server to serve the files from the project's root directory.

3.  **Access the application:**
    - Open your web browser and navigate to the `frontend/index.html` file through your web server (e.g., `http://localhost/frontend/index.html`).