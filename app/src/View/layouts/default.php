<nav class="navbar navbar-expand-lg bg-light mb-5">
<div class="container-fluid">
    <a class="navbar-brand" href="/articles">Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link" aria-current="page" href="/articles">Articles</a>
        </li>
        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])): ?>
        <li class="nav-item">
        <a class="nav-link" href="/articles/write">Ecrire mon article</a>
        </li>
            <?php if($_SESSION['user']['role'] == 'admin'): ?>
            <li class="nav-item">
            <a class="nav-link" href="/users">Liste d'utilisateurs</a>
            </li>
            <?php endif ?>
        <?php endif ?>
    </ul>
    <ul class="navbar-nav">
        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])): ?>
        <li class="nav-item">
            <a class="btn btn-danger" href="/users/logout">Me déconnecter</a>
        </li>
        <?php else: ?>
        <li class="nav-item">
            <a class="btn btn-primary" href="/users/login">Me connecter</a>
        </li>
        <li class="nav-item px-3">
            <a class="btn btn-primary" href="/users/register">M'inscrire</a>
        </li>
        <?php endif ?>
    </ul>
    </div>
</div>
</nav>
<main>
    <?= $content ?>
</main>
