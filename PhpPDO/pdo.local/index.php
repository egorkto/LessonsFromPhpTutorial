<?php

$host = 'MySQL-8.2';
$port = 3306;
$dbname = 'pdo';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
} catch (PDOException $exception) {
    echo $exception->getMessage();
}

$sql = 'SELECT * FROM users';

$stmt = $pdo->query($sql);

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$userId = 1;
$userEmail = 'test@ya.com';
$sql = 'SELECT * FROM users WHERE id = :id AND email = :email';

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'id' => $userId,
    'email' => $userEmail,
]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<pre>
    <?php print_r($users) ?>
</pre>

<pre>
    <?php print_r($user) ?>
</pre>

<?php

$name = 'Alex';
$email = 'alex@mail.com';
$password = '14758679';

$sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'password' => $password,
    ]);
} catch (PDOException $exception) {
    echo $exception->getMessage();
}

$userId = 2;
$newPassword = 'sfhdtyrsy675468351drhgshnto2346h2orgn4';
$sql = 'UPDATE users SET password = :password WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'password' => $newPassword,
    'id' => $userId,
]);

$userId = 2;
$sql = 'DELETE FROM users WHERE id = :id';

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'id' => $userId,
]);
