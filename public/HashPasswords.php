<?php
require_once __DIR__ . '/../Core/Autoloader.php';
\Core\Autoloader::register();

use Core\Db;

$db = Db::getInstance();

$users = $db->query("SELECT id, password FROM users")->fetchAll();

foreach ($users as $user) {

    // Si le mot de passe n'est PAS déjà hashé
    if (!password_get_info($user->password)['algo']) {

        $hash = password_hash($user->password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$hash, $user->id]);

        echo "Utilisateur {$user->id} → mot de passe hashé<br>";
    }
}

echo "✅ Terminé";

