<h2>Liste des agences</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom de l'agence</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($agencies as $agency): ?>
        <tr>
            <td><?= $agency->id ?></td>
            <td><?= htmlspecialchars($agency->name) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

