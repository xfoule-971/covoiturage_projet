<h2 class="mb-4">Trajets proposés</h2>

<table class="table table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>Départ</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Destination</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Places</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($trips as $trip): ?>
        <tr>
            <td><?= htmlspecialchars($trip->departure_agency) ?></td>
            <td><?= date('d/m/Y', strtotime($trip->departure_datetime)) ?></td>
            <td><?= date('H:i', strtotime($trip->departure_datetime)) ?></td>

            <td><?= htmlspecialchars($trip->arrival_agency) ?></td>
            <td><?= date('d/m/Y', strtotime($trip->arrival_datetime)) ?></td>
            <td><?= date('H:i', strtotime($trip->arrival_datetime)) ?></td>

            <td class="fw-bold"><?= $trip->available_seats ?></td>

            <!-- ACTIONS -->
            <td class="text-center">
                <div class="btn-group" role="group">

                    <!-- Voir détails -->
                    <button
                        class="btn btn-sm btn-outline-dark"
                        data-bs-toggle="modal"
                        data-bs-target="#tripModal<?= $trip->id ?>"
                        title="Voir détails"
                    >
                        👁️
                    </button>

                    <?php if ($_SESSION['user']->id === $trip->user_id || \Core\Auth::isAdmin()): ?>

                        <!-- Modifier -->
                        <a
                            href="/covoiturage-projet/public/trips/edit/<?= $trip->id ?>"
                            class="btn btn-sm btn-outline-warning"
                            title="Modifier"
                        >
                            ✏️
                        </a>

                        <!-- Supprimer -->
                        <a
                            href="/covoiturage-projet/public/trips/delete/<?= $trip->id ?>"
                            class="btn btn-sm btn-outline-danger"
                            title="Supprimer"
                            onclick="return confirm('Supprimer ce trajet ?')"
                        >
                            🗑️
                        </a>

                    <?php endif; ?>

                </div>
            </td>
        </tr>

        <!-- MODALE DÉTAIL -->
        <div class="modal fade" id="tripModal<?= $trip->id ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Détails du trajet</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p><strong>Auteur :</strong>
                            <?= htmlspecialchars($trip->firstname . ' ' . $trip->lastname) ?>
                        </p>
                        <p><strong>Téléphone :</strong> <?= htmlspecialchars($trip->phone) ?></p>
                        <p><strong>Email :</strong> <?= htmlspecialchars($trip->email) ?></p>
                        <hr>
                        <p><strong>Places totales :</strong> <?= $trip->total_seats ?></p>
                        <p><strong>Places disponibles :</strong> <?= $trip->available_seats ?></p>
                    </div>

                </div>
            </div>
        </div>

    <?php endforeach; ?>
    </tbody>
</table>

