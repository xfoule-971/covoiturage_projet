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

    <!-- CSS application -->
    <link rel="stylesheet" href="/covoiturage-projet/public/assets/style.css">

</head>

<body>

<!-- ========================= -->
<!-- BARRE DE NAVIGATION -->
<!-- ========================= -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5 navigation">
    <div class="container">

        <!-- ===================== -->
        <!-- GAUCHE : Nom appli -->
        <!-- ===================== -->

        <?php if (\Core\Auth::isAdmin()): ?>
            <!-- Admin : lien vers dashboard -->
            <a class="navbar-brand fw-bold" href="/covoiturage-projet/public/admin">
                Touche pas au klaxon
            </a>
        <?php else: ?>
            <!-- Visiteur / utilisateur -->
            <a class="navbar-brand fw-bold" href="/covoiturage-projet/public/">
                Touche pas au klaxon
            </a>
        <?php endif; ?>

        <!-- ===================== -->
        <!-- CENTRE : MENU ADMIN -->
        <!-- ===================== -->

        <?php if (\Core\Auth::isAdmin()): ?>
            <ul class="navbar-nav mx-auto">

                <li class="nav-item mx-2">
                    <a class="btn btn-light btn-sm"
                       href="/covoiturage-projet/public/admin/users">
                        Utilisateurs
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="btn btn-light btn-sm"
                       href="/covoiturage-projet/public/admin/agencies">
                        Agences
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="btn btn-light btn-sm"
                       href="/covoiturage-projet/public/admin/trips">
                        Trajets
                    </a>
                </li>

            </ul>
        <?php endif; ?>

        <!-- ===================== -->
        <!-- DROITE : ACTIONS -->
        <!-- ===================== -->

        <ul class="navbar-nav ms-auto align-items-center">

            <?php if (\Core\Auth::check()): ?>

                <!-- Créer un trajet (utilisateur uniquement) -->
                <?php if (!\Core\Auth::isAdmin()): ?>
                    <li class="nav-item mx-3">
                        <a href="/covoiturage-projet/public/trips/create"
                           class="btn btn-success">
                            Créer un trajet
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Bonjour prénom nom -->
                <li class="nav-item mx-3">
                    <span class="navbar-text text-white">
                        Bonjour
                        <?= htmlspecialchars($_SESSION['user']->firstname) ?>
                        <?= htmlspecialchars($_SESSION['user']->lastname) ?>
                    </span>
                </li>

                <!-- Déconnexion -->
                <li class="nav-item mx-3">
                    <a href="/covoiturage-projet/public/logout"
                       class="btn btn-dark">
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

<!-- ========================= -->
<!-- CONTENU PRINCIPAL -->
<!-- ========================= -->
<div class="container">





