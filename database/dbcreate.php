<!-- dbcreate.php -->
<?php
$mysqli = new mysqli("localhost", "root", "root", ""); // Replace 'your_password' with the actual password

if ($mysqli->connect_error) {
    die('Could not connect: ' . $mysqli->connect_error);
}

if ($mysqli->query("CREATE DATABASE EMS") === TRUE) {
    echo "Database created";
} else {
    echo "Error creating database: " . $mysqli->error;
}

$mysqli->close();
?>