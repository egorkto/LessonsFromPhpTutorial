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
    <h2 class="mt-4">Sign up</h2>
    <form class="mt-4" method="post" action="/auth/register" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="full_name">Full name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Fulname">
        </div>
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="file" class="form-control" id="avatar" name="avatar" placeholder="Full name">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="password_confirm">Password Confirmation</label>
            <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Password confirmation">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php Page::part('end') ?>