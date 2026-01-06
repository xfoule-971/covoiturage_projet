<?php
namespace Models;

use Core\Db;
use PDO;

/**
 * Class TripModel
 *
 * Gestion des trajets
 */
class TripModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    /**
     * Trajets futurs avec places (user + public)
     */
    public function findAllAvailableFuture(): array
    {
        $sql = "
            SELECT 
                t.*,
                u.firstname,
                u.lastname,
                u.email,
                u.phone,
                a1.name AS departure_agency,
                a2.name AS arrival_agency
            FROM trips t
            JOIN users u ON u.id = t.user_id
            JOIN agencies a1 ON a1.id = t.departure_agency_id
            JOIN agencies a2 ON a2.id = t.arrival_agency_id
            WHERE t.departure_datetime > NOW()
            ORDER BY t.departure_datetime ASC
        ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * TOUS les trajets (ADMIN)
     */
    public function findAll(): array
    {
        $sql = "
            SELECT 
                t.*,
                u.firstname,
                u.lastname,
                a1.name AS departure_agency,
                a2.name AS arrival_agency
            FROM trips t
            JOIN users u ON u.id = t.user_id
            JOIN agencies a1 ON a1.id = t.departure_agency_id
            JOIN agencies a2 ON a2.id = t.arrival_agency_id
            ORDER BY t.departure_datetime DESC
        ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Suppression d’un trajet
     */
    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM trips WHERE id = ?");
        $stmt->execute([$id]);
    }
}




