# Operator Information Management System

This is a full-stack web application to manage operator information for each shift for Rocksure International.

## Features

- Add, edit, and delete operator information.
- Upload operator pictures.
- View a list of all operators.
- Company logo and background.

## Technologies Used

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL

## Project Structure

- `index.html`: Main application page.
- `css/style.css`: Styles for the application.
- `js/script.js`: Frontend JavaScript logic.
- `img/`: Contains images like the company logo and background.
- `backend/`: Contains all the PHP backend scripts.
  - `uploads/`: Directory where operator pictures are stored.
- `database.sql`: SQL script to set up the database.

## Setup and Installation

1.  **Web Server and Database:**
    - You need a web server with PHP support (like Apache) and a MySQL database. You can use XAMPP, WAMP, or MAMP for a quick setup.

2.  **Database Setup:**
    - Open your MySQL database management tool (like phpMyAdmin).
    - Create a new database named `rocksure_db`.
    - Import the `database.sql` file to create the `operators` table.

3.  **Backend Configuration:**
    - Open `backend/db_connection.php`.
    - If your database credentials are different, update the `$servername`, `$username`, and `$password` variables.

4.  **Running the Application:**
    - Place the entire project folder in the root directory of your web server (e.g., `htdocs` in XAMPP).
    - Open your web browser and navigate to `http://localhost/your_project_folder_name/`.

## Company Logo

The application uses a placeholder logo. The user has indicated they will add the logo later. To use the actual company logo, replace the `img/logo.png` file with your logo. It is recommended to use a logo with a transparent background.
The file `style.css` has a placeholder for the logo, it is a grey circle. To use the actual logo, you need to change the `background-color` property to `background-image` and set the url to the logo.

Example:
```css
#logo {
    width: 100px;
    height: 100px;
    /* background-color: #ccc; */
    background-image: url('../img/logo.png');
    background-size: contain;
    background-repeat: no-repeat;
    border-radius: 50%;
    margin: 0 auto;
    display: block;
    border: 2px solid #fff;
}
```
