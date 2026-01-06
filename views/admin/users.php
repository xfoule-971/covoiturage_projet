<h1 class="mb-4 mt-5 pt-5">Liste des utilisateurs</h1>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= (int) $user->id ?></td>
                <td>
                    <?= htmlspecialchars($user->firstname) ?>
                    <?= htmlspecialchars($user->lastname) ?>
                </td>
                <td><?= htmlspecialchars($user->email) ?></td>
                <td>
                    <span class="badge bg-<?= $user->role === 'admin' ? 'danger' : 'secondary' ?>">
                        <?= htmlspecialchars($user->role) ?>
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


