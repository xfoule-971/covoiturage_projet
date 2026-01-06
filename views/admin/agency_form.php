<?php
$isEdit = isset($agency);
?>

<h2 class="mb-4">
    <?= $isEdit ? 'Modifier une agence' : 'Créer une agence' ?>
</h2>

<form method="POST">

    <!-- CSRF -->
    <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">

    <!-- Nom agence -->
    <div class="mb-3">
        <label for="name" class="form-label">Nom de l’agence</label>
        <input
            type="text"
            id="name"
            name="name"
            class="form-control"
            required
            value="<?= $isEdit ? htmlspecialchars($agency->name) : '' ?>"
        >
    </div>

    <!-- Boutons -->
    <button type="submit" class="btn btn-success">
        <?= $isEdit ? 'Mettre à jour' : 'Créer' ?>
    </button>

    <a href="/covoiturage-projet/public/admin/agencies"
       class="btn btn-secondary ms-2">
        Annuler
    </a>
</form>
