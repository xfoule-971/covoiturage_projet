<?php
namespace Controller;

use Models\UserModel;
use Models\AgencyModel;
use Models\TripModel;
use Core\Auth;

/**
 * Class AdminController
 *
 * Tableau de bord administrateur
 * Accès réservé uniquement aux utilisateurs ADMIN
 */
class AdminController {

    private UserModel $userModel;
    private AgencyModel $agencyModel;
    private TripModel $tripModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->agencyModel = new AgencyModel();
        $this->tripModel = new TripModel();
    }

    /**
     * Tableau de bord administrateur
     * 
     * Affiche :
     *  - liste des utilisateurs
     *  - liste des agences
     *  - liste des trajets
     */
    public function dashboard(): void {

        // Bloque l'accès aux non-admins
        Auth::requireAdmin();

        // Récupération des données
        $users = $this->userModel->findAll();
        $agencies = $this->agencyModel->findAll();
        $trips = $this->tripModel->findAll();

        // Chargement des vues
        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/admin/dashboard.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }
}
