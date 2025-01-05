<?php

session_start();

require_once __DIR__.'/../helpers.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    addError('email', 'Invalid email!');
}

if (empty($password)) {
    addError('password', 'Invalid password!');
}

if (! empty($_SESSION['validation'])) {
    addOldValue('email', $email);
    redirect('index');
}

$user = findUser($email);

if (! $user) {
    addMessage('error', 'No such user');
}

if (! password_verify($password, $user['password'])) {
    addMessage('error', 'Unavailible password');
}

if (! empty($_SESSION['message'])) {
    redirect('index');
}

$_SESSION['user']['id'] = $user['id'];

redirect('home');
