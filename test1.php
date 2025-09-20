<!DOCTYPE html>
<html>
<head>
    <title>Email Form</title>
</head>
<body>
    <form action="testemail.php" method="post">
        <label for="email" name="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="message" name="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        <button type="submit">Submit</button>
    </form>
</body>
</html>