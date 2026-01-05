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

        <!-- Agence de départ -->
        <div class="mb-3">
            <select name="departure_agency_id" class="form-select" required>
                <option value="">Agence de départ</option>
                <?php foreach ($agencies as $agency): ?>
                    <option value="<?= $agency->id ?>">
                        <?= htmlspecialchars($agency->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Agence d'arrivée -->
        <div class="mb-3">
            <select name="arrival_agency_id" class="form-select" required>
                <option value="">Agence d'arrivée</option>
                <?php foreach ($agencies as $agency): ?>
                    <option value="<?= $agency->id ?>">
                        <?= htmlspecialchars($agency->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Date / heure départ -->
        <div class="mb-3">
            <input
                type="datetime-local"
                name="departure_datetime"
                class="form-control"
                placeholder="Date et heure de départ"
                required
            >
        </div>

        <!-- Date / heure arrivée -->
        <div class="mb-3">
            <input
                type="datetime-local"
                name="arrival_datetime"
                class="form-control"
                placeholder="Date et heure d'arrivée"
                required
            >
        </div>

        <!-- Nombre de places -->
        <div class="mb-3">
            <input
                type="number"
                name="total_seats"
                class="form-control"
                placeholder="Nombre total de places"
                min="1"
                max="10"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Créer le trajet
        </button>
    </form>
</div>

