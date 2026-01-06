<?php
use Core\Auth;
?>

<h2 class="mb-5 mt-5 pt-5">Trajets proposés</h2>

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
                        <img src="../public/assets/icons/oeil.png" alt="oeil"/>
                    </button>

                    <?php if ($_SESSION['user']->id === $trip->user_id || Auth::isAdmin()): ?>

                        <!-- Modifier -->
                        <button
                            class="btn btn-sm btn-outline-warning mx-3"
                            data-bs-toggle="modal"
                            data-bs-target="#tripModalEdit<?= $trip->id ?>"
                            title="Modifier"
                        >
                            <img src="../public/assets/icons/ecrivain.png" alt="page d'écriture"/>
                        </button>

                        <!-- Supprimer -->
                        <a
                            href="/covoiturage-projet/public/trips/delete/<?= $trip->id ?>"
                            class="btn btn-sm btn-outline-danger"
                            title="Supprimer"
                            onclick="return confirm('Supprimer ce trajet ?')"
                        >
                            <img src="../public/assets/icons/poubelle.png" alt="poubelle"/>
                        </a>

                    <?php endif; ?>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<!-- ================= MODALES ================= -->

<?php foreach ($trips as $trip): ?>

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

<!-- MODALE EDIT -->
<div class="modal fade" id="tripModalEdit<?= $trip->id ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form method="POST" action="/covoiturage-projet/public/trips/edit/<?= $trip->id ?>">

                <div class="modal-header">
                    <h5 class="modal-title">Modifier le trajet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Agence de départ</label>
                        <select name="departure_agency_id" class="form-select" required>
                            <?php foreach ($agencies as $agency): ?>
                                <option value="<?= $agency->id ?>"
                                    <?= $agency->id == $trip->departure_agency_id ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($agency->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Agence d'arrivée</label>
                        <select name="arrival_agency_id" class="form-select" required>
                            <?php foreach ($agencies as $agency): ?>
                                <option value="<?= $agency->id ?>"
                                    <?= $agency->id == $trip->arrival_agency_id ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($agency->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date & heure de départ</label>
                        <input type="datetime-local" name="departure_datetime"
                            class="form-control"
                            value="<?= date('Y-m-d\TH:i', strtotime($trip->departure_datetime)) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date & heure d'arrivée</label>
                        <input type="datetime-local" name="arrival_datetime"
                            class="form-control"
                            value="<?= date('Y-m-d\TH:i', strtotime($trip->arrival_datetime)) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre total de places</label>
                        <input type="number" name="total_seats"
                            class="form-control"
                            min="1" max="10"
                            value="<?= $trip->total_seats ?>" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php endforeach; ?>


