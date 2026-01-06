<div class="row justify-content-center">
    <div class="col-md-4">
        <h2 class="mb-4">Connexion</h2>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
            <div class="mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Votre email" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>
    </div>
</div>


