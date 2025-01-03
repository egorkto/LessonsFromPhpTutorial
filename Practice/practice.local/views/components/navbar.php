<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">EGORPROG</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="/">Home <span class="sr-only">(current)</span></a>
        </div>
    </div>
    <div class="d-flex">
        <?php if (! isset($_SESSION['user'])) { ?>
            <a class="nav-item nav-link" href="/login">Login</a>
            <a class="nav-item nav-link" href="/register">Sign up</a>
        <?php } else { ?>
            <a class="nav-item nav-link" href="/profile">Profile</a>
            <form action="/auth/logout" method="post">
                <button type="submit" class="nav-item nav-link">Log out</button>
            </form>
        <?php } ?>
    </div>
</nav>