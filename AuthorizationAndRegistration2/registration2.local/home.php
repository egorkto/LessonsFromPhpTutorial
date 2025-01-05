<?php
session_start();

require_once __DIR__.'/src/helpers.php';

if (! isAuth()) {
    redirect('index');
}

$user = currentUser();
?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">
<?php include_once __DIR__.'/components/head.php'; ?>
<body>

<div class="card home">
    <img
        class="avatar"
        src="<?= $user['avatar'] ?>"
        alt="<?= $user['name'] ?>"
    >
    <h1>Привет, <?= $user['name'] ?>!</h1>
    <form action="src/actions/logout.php" method="post">
        <button type="submit">Выйти из аккаунта</button>
    </form>
</div>

<?php include_once __DIR__.'/components/scripts.php'; ?>
</body>
</html>