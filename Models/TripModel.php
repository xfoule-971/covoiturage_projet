<?php
namespace Models;

use Core\Db;
use PDO;

/**
 * Class TripModel
 *
 * Gère l'accès aux données des trajets :
 * - affichage public (page d'accueil)
 * - affichage utilisateur connecté
 * - création, modification, suppression
 */
class TripModel
{
    private PDO $db;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    /**
     * Récupère les prochains trajets
     * - uniquement futurs
     * - avec des places disponibles
     * - triés par date de départ croissante
     *
     * Utilisé sur :
     * - home.php (visiteur)
     * - home_user.php (utilisateur connecté)
     */
    public function findAllAvailableFuture(): array
    {
        $sql = "
            SELECT 
                t.*,
                u.firstname,
                u.lastname,
                u.phone,
                u.email,
                a1.name AS departure_agency,
                a2.name AS arrival_agency
            FROM trips t
            JOIN users u ON u.id = t.user_id
            JOIN agencies a1 ON a1.id = t.departure_agency_id
            JOIN agencies a2 ON a2.id = t.arrival_agency_id
            WHERE t.departure_datetime > NOW()
              AND t.available_seats > 0
            ORDER BY t.departure_datetime ASC
        ";

        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Récupère un trajet par son ID
     *
     * @param int $id
     * @return object|null
     */
    public function findById(int $id): ?object
    {
        $stmt = $this->db->prepare("
            SELECT 
                t.*,
                u.firstname,
                u.lastname,
                u.phone,
                u.email,
                a1.name AS departure_agency,
                a2.name AS arrival_agency
            FROM trips t
            JOIN users u ON u.id = t.user_id
            JOIN agencies a1 ON a1.id = t.departure_agency_id
            JOIN agencies a2 ON a2.id = t.arrival_agency_id
            WHERE t.id = ?
        ");

        $stmt->execute([$id]);
        $trip = $stmt->fetch();

        return $trip ?: null;
    }

    /**
     * Crée un nouveau trajet
     *
     * @param array $data
     */
    public function create(array $data): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO trips (
                departure_agency_id,
                arrival_agency_id,
                departure_datetime,
                arrival_datetime,
                total_seats,
                available_seats,
                user_id
            ) VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $data['departure_agency_id'],
            $data['arrival_agency_id'],
            $data['departure_datetime'],
            $data['arrival_datetime'],
            $data['total_seats'],
            $data['available_seats'],
            $data['user_id']
        ]);
    }

    /**
     * Met à jour un trajet
     *
     * @param int   $id
     * @param array $data
     */
    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare("
            UPDATE trips SET
                departure_agency_id = ?,
                arrival_agency_id   = ?,
                departure_datetime  = ?,
                arrival_datetime    = ?,
                total_seats         = ?,
                available_seats     = ?
            WHERE id = ?
        ");

        $stmt->execute([
            $data['departure_agency_id'],
            $data['arrival_agency_id'],
            $data['departure_datetime'],
            $data['arrival_datetime'],
            $data['total_seats'],
            $data['available_seats'],
            $id
        ]);
    }

    /**
     * Supprime un trajet
     *
     * @param int $id
     */
    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM trips WHERE id = ?");
        $stmt->execute([$id]);
    }
}


