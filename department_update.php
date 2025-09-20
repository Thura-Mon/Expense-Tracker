<?php

include("database/dblink.php");

if (isset($_POST["update-budget"])) {
    
    $department_id = $_POST["department-id"];
    $new_budget_amount = $_POST["new-budget-amount"];
    $user_email = $_POST["user-email"];

    $sql = "UPDATE department SET budget_amount = ?, user_email = ? WHERE did = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssi", $new_budget_amount, $user_email, $department_id);

    if ($stmt->execute()) {
        echo "Budget updated!";
    } else {
        echo "Something went wrong: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
    exit;
}

?>