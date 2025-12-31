<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covoiturage - MVC PHP</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="/covoiturage-projet/public/">Covoiturage</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <?php if (\Core\Auth::check()): ?>
                    <li class="nav-item">
                        <span class="nav-link">Bonjour <?= htmlspecialchars($_SESSION['user']->firstname) ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/covoiturage-projet/public/trips">Créer un trajet</a>
                    </li>
                    <?php if (\Core\Auth::isAdmin()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/covoiturage-projet/public/admin">Dashboard Admin</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/covoiturage-projet/public/logout">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/covoiturage-projet/public/login">Connexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container">




