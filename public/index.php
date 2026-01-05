<?php
/**
 * Point d’entrée de l’application
 * - démarre la session
 * - charge l’autoloader
 * - délègue au routeur
 */

declare(strict_types=1);

// =====================
// SESSION
// =====================
session_start();

// =====================
// AUTOLOADER
// =====================
require_once __DIR__ . '/../Core/Autoloader.php';
\Core\Autoloader::register();

// =====================
// ROUTER
// =====================
use Router\Router;
use Controller\TripController;
use Controller\AuthController;

// Instanciation du routeur
$router = new Router();

/* =========================
 * ROUTES PUBLIQUES
 * ========================= */

// Page d'accueil (visiteur)
$router->get('/', function () {
    (new TripController())->index();
});

// Connexion
$router->match('/login', function () {
    (new AuthController())->login();
});

// Déconnexion
$router->get('/logout', function () {
    (new AuthController())->logout();
});

/* =========================
 * UTILISATEUR CONNECTÉ
 * ========================= */

// Accueil utilisateur
$router->get('/home-user', function () {
    \Core\Auth::requireLogin();
    (new TripController())->homeUser();
});

// Création d'un trajet
$router->match('/trips/create', function () {
    \Core\Auth::requireLogin();
    (new TripController())->create();
});

/* =========================
 * LANCEMENT DU ROUTER
 * ========================= */

$router->run();









