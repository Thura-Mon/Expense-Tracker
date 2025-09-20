<!-- dblink.php -->
<?php
$mysqli = new mysqli('localhost', 'root', 'root', 'EMS');   
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

if (!$mysqli->select_db("EMS")) {
    die("Can't use expenseDB: " . $mysqli->error);
}
?>