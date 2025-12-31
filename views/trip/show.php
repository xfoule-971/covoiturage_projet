<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <h2 class="mb-4 text-center">Détails du trajet</h2>

        <ul class="list-group">
            <li class="list-group-item"><strong>Départ :</strong> <?= htmlspecialchars($trip->departure_agency) ?> à <?= $trip->departure_datetime ?></li>
            <li class="list-group-item"><strong>Arrivée :</strong> <?= htmlspecialchars($trip->arrival_agency) ?> à <?= $trip->arrival_datetime ?></li>
            <li class="list-group-item"><strong>Places disponibles :</strong> <?= $trip->available_seats ?>/<?= $trip->total_seats ?></li>
            <li class="list-group-item"><strong>Proposé par :</strong> <?= htmlspecialchars($trip->firstname . ' ' . $trip->lastname) ?></li>
            <li class="list-group-item"><strong>Email :</strong> <?= htmlspecialchars($trip->email) ?></li>
            <li class="list-group-item"><strong>Téléphone :</strong> <?= htmlspecialchars($trip->phone) ?></li>
        </ul>

        <?php if(isset($_SESSION['user']) && $_SESSION['user']->id == $trip->user_id): ?>
            <div class="mt-3">
                <a href="/covoiturage-projet/public/trip/edit/<?= $trip->id ?>" class="btn btn-warning">Modifier</a>
                <a href="/covoiturage-projet/public/trip/delete/<?= $trip->id ?>" class="btn btn-danger">Supprimer</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
