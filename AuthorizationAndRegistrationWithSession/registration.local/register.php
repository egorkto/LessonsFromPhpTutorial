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
    <form action="vendor/signup.php" method="post" enctype="multipart/form-data">
        <label for="">Name</label>
        <input type="text" name="name" placeholder="Name:">
        <label for="">Login</label>
        <input type="text" name="login" placeholder="Login:">
        <label for="">Avatar</label>
        <input type="file" name="avatar">
        <label for="">Email</label>
        <input type="email" name="email" placeholder="Email:">
        <label for="">Password</label>
        <input type="password" name="password" placeholder="Password:">
        <label for="">Confirm password</label>
        <input type="password" name="password_confirm" placeholder="Confirm password:">
        <button type="submit">Submit</button>
        <p>
            Havet account? - <a href="/">log in</a>
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