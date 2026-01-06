<?php
/**
 * Page d'accueil
 *
 * Affiche uniquement :
 * - Agence de départ
 * - Date de départ
 * - Agence d'arrivée
 * - Date d'arrivée
 * - Nombre de places disponibles
 *
 * Les trajets sont déjà filtrés dans TripController :
 * - trajets futurs
 * - places disponibles
 */
?>

<h2 class="mb-4 mt-5">
    <?php if (!\Core\Auth::check()): ?>
        Pour obtenir plus d'informations sur un trajet, veuillez vous connecter
    <?php else: ?>
        Trajets proposés
    <?php endif; ?>
</h2>

<?php if (empty($trips)): ?>
    <div class="alert alert-info">
        Aucun trajet disponible pour le moment.
    </div>
<?php else: ?>

<table class="table table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>Départ</th>
            <th>Date de départ</th>
            <th>Arrivée</th>
            <th>Date d'arrivée</th>
            <th>Places</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($trips as $trip): ?>
        <tr>
            <td><?= htmlspecialchars($trip->departure_agency) ?></td>

            <td>
                <?= date('d/m/Y H:i', strtotime($trip->departure_datetime)) ?>
            </td>

            <td><?= htmlspecialchars($trip->arrival_agency) ?></td>

            <td>
                <?= date('d/m/Y H:i', strtotime($trip->arrival_datetime)) ?>
            </td>

            <td>
                <span>
                    <?= (int) $trip->available_seats ?>
                </span>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>








