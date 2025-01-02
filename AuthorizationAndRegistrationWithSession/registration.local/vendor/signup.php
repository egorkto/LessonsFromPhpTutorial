<?php

session_start();
require_once 'connect.php';

$name = $_POST['name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

$check_login = mysqli_query($connect, "SELECT * FROM users WHERE login = '$login'");

if (mysqli_num_rows($check_login) > 0) {
    $response = [
        'status' => false,
        'type' => 1,
        'message' => 'Login is already exists',
        'fields' => ['login'],
    ];
    echo json_encode($response);
    exit();
}

$error_fields = [

];

if ($name === '') {
    $error_fields[] = 'name';
}

if ($login === '') {
    $error_fields[] = 'login';
}

if ($email === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_fields[] = 'email';
}

if ($password === '') {
    $error_fields[] = 'password';
}

if ($password_confirm === '') {
    $error_fields[] = 'password_confirm';
}

if (! isset($_FILES['avatar'])) {
    $error_fields[] = 'avatar';
}

if (! empty($error_fields)) {
    $response = [
        'status' => false,
        'type' => 1,
        'message' => 'Fill all fields',
        'fields' => $error_fields,
    ];
    echo json_encode($response);
    exit();
}

if ($password === $password_confirm) {
    $path = 'uploads/'.time().$_FILES['avatar']['name'];
    if (! move_uploaded_file($_FILES['avatar']['tmp_name'], '../'.$path)) {
        $response = [
            'status' => false,
            'type' => 2,
            'message' => 'Avatar upload error',
        ];
    }
    $password = md5($password);
    mysqli_query($connect, "INSERT INTO `users` (`name`, `login`, `email`, `password`, `avatar`) VALUES ('$name', '$login', '$email', '$password', '$path');");

    $response = [
        'status' => true,
        'message' => 'Registration success',
    ];

    echo json_encode($response);
} else {
    $response = [
        'status' => false,
        'message' => 'Password must be confirmed',
    ];

    echo json_encode($response);
}
