<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: profile.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authorization and registration</title>
    <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
    <form>
        <label for="">Login</label>
        <input type="text" name="login" placeholder="Login:">
        <label for="">Password</label>
        <input type="password" name="password" placeholder="Password:">
        <button type="submit" class="login-btn">Enter</button>
        <p>
            Haven't account? - <a href="/register.php">sign up</a>
        </p>
        <p class="msg none">Lorem ipsum dolor sit amet.</p>
    </form>

    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>