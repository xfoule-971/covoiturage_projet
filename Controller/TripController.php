<?php
namespace Controller;

use Models\TripModel;
use Models\AgencyModel;
use Core\Auth;

/**
 * Class TripController
 *
 * Gère les trajets :
 * - accueil public
 * - accueil utilisateur connecté
 * - création d'un trajet
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
     * Accueil VISITEUR
     */
    public function index(): void
    {
        $trips = $this->tripModel->findAllAvailableFuture();

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/home.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Accueil UTILISATEUR CONNECTÉ
     */
    public function homeUser(): void
    {
        Auth::requireLogin();

        $trips = $this->tripModel->findAllAvailableFuture();

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/HomeUser.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Création d'un trajet
     *
     * Règles métier :
     * - utilisateur connecté
     * - agences différentes
     * - date future
     * - arrivée après départ
     * - places entre 1 et 10
     */
    public function create(): void
    {
        Auth::requireLogin();

        /* =========================
         * CSRF
         * ========================= */
        if (empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }

        $agencies = $this->agencyModel->findAll();
        $error = null;

        /* =========================
         * TRAITEMENT FORMULAIRE
         * ========================= */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // ---- Vérification CSRF ----
            if (
                empty($_POST['csrf']) ||
                !hash_equals($_SESSION['csrf'], $_POST['csrf'])
            ) {
                http_response_code(403);
                die('Requête CSRF invalide');
            }

            // ---- Récupération sécurisée ----
            $departureAgency = filter_input(INPUT_POST, 'departure_agency_id', FILTER_VALIDATE_INT);
            $arrivalAgency   = filter_input(INPUT_POST, 'arrival_agency_id', FILTER_VALIDATE_INT);
            $departureDate   = $_POST['departure_datetime'] ?? null;
            $arrivalDate     = $_POST['arrival_datetime'] ?? null;
            $totalSeats      = filter_input(INPUT_POST, 'total_seats', FILTER_VALIDATE_INT);

            /* =========================
             * CONTRÔLES MÉTIER
             * ========================= */

            if (!$departureAgency || !$arrivalAgency || !$departureDate || !$arrivalDate || !$totalSeats) {
                $error = "Tous les champs sont obligatoires.";
            }

            elseif ($departureAgency === $arrivalAgency) {
                $error = "L'agence de départ et d'arrivée doivent être différentes.";
            }

            elseif (strtotime($departureDate) <= time()) {
                $error = "La date de départ doit être dans le futur.";
            }

            elseif (strtotime($arrivalDate) <= strtotime($departureDate)) {
                $error = "La date d'arrivée doit être postérieure à la date de départ.";
            }

            elseif ($totalSeats < 1 || $totalSeats > 10) {
                $error = "Le nombre de places doit être compris entre 1 et 10.";
            }

            /* =========================
             * CRÉATION TRAJET
             * ========================= */
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

                header('Location: /covoiturage-projet/public/home-user');
                exit;
            }
        }

        /* =========================
         * AFFICHAGE FORMULAIRE
         * ========================= */
        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/trip/create.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }
}









