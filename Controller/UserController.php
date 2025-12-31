<?php
namespace Controller;

use Models\UserModel;
use Core\Auth;

/**
 * Class UserController
 *
 * Contrôleur des utilisateurs
 *
 * Fonctionnalités possibles :
 *  - Liste des utilisateurs (ADMIN uniquement)
 *  - Affichage des détails d'un utilisateur
 */
class UserController {

    private UserModel $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    /**
     * Liste tous les utilisateurs
     * Accessible uniquement à l'administrateur
     */
    public function index(): void {
        Auth::requireAdmin(); // Bloque les non-admins

        // Récupération des utilisateurs
        $users = $this->userModel->findAll();

        // Vue d'affichage
        require __DIR__ . '/../Views/users/index.php';
    }

    /**
     * Affiche les détails d'un utilisateur
     *
     * @param int $id
     */
    public function show(int $id): void {
        Auth::requireAdmin(); // Seul l'admin peut voir les infos complètes

        $user = $this->userModel->findById($id);
        if (!$user) {
            http_response_code(404);
            die("Utilisateur non trouvé !");
        }

        require __DIR__ . '/../Views/users/show.php';
    }
}

