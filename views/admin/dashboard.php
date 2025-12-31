<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Tableau de bord Administrateur</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card p-3 mb-3">
                <h5>Utilisateurs</h5>
                <a href="/covoiturage-projet/public/admin/users" class="btn btn-primary btn-sm mt-2">Voir la liste</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 mb-3">
                <h5>Agences</h5>
                <a href="/covoiturage-projet/public/admin/agencies" class="btn btn-primary btn-sm mt-2">Gérer les agences</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 mb-3">
                <h5>Trajets</h5>
                <a href="/covoiturage-projet/public/admin/trips" class="btn btn-primary btn-sm mt-2">Voir tous les trajets</a>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
