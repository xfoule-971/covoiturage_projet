<?php
namespace Models;

use Core\Db;
use PDO;

/**
 * Class UserModel
 *
 * Modèle des utilisateurs
 * Fournit les méthodes pour récupérer, authentifier et gérer les utilisateurs
 */
class UserModel {

    private PDO $db;

    public function __construct() {
        $this->db = Db::getInstance();
    }

    /**
     * Récupère tous les utilisateurs
     */
    public function getAll(): array
    {
        $sql = "
            SELECT id, firstname, lastname, email, role
            FROM users
            ORDER BY lastname ASC
        ";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }


    /**
     * Retourne tous les utilisateurs
     */
    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM users ORDER BY lastname, firstname");
        return $stmt->fetchAll();
    }

    /**
     * Retourne un utilisateur par son ID
     *
     * @param int $id
     */
    public function findById(int $id): ?object {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    /**
     * Authentifie un utilisateur par email et mot de passe
     *
     * @param string $email
     * @param string $password
     * @return object|null
     */
    public function authenticate(string $email, string $password): ?object {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return null;
    }

    /**
     * Met à jour un utilisateur
     *
     * @param int $id
     * @param array $data
     */
    public function update(int $id, array $data): void {
        $stmt = $this->db->prepare("
            UPDATE users SET
                lastname = ?,
                firstname = ?,
                phone = ?,
                email = ?,
                role = ?
            WHERE id = ?
        ");
        $stmt->execute([
            $data['lastname'],
            $data['firstname'],
            $data['phone'],
            $data['email'],
            $data['role'],
            $id
        ]);
    }

    /**
     * Supprime un utilisateur
     *
     * @param int $id
     */
    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }
}


