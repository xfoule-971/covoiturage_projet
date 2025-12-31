<?php
use Core\Auth;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Covoiturage Inter-sites</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="/covoiturage-projet/public/">Covoiturage</a>
        <div class="d-flex">
            <?php if(Auth::check()): ?>
                <?php if(Auth::isAdmin()): ?>
                    <a href="/covoiturage-projet/public/admin" class="btn btn-light me-2">Dashboard Admin</a>
                <?php else: ?>
                    <a href="/covoiturage-projet/public/trip/create" class="btn btn-light me-2">Créer un trajet</a>
                <?php endif; ?>
                <span class="navbar-text text-light me-2">
                    Bonjour <?= htmlspecialchars(Auth::user()->firstname) ?>
                </span>
                <a href="/covoiturage-projet/public/logout" class="btn btn-warning">Déconnexion</a>
            <?php else: ?>
                <a href="/covoiturage-projet/public/login" class="btn btn-light">Connexion</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container">



