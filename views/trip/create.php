<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <h2 class="mb-4 text-center">Créer un trajet</h2>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="departure_agency" class="form-label">Agence de départ</label>
                <select name="departure_agency_id" id="departure_agency" class="form-select" required>
                    <?php foreach($agencies as $agency): ?>
                        <option value="<?= $agency->id ?>"><?= htmlspecialchars($agency->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="arrival_agency" class="form-label">Agence d’arrivée</label>
                <select name="arrival_agency_id" id="arrival_agency" class="form-select" required>
                    <?php foreach($agencies as $agency): ?>
                        <option value="<?= $agency->id ?>"><?= htmlspecialchars($agency->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <input type="datetime-local" name="departure_datetime" class="form-control" placeholder="Date et heure de départ" required>
            </div>

            <div class="mb-3">
                <input type="datetime-local" name="arrival_datetime" class="form-control" placeholder="Date et heure d’arrivée" required>
            </div>

            <div class="mb-3">
                <input type="number" name="total_seats" class="form-control" placeholder="Nombre total de places" min="1" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Créer le trajet</button>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
