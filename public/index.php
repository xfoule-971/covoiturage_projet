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

// ===== ROUTES =====

// Page d'accueil publique (trajets disponibles)
$router->get('/', function() {
    $controller = new TripController();
    $controller->index(); // affichage de Home.php avec trajets
});

// Users (admin uniquement)
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

// Générer 100 trajets aléatoires (test / admin)
$router->get('/generate-trips', function() {
    $controller = new TripController();
    $controller->generateRandomTrips(100, 20);
    echo "<p><a href='/covoiturage-projet/public/trips'>Voir les trajets générés</a></p>";
});

// Authentification
$router->get('/login', function() {
    $controller = new AuthController();
    $controller->login();
});

$router->post('/login', function() {
    $controller = new AuthController();
    $controller->login();
});

$router->get('/logout', function() {
    $controller = new AuthController();
    $controller->logout();
});

// Admin dashboard
$router->get('/admin', function() {
    $controller = new AdminController();
    $controller->dashboard();
});

// Lancer le router
$router->run();






