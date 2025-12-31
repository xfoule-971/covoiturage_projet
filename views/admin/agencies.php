<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Gérer les agences</h2>

    <a href="/covoiturage-projet/public/admin/agency/create" class="btn btn-success mb-3">Créer une agence</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de l'agence</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($agencies as $agency): ?>
                <tr>
                    <td><?= $agency->id ?></td>
                    <td><?= htmlspecialchars($agency->name) ?></td>
                    <td>
                        <a href="/covoiturage-projet/public/admin/agency/edit/<?= $agency->id ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="/covoiturage-projet/public/admin/agency/delete/<?= $agency->id ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
