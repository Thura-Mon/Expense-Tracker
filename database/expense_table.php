<?php

include("dblink.php"); 

$sql = "CREATE TABLE expense 
           (i_id int auto_increment, i_name varchar(50), i_amount VARCHAR(30), i_image blob, i_date date, did int, primary key (i_id), foreign key (did) references department (did))";
 
$ret = $mysqli->query($sql);

if ($ret) {
    echo "<p>Table created!</p>";
} else {
    echo "<p>Something went wrong: " . $mysqli->error . "</p>";
}

$mysqli->close();
?>