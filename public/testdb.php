<?php
require_once __DIR__ . '/../Core/Db.php';

use Core\Db;

try {
    $pdo = Db::getInstance();
    echo "Connexion OK !";
} catch (Exception $e) {
    echo $e->getMessage();
}
