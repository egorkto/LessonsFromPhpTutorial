<?php
session_start();

use App\Services\Page;
use App\Services\Router;

if (! isset($_SESSION['user'])) {
    Router::redirect('/login');
}

$fullName = $_SESSION['user']['full_name'];
$email = $_SESSION['user']['email'];
$avatar = $_SESSION['user']['avatar'];
$username = $_SESSION['user']['username'];

?>

<?php Page::part('start') ?>
<?php Page::part('navbar') ?>

<div class="container">
    <div class="jumbotron mt-4">
        <h1 class="display-4">Hello, <?= $fullName ?></h1>
        <img src="<?= $avatar ?>" height="300px" alt="avatar">
    </div>
</div>

<?php Page::part('end') ?>