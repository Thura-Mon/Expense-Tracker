<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: white;
        }
        .login-form {
            background-color: #fff;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 5px 5px 20px 3px #7693EE;
            width: 300px;
            height: 430px;
            text-align: center;
        }
        .login-form h2 {
            padding-top: 1px;
            margin-bottom: 20px;
            color: rgb(23, 29, 155);
        }
        .login-form input {
            width: 80%;
            padding: 10px;
            margin: 10px;
            margin-top: 3%;
            border: 1px solid #7693EE;
            border-radius: 4px;
        }
        .login-form button {
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
        .login-form button:hover {
            background-color:rgb(17, 25, 188);
        }
        .login-form a {
            display: block;
            text-align: center;
            margin: auto;
            margin-top: 30px;
            color: #7693EE;
            text-decoration: none;
            font-size: 14px;
        }

        .login-form a:hover{
            color: #175AF4;
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>                  
        <form name="f" onsubmit="validateForm()">
            <input type="email" name="email" placeholder="Email" >
            <div id="email_error" style="color: red; font-size: 11px; margin-right: 127px;"></div>
            <input type="text" placeholder="Username" name="username" required>
            <div id="username_error" style="color: red; font-size: 11px; margin-right: 82px;"></div>
            <input type="password" placeholder="Password" name="password" required>
            <div id="password_error" style="color: red; font-size: 11px; margin-right: 93px;"></div>
            <input type="password" placeholder="Confirm Password" name="confirm_password" required>
            <div id="confirm_password_error" style="color: red; font-size: 11px; margin-right: 93px;"></div>
            <button type="submit">Sign In</button>
            <a href="#">Forgot Password?</a>
        </form>
    </div>



    <script>
        function validateForm() {
            event.preventDefault();            
            let isValid = true;

            // Validate email
            const email = document.f.email.value;
            const emailError =document.getElementById('email_error');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                emailError.textContent = 'Please enter a valid email.';
                isValid = false;
            } else {
                emailError.textContent = '';
            }

            // Validate username
            const username = document.f.username.value;
            const usernameError = document.getElementById('username_error');
            const usernamePattern = /^[a-zA-Z\s]+$/;
            if (!usernamePattern.test(username)) {
                usernameError.textContent = 'Username must contain only letters.';
                isValid = false;
            } else {
                usernameError.textContent = '';
            }

            // Validate password
            const password = document.f.password.value;
            const passwordError = document.getElementById('password_error');
            if (password.length < 8) {
                passwordError.textContent = 'Please type at least 8 characters.';
                isValid = false;
            } else {
                passwordError.textContent = '';
            }

            const confirm_password = document.f.confirm_password.value;
            const confirm_passwordError = document.getElementById('confirm_password_error');
            if (confirm_password !== password) {
                confirm_passwordError.textContent = 'Password does not match.';
                isValid = false;
            } else {
                confirm_passwordError.textContent = '';
            }

            return isValid;
        }
    </script>







</body>
</html>

