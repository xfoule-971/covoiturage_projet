<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covoiturage - MVC PHP</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">

        <!-- ===================== -->
        <!-- GAUCHE : Nom appli -->
        <!-- ===================== -->

        <?php if (\Core\Auth::isAdmin()): ?>
            <!-- Admin : lien vers dashboard -->
            <a class="navbar-brand" href="/covoiturage-projet/public/admin">
                Covoiturage
            </a>
        <?php else: ?>
            <!-- Visiteur / utilisateur : lien accueil -->
            <a class="navbar-brand" href="/covoiturage-projet/public/">
                Covoiturage
            </a>
        <?php endif; ?>

        <!-- ===================== -->
        <!-- DROITE : Actions -->
        <!-- ===================== -->

        <ul class="navbar-nav ms-auto align-items-center">

            <?php if (\Core\Auth::check()): ?>

                <!-- 1️⃣ Créer un trajet -->
                <li class="nav-item me-2">
                    <a href="/covoiturage-projet/public/trips/create"
                       class="btn btn-success">
                        Créer un trajet
                    </a>
                </li>

                <!-- 2️⃣ Bonjour prénom nom -->
                <li class="nav-item me-3">
                    <span class="navbar-text text-white">
                        Bonjour
                        <?= htmlspecialchars($_SESSION['user']->firstname) ?>
                        <?= htmlspecialchars($_SESSION['user']->lastname) ?>
                    </span>
                </li>

                <!-- 3️⃣ Déconnexion -->
                <li class="nav-item">
                    <a href="/covoiturage-projet/public/logout"
                       class="btn btn-danger">
                        Déconnexion
                    </a>
                </li>

            <?php else: ?>

                <!-- VISITEUR : Connexion -->
                <li class="nav-item">
                    <a href="/covoiturage-projet/public/login"
                       class="btn btn-warning">
                        Connexion
                    </a>
                </li>

            <?php endif; ?>

        </ul>
    </div>
</nav>

<!-- Contenu principal -->
<div class="container">





