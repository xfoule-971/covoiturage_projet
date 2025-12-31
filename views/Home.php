<?php
use Core\Auth;
?>

<div class="container mt-4">
    <h2>Liste des trajets disponibles</h2>

    <?php if (empty($trips)): ?>
        <p>Aucun trajet disponible pour le moment.</p>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php foreach($trips as $trip): ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= htmlspecialchars($trip->departure_agency) ?> → <?= htmlspecialchars($trip->arrival_agency) ?>
                            </h5>
                            <p class="card-text">
                                <strong>Départ :</strong> <?= $trip->departure_datetime ?><br>
                                <strong>Arrivée :</strong> <?= $trip->arrival_datetime ?><br>
                                <strong>Places disponibles :</strong> <?= $trip->available_seats ?> / <?= $trip->total_seats ?>
                            </p>

                            <!-- Bouton Détails -->
                            <?php if(Auth::check()): ?>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#tripDetailModal<?= $trip->id ?>">
                                    Détails
                                </button>

                                <!-- Si l'utilisateur est l'auteur, afficher Modifier/Supprimer -->
                                <?php if(Auth::user()->id == $trip->user_id): ?>
                                    <a href="/covoiturage-projet/public/trip/edit?id=<?= $trip->id ?>" class="btn btn-warning btn-sm">Modifier</a>
                                    <form method="POST" action="/covoiturage-projet/public/trip/delete?id=<?= $trip->id ?>" class="d-inline" onsubmit="return confirm('Supprimer ce trajet ?');">
                                        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Modal Détails -->
                <div class="modal fade" id="tripDetailModal<?= $trip->id ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Détails du trajet</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Départ :</strong> <?= htmlspecialchars($trip->departure_agency) ?> - <?= $trip->departure_datetime ?></p>
                                <p><strong>Arrivée :</strong> <?= htmlspecialchars($trip->arrival_agency) ?> - <?= $trip->arrival_datetime ?></p>
                                <p><strong>Places disponibles :</strong> <?= $trip->available_seats ?> / <?= $trip->total_seats ?></p>
                                <p><strong>Proposé par :</strong> <?= htmlspecialchars($trip->firstname . ' ' . $trip->lastname) ?></p>
                                <p><strong>Email :</strong> <?= htmlspecialchars($trip->email) ?></p>
                                <p><strong>Téléphone :</strong> <?= htmlspecialchars($trip->phone) ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>



