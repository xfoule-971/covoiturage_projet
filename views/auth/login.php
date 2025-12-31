<?php
use Core\Auth;
?>

<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4 text-center">Connexion</h2>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <!-- Token CSRF -->
            <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?? '' ?>">

            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Adresse email" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
