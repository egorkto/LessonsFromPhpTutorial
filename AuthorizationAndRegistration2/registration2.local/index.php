<?php
session_start();

require_once __DIR__.'/src/helpers.php';

if (isAuth()) {
    redirect('home');
}

?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">
<?php include_once __DIR__.'/components/head.php'; ?>
<body>

<form class="card" method="post" action="src/actions/login.php">
    <h2>Вход</h2>
    <?php if (hasMessage('error')) { ?>
        <div class="notice error">
            <?= getFlashMessage('error'); ?>
        </div>
    <?php } ?>
    <label for="name">
        Email
        <input
            type="text"
            id="email"
            name="email"
            placeholder="test@mail.com"
            value="<?= getFlashOld('email') ?>"
            <?= checkError('email') ?>
        >
    <?php if (hasError('email')) { ?>
        <small>
            <?= getFlashError('email') ?>
        </small>
    <?php } ?>
    </label>

    <label for="password">
        Пароль
        <input
            type="password"
            id="password"
            name="password"
            placeholder="******"
            value="<?= getFlashOld('password') ?>"
            <?= checkError('password') ?>
        >
    <?php if (hasError('password')) { ?>
        <small>
            <?= getFlashError('password') ?>
        </small>
    <?php } ?>
    </label>

    <button
        type="submit"
        id="submit"
    >Продолжить</button>
</form>

<p>У меня еще нет <a href="/register.php">аккаунта</a></p>

<?php include_once __DIR__.'/components/scripts.php'; ?>
</body>
</html>