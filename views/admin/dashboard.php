<?php
/**
 * Dashboard Administrateur
 *
 * Page d'accueil de l'administration
 * - accessible uniquement aux admins
 * - sert de menu central
 */
?>

<div class="container mt-5">

    <!-- TITRE -->
    <h2 class="mb-4">Tableau de bord administrateur</h2>

    <!-- TEXTE INTRO -->
    <p class="text-muted">
        Depuis ce tableau de bord, vous pouvez gérer l’ensemble de l’application :
        utilisateurs, agences et trajets.
    </p>

    <!-- BLOCS DE NAVIGATION -->
    <div class="row mt-4">

        <!-- UTILISATEURS -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Utilisateurs</h5>
                    <p class="card-text">
                        Consulter la liste des utilisateurs inscrits.
                    </p>
                    <a href="/covoiturage-projet/public/admin/users"
                       class="btn btn-secondary w-100">
                        Gérer les utilisateurs
                    </a>
                </div>
            </div>
        </div>

        <!-- AGENCES -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Agences</h5>
                    <p class="card-text">
                        Créer, modifier ou supprimer les agences.
                    </p>
                    <a href="/covoiturage-projet/public/admin/agencies"
                       class="btn btn-secondary w-100">
                        Gérer les agences
                    </a>
                </div>
            </div>
        </div>

        <!-- TRAJETS -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Trajets</h5>
                    <p class="card-text">
                        Visualiser et supprimer les trajets existants.
                    </p>
                    <a href="/covoiturage-projet/public/admin/trips"
                       class="btn btn-secondary w-100">
                        Gérer les trajets
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

