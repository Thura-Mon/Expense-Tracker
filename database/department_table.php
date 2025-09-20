<?php

include("dblink.php"); 

$sql = "CREATE TABLE department 
           (did int auto_increment, dname varchar(50), budget_amount varchar(20), user_email VARCHAR(30), user_name varchar (30), user_password varchar(20), primary key (did))";
 
$ret = $mysqli->query($sql);

if ($ret) {
    echo "<p>Table created!</p>";
} else {
    echo "<p>Something went wrong: " . $mysqli->error . "</p>";
}

$mysqli->close();
?>