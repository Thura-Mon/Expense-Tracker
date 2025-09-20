<?php
        include("dblink.php");
    // $sql = "INSERT INTO admin (admin_email, admin_password ) VALUES ('expense.medical.org@gmail.com', 'admin123')";         
    // $res = $mysqli->query($sql);        
    
    $sql = "SELECT * FROM admin";        
    $res = $mysqli->query($sql);
    
    echo "<table border='1' width='50%'>"; 
    echo "<tr><th>Admin Email</th><th>Admin Password</th></tr>";

    while ($r = $res->fetch_array()) {
        echo "<tr><td>{$r['admin_email']}</td>
                      <td>{$r['admin_password']}</td></tr>"; 
    }
    
    echo "</table>";
    
    $mysqli->close();

?>