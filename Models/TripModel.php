<?php
namespace Models;

use Core\Db;
use PDO;

/**
 * Class TripModel
 *
 * Modèle des trajets
 * Fournit toutes les opérations CRUD et requêtes spécifiques
 */
class TripModel {

    private PDO $db;

    public function __construct() {
        $this->db = Db::getInstance();
    }

    /**
     * Retourne tous les trajets
     * Triés par date de départ croissante
     */
    public function findAll(): array {
        $stmt = $this->db->query("
            SELECT t.*, 
                   u.firstname, u.lastname, u.phone, u.email,
                   da.name as departure_agency, 
                   aa.name as arrival_agency
            FROM trips t
            JOIN users u ON t.user_id = u.id
            JOIN agencies da ON t.departure_agency_id = da.id
            JOIN agencies aa ON t.arrival_agency_id = aa.id
            ORDER BY t.departure_datetime ASC
        ");
        return $stmt->fetchAll();
    }

    /**
     * Retourne uniquement les trajets disponibles et futurs
     */
    public function findAllAvailableFuture(): array {
        $stmt = $this->db->prepare("
            SELECT t.*, 
                   u.firstname, u.lastname, u.phone, u.email,
                   da.name as departure_agency, 
                   aa.name as arrival_agency
            FROM trips t
            JOIN users u ON t.user_id = u.id
            JOIN agencies da ON t.departure_agency_id = da.id
            JOIN agencies aa ON t.arrival_agency_id = aa.id
            WHERE t.available_seats > 0
              AND t.departure_datetime >= NOW()
            ORDER BY t.departure_datetime ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Retourne un trajet par son ID
     *
     * @param int $id
     */
    public function findById(int $id): ?object {
        $stmt = $this->db->prepare("
            SELECT t.*, 
                   u.firstname, u.lastname, u.phone, u.email,
                   da.name as departure_agency, 
                   aa.name as arrival_agency
            FROM trips t
            JOIN users u ON t.user_id = u.id
            JOIN agencies da ON t.departure_agency_id = da.id
            JOIN agencies aa ON t.arrival_agency_id = aa.id
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
    public function create(array $data): void {
        $stmt = $this->db->prepare("
            INSERT INTO trips 
            (departure_agency_id, arrival_agency_id, departure_datetime, arrival_datetime, total_seats, available_seats, user_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)
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
     * Met à jour un trajet existant
     *
     * @param int $id
     * @param array $data
     */
    public function update(int $id, array $data): void {
        $stmt = $this->db->prepare("
            UPDATE trips SET
                departure_agency_id = ?,
                arrival_agency_id = ?,
                departure_datetime = ?,
                arrival_datetime = ?,
                total_seats = ?,
                available_seats = ?
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
    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM trips WHERE id = ?");
        $stmt->execute([$id]);
    }
}

