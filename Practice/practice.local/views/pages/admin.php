<?php
use App\Services\Page;
use App\Services\Router;

if (! isset($_SESSION['user']) || $_SESSION['user']['group'] === 1) {
    Router::redirect('/');
}
?>

<?php Page::part('start') ?>
<?php Page::part('navbar') ?>

<div class="container">
    <div class="jumbotron mt-4">
        <h1 class="display-4">Dashboard</h1>
    </div>
</div>

<?php Page::part('end') ?>