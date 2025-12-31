<div class="modal fade" id="tripDetailModal" tabindex="-1">
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

