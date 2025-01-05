<?php

session_start();

require_once __DIR__.'/config.php';

function redirect(string $name)
{
    header("Location: /../$name.php");
    exit();
}

function hasError(string $fieldName): bool
{
    return isset($_SESSION['validation'][$fieldName]);
}

function checkError(string $fieldName)
{
    return hasError($fieldName) ? "aria-invalid='true'" : '';
}

function getFlashError(string $fieldName)
{
    $error = hasError($fieldName) ? $_SESSION['validation'][$fieldName] : '';
    unset($_SESSION['validation'][$fieldName]);

    return $error;
}

function addError(string $fieldName, string $message)
{
    $_SESSION['validation'][$fieldName] = $message;
}

function addOldValue(string $key, mixed $value)
{
    $_SESSION['old'][$key] = $value;
}

function getFlashOld(string $key)
{
    $old = isset($_SESSION['old'][$key]) ? $_SESSION['old'][$key] : '';
    unset($_SESSION['old'][$key]);

    return $old;
}

function hasMessage(string $fieldName): bool
{
    return isset($_SESSION['message'][$fieldName]);
}

function addMessage(string $key, string $message)
{
    $_SESSION['message'][$key] = $message;
}

function getFlashMessage(string $key)
{
    $message = hasMessage($key) ? $_SESSION['message'][$key] : '';
    unset($_SESSION['message'][$key]);

    return $message;
}

function uploadAvatar(array $avatar, string $dir, string $prefix = '')
{
    $ext = pathinfo($avatar['name'], PATHINFO_EXTENSION);
    $fileName = $prefix.time().".$ext";
    $path = __DIR__."/../$dir"."/$fileName";

    if (! move_uploaded_file($avatar['tmp_name'], $path)) {
        exit('Cant upload avatar');
    }

    return "$dir/$fileName";
}

function initializePDO(): PDO
{
    try {
        return new \PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.';charset='.DB_CHARSET.';', DB_USERNAME, DB_PASSWORD);
    } catch (PDOException $ex) {
        exit($ex->getMessage());
    }
}

function findUser(string $email): array|bool
{
    $pdo = initializePDO();

    $sql = 'SELECT * FROM users WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);

    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

function currentUser()
{
    if (! isset($_SESSION['user'])) {
        return false;
    }

    $pdo = initializePDO();

    $userId = $_SESSION['user']['id'];
    $sql = 'SELECT * FROM users WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $userId]);

    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

function logout()
{
    unset($_SESSION['user']);
}

function isAuth()
{
    return isset($_SESSION['user']);
}
