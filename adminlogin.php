<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Expense Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .adminLoginText {
            color: white;
        }
        .login-container {
            background-color: #fff;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 5px 5px 20px 3px #7693EE;
            width: 300px;
            height: 260px;
            text-align: center;
        }
        .login-container h2 {
            padding-top: 1px;
            margin-bottom: 20px;
            color:rgb(23, 29, 155);
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 80%;
            padding: 10px;
            margin: 10px;
            margin-top: 3%;
            border: 1px solid #7693EE;
            border-radius: 4px;
        }
        .login-container input[type="submit"] {
            width: 87%;
            padding: 10px;
            margin-top: 10%;
            background-color: #5D64F5;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="adminlogin.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <div class="nameValidateError"> </div>
            <input type="password" name="password" placeholder="Password" required>
            <div class="passwordValidateError"> </div>
            <input type="submit" value="Login" name="submit">
        </form>

        <?php

        include("database/dblink.php");

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM admin WHERE admin_email = '$username' AND admin_password = '$password'";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                echo"<script>location.href='admin_dashboard.php'</script>";
            } else {
                echo "<p style='color: red;'>Invalid username or password</p>";
            }
        }

        ?>
    </div>
</body>
</html>

