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
$router->get('/homeuser', function () {
    \Core\Auth::requireLogin();
    (new TripController())->homeUser();
});

// Création d'un trajet
$router->match('/trips/create', function () {
    \Core\Auth::requireLogin();
    (new TripController())->create();
});

/* =========================
 * ADMINISTRATEUR
 * ========================= */

// Dashboard admin
$router->get('/admin', function () {
    (new Controller\AdminController())->dashboard();
});

// Liste utilisateurs
$router->get('/admin/users', function () {
    (new Controller\AdminController())->users();
});

// Liste agences
$router->get('/admin/agencies', function () {
    (new Controller\AdminController())->agencies();
});

// Création agence
$router->match('/admin/agencies/create', function () {
    (new Controller\AdminController())->createAgency();
});

// Modification agence
$router->match('/admin/agencies/edit', function () {
    (new Controller\AdminController())->editAgency();
});

// Suppression agence
$router->get('/admin/agencies/delete', function () {
    (new Controller\AdminController())->deleteAgency();
});

// Liste trajets
$router->get('/admin/trips', function () {
    (new Controller\AdminController())->trips();
});

// Suppression trajet
$router->get('/admin/trips/delete', function () {
    (new Controller\AdminController())->deleteTrip();
});



/* =========================
 * LANCEMENT DU ROUTER
 * ========================= */

$router->run();









