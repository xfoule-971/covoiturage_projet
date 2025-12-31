<h2>Liste des utilisateurs</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= htmlspecialchars($user->lastname) ?></td>
            <td><?= htmlspecialchars($user->firstname) ?></td>
            <td><?= htmlspecialchars($user->email) ?></td>
            <td><?= $user->role ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

