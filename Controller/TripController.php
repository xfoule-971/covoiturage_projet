<?php
namespace Controller;

use Models\TripModel;
use Models\AgencyModel;
use Core\Auth;

/**
 * Class TripController
 *
 * Gère les trajets :
 * - affichage public (home)
 * - affichage détail
 * - génération aléatoire (admin)
 */
class TripController {

    private TripModel $tripModel;
    private AgencyModel $agencyModel;

    /**
     * Constructeur
     */
    public function __construct() {
        $this->tripModel   = new TripModel();
        $this->agencyModel = new AgencyModel();
    }

    /**
     * Page d'accueil
     * - trajets futurs
     * - places disponibles
     */
    public function index(): void {
        $trips = $this->tripModel->findAllAvailableFuture();

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/home.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Détail d'un trajet
     */
    public function show(int $id): void {
        $trip = $this->tripModel->findById($id);

        if (!$trip) {
            http_response_code(404);
            die('Trajet non trouvé');
        }

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/trips/show.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Génération de trajets aléatoires (ADMIN)
     */
    public function generateRandomTrips(int $numTrips = 100, int $numUsers = 20): void {

        Auth::requireAdmin();

        $agencies   = $this->agencyModel->findAll();
        $agencyIds = array_map(fn($a) => $a->id, $agencies);

        for ($i = 0; $i < $numTrips; $i++) {

            $departure = $agencyIds[array_rand($agencyIds)];
            do {
                $arrival = $agencyIds[array_rand($agencyIds)];
            } while ($arrival === $departure);

            $departureTime = new \DateTime(
                '+' . rand(0,30) . ' days +' . rand(0,23) . ' hours'
            );

            $arrivalTime = clone $departureTime;
            $arrivalTime->modify('+' . rand(1,6) . ' hours');

            $totalSeats     = rand(3,6);
            $availableSeats = rand(0,$totalSeats);

            $this->tripModel->create([
                'departure_agency_id' => $departure,
                'arrival_agency_id'   => $arrival,
                'departure_datetime'  => $departureTime->format('Y-m-d H:i:s'),
                'arrival_datetime'    => $arrivalTime->format('Y-m-d H:i:s'),
                'total_seats'         => $totalSeats,
                'available_seats'     => $availableSeats,
                'user_id'             => rand(1,$numUsers)
            ]);
        }

        echo "✅ $numTrips trajets générés";
    }
}






