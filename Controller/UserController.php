<?php
namespace Controller;

use Models\UserModel;
use Core\Auth;

/**
 * Class UserController
 *
 * Gestion des utilisateurs (ADMIN)
 */
class UserController {

    private UserModel $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    /**
     * Liste des utilisateurs
     */
    public function index(): void {
        Auth::requireAdmin();

        $users = $this->userModel->findAll();

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/users/index.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Détail d'un utilisateur
     */
    public function show(int $id): void {
        Auth::requireAdmin();

        $user = $this->userModel->findById($id);

        if (!$user) {
            http_response_code(404);
            die('Utilisateur non trouvé');
        }

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/users/show.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }
}

