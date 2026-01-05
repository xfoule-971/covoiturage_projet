<?php
/**
 * Point d’entrée de l’application
 * - démarre la session
 * - charge l’autoloader
 * - délègue au routeur
 */

session_start();

require_once __DIR__ . '/../Core/Autoloader.php';
\Core\Autoloader::register();

// ROUTEUR SIMPLE (exemple)
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

switch ($uri) {

    case '':
    case 'covoiturage-projet/public':
        (new Controller\TripController())->index();
        break;

    case 'covoiturage-projet/public/login':
        (new Controller\AuthController())->login();
        break;

    case 'covoiturage-projet/public/logout':
        (new Controller\AuthController())->logout();
        break;

    case 'covoiturage-projet/public/home-user':
        \Core\Auth::requireLogin();
        (new Controller\TripController())->homeUser();
        break;

    default:
        http_response_code(404);
        echo 'Page introuvable';
}








