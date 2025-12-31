<?php
use Core\Auth;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Covoiturage Intranet</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <!-- Nom de l'application -->
        <?php if(Auth::isAdmin()): ?>
            <a class="navbar-brand" href="/covoiturage-projet/public/admin">Covoiturage Intranet</a>
        <?php else: ?>
            <a class="navbar-brand" href="/covoiturage-projet/public/">Covoiturage Intranet</a>
        <?php endif; ?>

        <!-- Hamburger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if(Auth::check()): ?>
                    <li class="nav-item">
                        <span class="nav-link">Bonjour <?= htmlspecialchars($_SESSION['user']->firstname) ?></span>
                    </li>

                    <?php if(Auth::isAdmin()): ?>
                        <li class="nav-item"><a class="nav-link" href="/covoiturage-projet/public/admin">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="/covoiturage-projet/public/users">Utilisateurs</a></li>
                        <li class="nav-item"><a class="nav-link" href="/covoiturage-projet/public/agencies">Agences</a></li>
                        <li class="nav-item"><a class="nav-link" href="/covoiturage-projet/public/trips">Trajets</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/covoiturage-projet/public/trips/create">Créer un trajet</a></li>
                    <?php endif; ?>

                    <li class="nav-item"><a class="nav-link" href="/covoiturage-projet/public/logout">Déconnexion</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/covoiturage-projet/public/login">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-4">


