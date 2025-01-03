<?php
use App\Services\Page;
use App\Services\Router;

if (isset($_SESSION['user'])) {
    Router::redirect('/profile');
}

?>

<?php Page::part('start') ?>
<?php Page::part('navbar') ?>

<div class="container">
    <h2 class="mt-4">Login</h2>
    <form class="mt-4" method="post" action="/auth/login">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php Page::part('end') ?>