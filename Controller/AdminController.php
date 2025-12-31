<?php
namespace Controller;

use Models\UserModel;
use Models\AgencyModel;
use Models\TripModel;
use Core\Auth;

/**
 * Class AdminController
 *
 * Gestion de l'administration :
 * - Accès réservé aux utilisateurs ADMIN
 * - Dashboard et pages spécifiques
 */
class AdminController {

    private UserModel $userModel;
    private AgencyModel $agencyModel;
    private TripModel $tripModel;

    public function __construct() {
        Auth::requireAdmin(); // Bloque l'accès aux non-admins

        $this->userModel = new UserModel();
        $this->agencyModel = new AgencyModel();
        $this->tripModel = new TripModel();
    }

    /**
     * Tableau de bord administrateur
     */
    public function dashboard(): void {
        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/admin/dashboard.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Liste des utilisateurs
     */
    public function users(): void {
        $users = $this->userModel->findAll();
        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/admin/users.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Liste et gestion des agences
     */
    public function agencies(): void {
        $agencies = $this->agencyModel->findAll();
        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/admin/agencies.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Liste des trajets
     */
    public function trips(): void {
        $trips = $this->tripModel->findAll();
        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/admin/trips.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }
}

