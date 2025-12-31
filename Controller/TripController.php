<?php
namespace Controller;

use Models\TripModel;
use Models\AgencyModel;
use Core\Auth;

/**
 * Class TripController
 *
 * Contrôleur des trajets.
 * Gestion :
 *  - affichage des trajets publics et utilisateurs
 *  - création aléatoire pour tests
 *  - futur ajout création / modification / suppression
 */
class TripController {

    private TripModel $tripModel;
    private AgencyModel $agencyModel;

    public function __construct() {
        $this->tripModel = new TripModel();
        $this->agencyModel = new AgencyModel();
    }

    /**
     * Affiche tous les trajets
     * 
     * Pour la page d'accueil :
     *  - uniquement trajets avec places disponibles
     *  - uniquement trajets futurs
     *  - tri par date de départ croissante
     */
    public function index(): void {
        $trips = $this->tripModel->findAllAvailableFuture();
        require __DIR__ . '/../Views/Home.php';
    }

    /**
     * Génère des trajets aléatoires (outil admin / dev)
     *
     * @param int $numTrips Nombre de trajets à générer
     * @param int $numUsers Nombre d'utilisateurs possibles
     */
    public function generateRandomTrips(int $numTrips = 100, int $numUsers = 20): void {

        // Récupère toutes les agences
        $agencies = $this->agencyModel->findAll();
        $agencyIds = array_map(fn($a) => $a->id, $agencies);

        for ($i = 0; $i < $numTrips; $i++) {

            // Choix aléatoire agences départ/arrivée (différentes)
            $departure = $agencyIds[array_rand($agencyIds)];
            do {
                $arrival = $agencyIds[array_rand($agencyIds)];
            } while ($arrival === $departure);

            // Génération aléatoire date/heure
            $departureTime = new \DateTime(
                '+' . rand(0,30) . ' days +' . rand(0,23) . ' hours +' . rand(0,59) . ' minutes'
            );
            $arrivalTime = clone $departureTime;
            $arrivalTime->modify('+' . rand(1,6) . ' hours');

            // Si totalSeats = 3..6, availableSeats peut être 0..totalSeats
            $totalSeats = rand(3,6);
            $availableSeats = rand(0,$totalSeats);

            // Choix utilisateur aléatoire
            $userId = rand(1,$numUsers);

            // Création du trajet dans la base
            $this->tripModel->create([
                'departure_agency_id' => $departure,
                'arrival_agency_id'   => $arrival,
                'departure_datetime'  => $departureTime->format('Y-m-d H:i:s'),
                'arrival_datetime'    => $arrivalTime->format('Y-m-d H:i:s'),
                'total_seats'         => $totalSeats,
                'available_seats'     => $availableSeats,
                'user_id'             => $userId
            ]);
        }

        echo "✅ $numTrips trajets générés !";
    }

    /**
     * Affiche les détails d'un trajet
     * Accessible à tous mais modal complet pour les utilisateurs connectés
     *
     * @param int $id
     */
    public function show(int $id): void {
        $trip = $this->tripModel->findById($id);
        if (!$trip) {
            http_response_code(404);
            die("Trajet non trouvé !");
        }

        require __DIR__ . '/../Views/trips/show.php';
    }

    /**
     * Vérifie que l'utilisateur peut modifier ou supprimer un trajet
     *
     * @param object $trip
     */
    private function authorizeUser(object $trip): void {
        if (!Auth::check() || ($trip->user_id !== Auth::user()->id && !Auth::isAdmin())) {
            http_response_code(403);
            die('⛔ Action non autorisée');
        }
    }
}



