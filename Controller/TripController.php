<?php
namespace Controller;

use Models\TripModel;
use Models\AgencyModel;
use Core\Auth;

/**
 * Class TripController
 *
 * Gestion des trajets :
 * - affichage public
 * - affichage utilisateur connecté
 * - création
 * - modification
 * - suppression
 */
class TripController
{
    private TripModel $tripModel;
    private AgencyModel $agencyModel;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->tripModel   = new TripModel();
        $this->agencyModel = new AgencyModel();
    }

    /**
     * Page d'accueil VISITEUR
     */
    public function index(): void
    {
        $trips = $this->tripModel->findAllAvailableFuture();

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/home.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Page d'accueil UTILISATEUR CONNECTÉ
     */
    public function homeUser(): void
    {
        Auth::requireLogin();

        $trips    = $this->tripModel->findAllAvailableFuture();
        $agencies = $this->agencyModel->findAll();

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/homeuser.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Création d'un trajet
     */
    public function create(): void
    {
        Auth::requireLogin();

        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }

        $agencies = $this->agencyModel->findAll();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_POST['csrf'] !== $_SESSION['csrf']) {
                die('CSRF détecté');
            }

            $departureAgency = (int) $_POST['departure_agency_id'];
            $arrivalAgency   = (int) $_POST['arrival_agency_id'];
            $departureDate   = $_POST['departure_datetime'];
            $arrivalDate     = $_POST['arrival_datetime'];
            $totalSeats      = (int) $_POST['total_seats'];

            /* =========================
             * Contrôles métier
             * ========================= */
            if ($departureAgency === $arrivalAgency) {
                $error = "Les agences doivent être différentes.";
            } elseif (strtotime($arrivalDate) <= strtotime($departureDate)) {
                $error = "L'arrivée doit être après le départ.";
            } elseif ($totalSeats < 1 || $totalSeats > 10) {
                $error = "Nombre de places invalide.";
            }

            if (!$error) {
                $this->tripModel->create([
                    'departure_agency_id' => $departureAgency,
                    'arrival_agency_id'   => $arrivalAgency,
                    'departure_datetime'  => $departureDate,
                    'arrival_datetime'    => $arrivalDate,
                    'total_seats'         => $totalSeats,
                    'available_seats'     => $totalSeats,
                    'user_id'             => $_SESSION['user']->id
                ]);

                header('Location: /covoiturage-projet/public/homeuser');
                exit;
            }
        }

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/trip/create.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Suppression d'un trajet
     */
    public function delete(int $id): void
    {
        Auth::requireLogin();

        $trip = $this->tripModel->findById($id);

        if (!$trip || $trip->user_id !== $_SESSION['user']->id && !Auth::isAdmin()) {
            die('Accès interdit');
        }

        $this->tripModel->delete($id);

        header('Location: /covoiturage-projet/public/homeuser');
        exit;
    }
}










