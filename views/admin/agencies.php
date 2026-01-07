<h2 class="mb-4 mt-4 pt-5">Gestion des agences</h2>

<!-- Bouton création -->
<a href="/covoiturage-projet/public/admin/agencies/create"
   class="btn btn-success mb-3">
    Ajouter une agence
</a>

<table class="table table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nom de l’agence</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($agencies as $agency): ?>
        <tr>
            <td><?= $agency->id ?></td>
            <td><?= htmlspecialchars($agency->name) ?></td>
            <td class="text-center">

                <!-- Modifier -->
                <a href="/covoiturage-projet/public/admin/agencies/edit?id=<?= $agency->id ?>"
                   class="btn btn-sm btn-outline-primary mx-1">
                     Modifier
                </a>

                <!-- Supprimer -->
                <a href="/covoiturage-projet/public/admin/agencies/delete?id=<?= $agency->id ?>"
                   class="btn btn-sm btn-outline-danger mx-1"
                   onclick="return confirm('Supprimer cette agence ?');">
                    Supprimer
                </a>

            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

