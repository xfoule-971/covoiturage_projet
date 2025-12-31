<h2>Trajets disponibles</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Départ</th>
            <th>Arrivée</th>
            <th>Date départ</th>
            <th>Date arrivée</th>
            <th>Places dispo</th>
            <th>Auteur</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($trips as $trip): ?>
        <?php if($trip->available_seats > 0 && strtotime($trip->departure_datetime) > time()): ?>
        <tr>
            <td><?= htmlspecialchars($trip->departure_agency) ?></td>
            <td><?= htmlspecialchars($trip->arrival_agency) ?></td>
            <td><?= $trip->departure_datetime ?></td>
            <td><?= $trip->arrival_datetime ?></td>
            <td><?= $trip->available_seats ?></td>
            <td><?= htmlspecialchars($trip->firstname . ' ' . $trip->lastname) ?></td>
            <td>
                <?php if(\Core\Auth::check()): ?>
                    <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#tripModal<?= $trip->id ?>">Détails</a>
                    <?php if($_SESSION['user']->id == $trip->user_id || \Core\Auth::isAdmin()): ?>
                        <a href="#" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="#" class="btn btn-sm btn-danger">Supprimer</a>
                    <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>
        <!-- Modal détail trajet -->
        <div class="modal fade" id="tripModal<?= $trip->id ?>" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Détails du trajet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <p><strong>Contact :</strong> <?= htmlspecialchars($trip->firstname . ' ' . $trip->lastname) ?></p>
                <p><strong>Téléphone :</strong> <?= htmlspecialchars($trip->phone) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($trip->email) ?></p>
                <p><strong>Places totales :</strong> <?= $trip->total_seats ?></p>
                <p><strong>Places disponibles :</strong> <?= $trip->available_seats ?></p>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>






