<?php

session_start();

require_once __DIR__.'/../helpers.php';

$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$passwordConfirmation = $_POST['password_confirmation'] ?? null;
$avatar = $_FILES['avatar'] ?? null;

$avatarTypes = ['image/jpeg', 'image/png'];
$avatarsDir = 'uploads';

$_SESSION['validation'] = [];

if (empty($name)) {
    addError('name', 'Invalid name!');
}

if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    addError('email', 'Invalid email!');
}

if (empty($password)) {
    addError('password', 'Invalid password!');
}

if ($password !== $passwordConfirmation) {
    addError('password_confirmation', 'Necessary to confirm password!');
}

if (! empty($avatar)) {
    if (! in_array($avatar['type'], $avatarTypes)) {
        addError('avatar', 'Invalid type');
    }

    if (($avatar['size'] / 1000000) >= 1) {
        addError('avatar', 'Invalid size');
    }
} else {
    addError('avatar', 'Cant upload image');
}

if (! empty($_SESSION['validation'])) {
    addOldValue('name', $name);
    addOldValue('email', $email);
    redirect('register');
}

if (! is_dir("../../$avatarsDir")) {
    mkdir("../../$avatarsDir", 0777, true);
}

$path = uploadAvatar($avatar, $avatarsDir, 'avatar_');

$pdo = initializePDO();

$sql = 'INSERT INTO users (name, email, avatar, password) VALUES (:name, :email, :avatar, :password)';

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'avatar' => $path,
        'password' => password_hash($password, PASSWORD_DEFAULT),
    ]);
} catch (\Exception $ex) {
    echo $ex;
}

redirect('index');
