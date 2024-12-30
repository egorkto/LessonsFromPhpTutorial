<?php

session_start();
require_once 'connect.php';

$name = $_POST['name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if ($password === $password_confirm) {
    $path = 'uploads/'.time().$_FILES['avatar']['name'];
    if (! move_uploaded_file($_FILES['avatar']['tmp_name'], '../'.$path)) {
        $_SESSION['message'] = 'Can\'t upload avatar';
        header('Location: ../register.php');
    }
    $password = md5($password);
    mysqli_query($connect, "INSERT INTO `users` (`name`, `login`, `email`, `password`, `avatar`) VALUES ('$name', '$login', '$email', '$password', '$path');");
    $_SESSION['message'] = 'Registration success';
    header('Location: /');
} else {
    $_SESSION['message'] = 'Confirm password!';
    header('Location: ../register.php');
}
