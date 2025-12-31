<?php
// Affichage des erreurs pour le développement
ini_set('display_errors', 1);
error_reporting(E_ALL);

use Core\Autoloader;
use Router\Router;
use Controller\UserController;
use Controller\AgencyController;
use Controller\TripController;
use Controller\AuthController;
use Controller\AdminController;

// Démarrage de session (nécessaire pour Auth)
session_start();

// Chargement de l'autoloader
require_once __DIR__ . '/../Core/Autoloader.php';
Autoloader::register();

// Vérification rapide du router
if (!class_exists(\Router\Router::class)) {
    die("Erreur : Router non trouvé !");
}

// Instanciation du router
$router = new Router();

// ===== ROUTES PUBLIQUES =====

// Page d'accueil publique (trajets disponibles)
$router->get('/', function() {
    $controller = new TripController();
    $controller->index();
});

// Users (liste admin)
$router->get('/users', function() {
    $controller = new UserController();
    $controller->index();
});

// Agencies
$router->get('/agencies', function() {
    $controller = new AgencyController();
    $controller->index();
});

// Trips
$router->get('/trips', function() {
    $controller = new TripController();
    $controller->index();
});

// Générer 100 trajets aléatoires (admin / test)
$router->get('/generate-trips', function() {
    $controller = new TripController();
    $controller->generateRandomTrips(100, 20);
    echo "<p><a href='/covoiturage-projet/public/trips'>Voir les trajets générés</a></p>";
});

// ===== ROUTES AUTH =====
$router->match('/login', function() {
    $controller = new AuthController();
    $controller->login();
}, ['GET', 'POST']);

$router->get('/logout', function() {
    $controller = new AuthController();
    $controller->logout();
});

// ===== ROUTES ADMIN =====
$router->get('/admin', function() {
    $controller = new AdminController();
    $controller->dashboard();
});

$router->get('/admin/users', function() {
    $controller = new AdminController();
    $controller->users();
});

$router->get('/admin/agencies', function() {
    $controller = new AdminController();
    $controller->agencies();
});

$router->get('/admin/trips', function() {
    $controller = new AdminController();
    $controller->trips();
});

// Lancer le router
$router->run();







