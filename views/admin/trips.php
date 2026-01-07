<h2 class="mb-4 mt-4 pt-5">Tous les trajets</h2>

<table class="table table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>Départ</th>
            <th>Date</th>
            <th>Destination</th>
            <th>Date</th>
            <th>Places</th>
            <th>Auteur</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($trips as $trip): ?>
        <tr>
            <td><?= htmlspecialchars($trip->departure_agency) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($trip->departure_datetime)) ?></td>

            <td><?= htmlspecialchars($trip->arrival_agency) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($trip->arrival_datetime)) ?></td>

            <td><?= $trip->available_seats ?> / <?= $trip->total_seats ?></td>

            <td>
                <?= htmlspecialchars($trip->firstname) ?>
                <?= htmlspecialchars($trip->lastname) ?>
            </td>

            <td class="text-center">
                <a href="/covoiturage-projet/public/admin/trips/delete?id=<?= $trip->id ?>"
                   class="btn btn-sm btn-outline-danger"
                   onclick="return confirm('Supprimer ce trajet ?');">
                    Supprimer
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

