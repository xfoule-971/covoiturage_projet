<?php
namespace Controller;

use Core\Auth;
use Models\UserModel;
use Models\AgencyModel;
use Models\TripModel;

/**
 * Class AdminController
 *
 * Tableau de bord ADMIN
 * Accès strictement réservé aux administrateurs
 */
class AdminController
{
    private UserModel $userModel;
    private AgencyModel $agencyModel;
    private TripModel $tripModel;

    /**
     * Sécurité + chargement modèles
     */
    public function __construct()
    {
        Auth::requireAdmin();

        $this->userModel   = new UserModel();
        $this->agencyModel = new AgencyModel();
        $this->tripModel   = new TripModel();
    }

    /**
     * Dashboard admin
     */
    public function dashboard(): void
    {
        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/admin/dashboard.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Liste des utilisateurs
     */
    public function users(): void
    {
        $users = $this->userModel->findAll();

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/admin/users.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Liste des agences
     */
    public function agencies(): void
    {
        $agencies = $this->agencyModel->findAll();

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/admin/agencies.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Création d'une agence
     */
    public function createAgency(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_POST['csrf'] !== $_SESSION['csrf']) {
                die('⛔ CSRF détectée');
            }

            $name = trim($_POST['name']);

            if ($name !== '') {
                $this->agencyModel->create([
                    'name' => $name
                ]);

                header('Location: /covoiturage-projet/public/admin/agencies');
                exit;
            }
        }

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/admin/agency_form.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Modification d'une agence
     */
    public function editAgency(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $agency = $this->agencyModel->findById($id);

        if (!$agency) {
            die('Agence introuvable');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_POST['csrf'] !== $_SESSION['csrf']) {
                die('⛔ CSRF détectée');
            }

            $this->agencyModel->update($id, [
                'name' => trim($_POST['name'])
            ]);

            header('Location: /covoiturage-projet/public/admin/agencies');
            exit;
        }

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/admin/agency_form.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Suppression agence
     */
    public function deleteAgency(): void
    {
        $this->agencyModel->delete((int) $_GET['id']);
        header('Location: /covoiturage-projet/public/admin/agencies');
        exit;
    }

    /**
     * Liste des trajets (ADMIN)
     */
    public function trips(): void
    {
        $trips = $this->tripModel->findAll();

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/admin/trips.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Suppression trajet
     */
    public function deleteTrip(): void
    {
        $this->tripModel->delete((int) $_GET['id']);
        header('Location: /covoiturage-projet/public/admin/trips');
        exit;
    }
}







