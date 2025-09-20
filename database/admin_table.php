<?php

include("dblink.php"); 

$sql = "CREATE TABLE admin 
           (admin_email VARCHAR(30), admin_password VARCHAR(20), primary key (admin_email))";
 
$ret = $mysqli->query($sql);


if ($ret) {
    echo "<p>Table created!</p>";
} else {
    echo "<p>Something went wrong: " . $mysqli->error . "</p>";
}

$mysqli->close();
?>