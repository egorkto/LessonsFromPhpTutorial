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
    <form action="vendor/login.php" method="post">
        <label for="">Login</label>
        <input type="text" name="login" placeholder="Login:">
        <label for="">Password</label>
        <input type="password" name="password" placeholder="Password:">
        <button type="submit">Enter</button>
        <p>
            Haven't account? - <a href="/register.php">sign up</a>
        </p>
        <?php
        if (isset($_SESSION['message'])) { ?>
        <p class="msg">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </p>
        <?php } ?>
    </form>
</body>
</html>