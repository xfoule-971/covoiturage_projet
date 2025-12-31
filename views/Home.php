<?php
use Core\Auth;
?>

<?php require __DIR__ . '/layout/header.php'; ?>

<h1 class="mb-4">Liste des trajets disponibles</h1>

<?php if(!empty($trips)): ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Départ</th>
                    <th>Date départ</th>
                    <th>Arrivée</th>
                    <th>Date arrivée</th>
                    <th>Places disponibles</th>
                    <?php if(Auth::check()): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($trips as $trip): ?>
                    <?php
                        // On ne montre que les trajets avec places disponibles et date future
                        $now = new DateTime();
                        $departure = new DateTime($trip->departure_datetime);
                        if($trip->available_seats <= 0 || $departure < $now) continue;
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($trip->departure_agency) ?></td>
                        <td><?= htmlspecialchars($trip->departure_datetime) ?></td>
                        <td><?= htmlspecialchars($trip->arrival_agency) ?></td>
                        <td><?= htmlspecialchars($trip->arrival_datetime) ?></td>
                        <td><?= htmlspecialchars($trip->available_seats) ?></td>
                        <?php if(Auth::check()): ?>
                            <td>
                                <!-- Bouton modale détails -->
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#tripModal<?= $trip->id ?>">Détails</button>

                                <?php if($_SESSION['user']->id == $trip->user_id): ?>
                                    <!-- Modifier / Supprimer si auteur -->
                                    <a href="/covoiturage-projet/public/trips/edit/<?= $trip->id ?>" class="btn btn-sm btn-warning">Modifier</a>
                                    <a href="/covoiturage-projet/public/trips/delete/<?= $trip->id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?');">Supprimer</a>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>

                    <!-- Modale détails -->
                    <div class="modal fade" id="tripModal<?= $trip->id ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Détails du trajet</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Proposé par :</strong> <?= htmlspecialchars($trip->firstname) ?> <?= htmlspecialchars($trip->lastname) ?></p>
                                    <p><strong>Téléphone :</strong> <?= htmlspecialchars($trip->phone) ?></p>
                                    <p><strong>Email :</strong> <?= htmlspecialchars($trip->email) ?></p>
                                    <p><strong>Total places :</strong> <?= htmlspecialchars($trip->total_seats) ?></p>
                                    <p><strong>Places disponibles :</strong> <?= htmlspecialchars($trip->available_seats) ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>Aucun trajet disponible pour le moment.</p>
<?php endif; ?>

<?php require __DIR__ . '/layout/footer.php'; ?>


