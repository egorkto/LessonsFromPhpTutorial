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

<form class="card" action="src/actions/register.php" method="post" enctype="multipart/form-data">
    <h2>Регистрация</h2>

    <label for="name">
        Имя
        <input
            type="text"
            id="name"
            name="name"
            placeholder="Иванов Иван"
            value="<?= getFlashOld('name') ?>"
            <?= checkError('name') ?>
        >
    <?php if (hasError('name')) { ?>
        <small>
            <?= getFlashError('name') ?>
        </small>
    <?php } ?>
    </label>
    <label for="email">
        E-mail
        <input
            type="text"
            id="email"
            name="email"
            placeholder="ivan@areaweb.su"
            value="<?= getFlashOld('email') ?>"
            <?= checkError('email') ?>
        >
    <?php if (hasError('email')) { ?>
        <small>
            <?= getFlashError('email') ?>
        </small>
    <?php } ?>
    </label>

    <label for="avatar">Изображение профиля
        <input
            type="file"
            id="avatar"
            name="avatar"
            <?= checkError('avatar') ?>
        >
        <?php if (hasError('avatar')) { ?>
            <small>
                <?= getFlashError('avatar') ?>
            </small>
        <?php } ?>
    </label>

    <div class="grid">
        <div>
            <label for="password">
                Пароль
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="******"
                    <?= checkError('password') ?>
                >
            <?php if (hasError('password')) { ?>
                <small>
                    <?= getFlashError('password') ?>
                </small>
            <?php } ?>
            </label>
        </div>
        <div>
            <label for="password_confirmation">
                Подтверждение
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="******"
                    <?= checkError('password_confirmation') ?>
                >
            <?php if (hasError('password_confirmation')) { ?>
                <small>
                    <?= getFlashError('password_confirmation') ?>
                </small>
            <?php } ?>
            </label>
        </div>
    </div>

    <fieldset>
        <label for="terms">
            <input
                type="checkbox"
                id="terms"
                name="terms"
            >
            Я принимаю все условия пользования
        </label>
    </fieldset>

    <button
        type="submit"
        id="submit"
        disabled
    >Продолжить</button>
</form>

<p>У меня уже есть <a href="/login.php">аккаунт</a></p>

<?php include_once __DIR__.'/components/scripts.php'; ?>
</body>
</html>