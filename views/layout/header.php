<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covoiturage - MVC PHP</title>

    <!-- ===================== -->
    <!-- Bootstrap CSS -->
    <!-- ===================== -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- ===================== -->
    <!-- CSS application -->
    <!-- ===================== -->
    <link rel="stylesheet" href="/covoiturage-projet/public/assets/style.css">
</head>

<body>

<!-- ========================= -->
<!-- NAVBAR -->
<!-- ========================= -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">

        <!-- ===================== -->
        <!-- LOGO / TITRE -->
        <!-- ===================== -->
        <a class="navbar-brand fw-bold" href="/covoiturage-projet/public/">
            Covoiturage
        </a>

        <!-- ===================== -->
        <!-- BURGER (mobile) -->
        <!-- ===================== -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- ===================== -->
        <!-- MENU -->
        <!-- ===================== -->
        <div class="collapse navbar-collapse" id="mainNavbar">

            <!-- ===================== -->
            <!-- MENU GAUCHE -->
            <!-- ===================== -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <?php if (\Core\Auth::check()): ?>

                    <!-- Accueil utilisateur -->
                    <li class="nav-item">
                        <a class="nav-link"
                           href="/covoiturage-projet/public/homeuser">
                            Accueil
                        </a>
                    </li>

                    <!-- ===================== -->
                    <!-- MENU ADMIN -->
                    <!-- ===================== -->
                    <?php if (\Core\Auth::isAdmin()): ?>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="/covoiturage-projet/public/admin">
                                Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="/covoiturage-projet/public/admin/users">
                                Utilisateurs
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="/covoiturage-projet/public/admin/agencies">
                                Agences
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="/covoiturage-projet/public/admin/trips">
                                Trajets
                            </a>
                        </li>

                    <?php endif; ?>

                <?php endif; ?>

            </ul>

            <!-- ===================== -->
            <!-- MENU DROIT -->
            <!-- ===================== -->
            <ul class="navbar-nav ms-auto align-items-lg-center">

                <?php if (\Core\Auth::check()): ?>

                    <!-- Créer un trajet -->
                    <li class="nav-item me-lg-3 mb-2 mb-lg-0">
                        <a href="/covoiturage-projet/public/trips/create"
                           class="btn btn-success btn-sm">
                            + Trajet
                        </a>
                    </li>

                    <!-- Bonjour -->
                    <li class="nav-item me-lg-3 text-white">
                        <span class="navbar-text">
                            Bonjour
                            <?= htmlspecialchars($_SESSION['user']->firstname) ?>
                        </span>
                    </li>

                    <!-- Déconnexion -->
                    <li class="nav-item">
                        <a href="/covoiturage-projet/public/logout"
                           class="btn btn-danger btn-sm">
                            Déconnexion
                        </a>
                    </li>

                <?php else: ?>

                    <!-- Connexion -->
                    <li class="nav-item">
                        <a href="/covoiturage-projet/public/login"
                           class="btn btn-warning btn-sm">
                            Connexion
                        </a>
                    </li>

                <?php endif; ?>

            </ul>

        </div>
    </div>
</nav>

<!-- ========================= -->
<!-- CONTENU PRINCIPAL -->
<!-- ========================= -->
<div class="container">







