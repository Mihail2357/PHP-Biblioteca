<?php
//Start Session
session_start();


//Create Constants to Store Non Repeating Values
define('SITEURL', 'http://localhost/Biblioteca/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'biblioteca');
define('ADMIN_TABLE', 'admins' );

include('C:\xampp\htdocs\Biblioteca\includes/functions.php');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //SElecting Database



    $sql = "CREATE TABLE IF NOT EXISTS admins (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    full_name VARCHAR(30) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR (250) NOT NULL
    )";

    if ($conn->query($sql) != TRUE) {
        echo "Database and Table Offline" . $conn->error;
    }

    
    $sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(30) NOT NULL,
    username VARCHAR(30) NOT NULL,
    password VARCHAR (250) NOT NULL,
    UNIQUE (username)
    )";

    if ($conn->query($sql) != TRUE) {
        echo "Database and Table Offline" . $conn->error;
    }


    $sql = "CREATE TABLE IF NOT EXISTS librarians (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(30),
    speciality VARCHAR(30) NOT NULL,
    phone_number VARCHAR(30) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR (250) NOT NULL,
    UNIQUE (username)
    )";

    if ($conn->query($sql) != TRUE) {
        echo "Database and Table Offline" . $conn->error;
    }


    $sql = "CREATE TABLE IF NOT EXISTS rents (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    user_name VARCHAR(30) NOT NULL,
    book_name VARCHAR(30) NOT NULL,
    librarian_name VARCHAR(30) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_name) REFERENCES users(username),
    FOREIGN KEY (book_name) REFERENCES books(book_name),
    FOREIGN KEY (librarian_name) REFERENCES librarians(username)
    )";

    if ($conn->query($sql) != TRUE) {
        echo "Database and Table Offline" . $conn->error;
    }

    $sql = "CREATE TABLE IF NOT EXISTS books (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    book_price INT(6) UNSIGNED NOT NULL,
    book_name VARCHAR(30) NOT NULL,
    book_autor VARCHAR(30),
    UNIQUE (book_name)
    )";

    if ($conn->query($sql) != TRUE) {
        echo "Database and Table Offline" . $conn->error;
    }

?>