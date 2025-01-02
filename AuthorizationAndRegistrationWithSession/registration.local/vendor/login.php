<?php

session_start();
require_once 'connect.php';

$login = $_POST['login'];
$password = $_POST['password'];

$error_fields = [

];

if ($login === '') {
    $error_fields[] = 'login';
}

if ($password === '') {
    $error_fields[] = 'password';
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

$password = md5($password);

$checkUser = mysqli_query($connect, "SELECT * FROM `users` WHERE login = '$login' AND password = '$password'");
if (mysqli_num_rows($checkUser) > 0) {
    $user = mysqli_fetch_assoc($checkUser);
    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'avatar' => $user['avatar'],
        'email' => $user['email'],
    ];

    $response = [
        'status' => true,
    ];
    // header('Location: ../profile.php');
    echo json_encode($response);

} else {

    $response = [
        'status' => false,
        'message' => 'Unavailible login or password',
    ];

    //$_SESSION['message'] = 'Unavailible login or password';
    //header('Location: /');
    echo json_encode($response);
}
