<?php
/**
 * Accueil utilisateur connecté
 *
 * - Liste des trajets
 * - Responsive mobile
 * - Colonne ACTIONS toujours visible
 * - Icônes Voir / Modifier / Supprimer conservées
 */
?>

<h2 class="mb-4 mt-5 pt-5">
    Trajets proposés
</h2>

<?php if (empty($trips)): ?>

    <div class="alert alert-info">
        Aucun trajet disponible pour le moment.
    </div>

<?php else: ?>

<!-- ========================= -->
<!-- TABLE RESPONSIVE -->
<!-- ========================= -->
<div class="table-responsive">

<table class="table table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>Départ</th>

            <!-- Date départ cachée mobile -->
            <th class="d-none d-md-table-cell">Date</th>
            <th class="d-none d-md-table-cell">Heure</th>

            <th>Arrivée</th>

            <!-- Date arrivée cachée mobile -->
            <th class="d-none d-md-table-cell">Date</th>
            <th class="d-none d-md-table-cell">Heure</th>

            <th>Places</th>

            <!-- ACTIONS toujours visibles -->
            <th class="text-center">Actions</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($trips as $trip): ?>
        <tr>
            <!-- Départ -->
            <td><?= htmlspecialchars($trip->departure_agency) ?></td>

            <td class="d-none d-md-table-cell">
                <?= date('d/m/Y', strtotime($trip->departure_datetime)) ?>
            </td>

            <td class="d-none d-md-table-cell">
                <?= date('H:i', strtotime($trip->departure_datetime)) ?>
            </td>

            <!-- Arrivée -->
            <td><?= htmlspecialchars($trip->arrival_agency) ?></td>

            <td class="d-none d-md-table-cell">
                <?= date('d/m/Y', strtotime($trip->arrival_datetime)) ?>
            </td>

            <td class="d-none d-md-table-cell">
                <?= date('H:i', strtotime($trip->arrival_datetime)) ?>
            </td>

            <!-- Places -->
            <td class="fw-bold">
                <?= (int) $trip->available_seats ?>
            </td>

            <!-- ================= -->
            <!-- ACTIONS -->
            <!-- ================= -->
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">

                    <!-- Voir -->
                    <button
                        class="btn btn-sm btn-outline-dark"
                        data-bs-toggle="modal"
                        data-bs-target="#tripModal<?= $trip->id ?>"
                        title="Voir détails"
                    >
                        <img src="/covoiturage-projet/public/assets/icons/oeil.png" alt="Voir">
                    </button>

                    <?php if (
                        $_SESSION['user']->id === $trip->user_id
                        || \Core\Auth::isAdmin()
                    ): ?>

                        <!-- Modifier -->
                        <button
                            class="btn btn-sm btn-outline-dark"
                            data-bs-toggle="modal"
                            data-bs-target="#tripModalEdit<?= $trip->id ?>"
                            title="Modifier"
                        >
                            <img src="/covoiturage-projet/public/assets/icons/ecrivain.png" alt="Modifier">
                        </button>

                        <!-- Supprimer -->
                        <a
                            href="/covoiturage-projet/public/trips/delete/<?= $trip->id ?>"
                            class="btn btn-sm btn-outline-danger"
                            title="Supprimer"
                            onclick="return confirm('Supprimer ce trajet ?')"
                        >
                            <img src="/covoiturage-projet/public/assets/icons/poubelle.png" alt="Supprimer">
                        </a>

                    <?php endif; ?>

                </div>
            </td>
        </tr>

        <!-- ========================= -->
        <!-- MODALE DETAIL -->
        <!-- ========================= -->
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
                        <p><strong>Téléphone :</strong>
                            <?= htmlspecialchars($trip->phone) ?>
                        </p>
                        <p><strong>Email :</strong>
                            <?= htmlspecialchars($trip->email) ?>
                        </p>
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

</div>

<?php endif; ?>



