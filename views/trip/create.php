<?php
use Core\Auth;
?>
<div class="container mt-4">
    <h2>Créer un nouveau trajet</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">

        <div class="mb-3">
            <label for="departure_agency" class="form-label">Agence de départ</label>
            <select name="departure_agency_id" id="departure_agency" class="form-select" required>
                <option value="">-- Choisir --</option>
                <?php foreach($agencies as $agency): ?>
                    <option value="<?= $agency->id ?>"><?= htmlspecialchars($agency->name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="arrival_agency" class="form-label">Agence d'arrivée</label>
            <select name="arrival_agency_id" id="arrival_agency" class="form-select" required>
                <option value="">-- Choisir --</option>
                <?php foreach($agencies as $agency): ?>
                    <option value="<?= $agency->id ?>"><?= htmlspecialchars($agency->name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="departure_datetime" class="form-label">Date & heure de départ</label>
            <input type="datetime-local" name="departure_datetime" id="departure_datetime" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="arrival_datetime" class="form-label">Date & heure d'arrivée</label>
            <input type="datetime-local" name="arrival_datetime" id="arrival_datetime" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="total_seats" class="form-label">Nombre total de places</label>
            <input type="number" name="total_seats" id="total_seats" class="form-control" min="1" max="10" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer le trajet</button>
    </form>
</div>
