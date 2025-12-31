<h2>Liste des trajets</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Départ</th>
            <th>Arrivée</th>
            <th>Date départ</th>
            <th>Date arrivée</th>
            <th>Places dispo</th>
            <th>Auteur</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($trips as $trip): ?>
        <tr>
            <td><?= $trip->id ?></td>
            <td><?= htmlspecialchars($trip->departure_agency) ?></td>
            <td><?= htmlspecialchars($trip->arrival_agency) ?></td>
            <td><?= $trip->departure_datetime ?></td>
            <td><?= $trip->arrival_datetime ?></td>
            <td><?= $trip->available_seats ?></td>
            <td><?= htmlspecialchars($trip->firstname . ' ' . $trip->lastname) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

