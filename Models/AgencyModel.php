<?php
namespace Models;

use Core\Db;
use PDO;

/**
 * Class AgencyModel
 *
 * Modèle des agences (villes)
 * Fournit les méthodes pour récupérer et gérer les agences
 */
class AgencyModel {

    private PDO $db;

    public function __construct() {
        $this->db = Db::getInstance();
    }

    /**
     * Retourne toutes les agences
     */
    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM agencies ORDER BY name");
        return $stmt->fetchAll();
    }

    /**
     * Retourne une agence par son ID
     *
     * @param int $id
     */
    public function findById(int $id): ?object {
        $stmt = $this->db->prepare("SELECT * FROM agencies WHERE id = ?");
        $stmt->execute([$id]);
        $agency = $stmt->fetch();
        return $agency ?: null;
    }

    /**
     * Crée une nouvelle agence
     *
     * @param array $data ['name' => 'Nom de l’agence']
     */
    public function create(array $data): void {
        $stmt = $this->db->prepare("INSERT INTO agencies (name) VALUES (?)");
        $stmt->execute([$data['name']]);
    }

    /**
     * Met à jour une agence existante
     *
     * @param int $id
     * @param array $data ['name' => 'Nouveau nom']
     */
    public function update(int $id, array $data): void {
        $stmt = $this->db->prepare("UPDATE agencies SET name = ? WHERE id = ?");
        $stmt->execute([$data['name'], $id]);
    }

    /**
     * Supprime une agence
     *
     * @param int $id
     */
    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM agencies WHERE id = ?");
        $stmt->execute([$id]);
    }
}



