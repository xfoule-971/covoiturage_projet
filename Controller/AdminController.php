<?php
namespace Controller;

use Models\UserModel;
use Core\Auth;

class AuthController {

    private UserModel $userModel;

    public function __construct() {
        $this->userModel = new UserModel();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login(): void {

        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (
                !isset($_POST['csrf']) ||
                $_POST['csrf'] !== $_SESSION['csrf']
            ) {
                die('⛔ Tentative CSRF détectée');
            }

            $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->authenticate($email, $password);

            if ($user) {
                Auth::login($user);
                session_regenerate_id(true);

                header('Location: /covoiturage-projet/public/');
                exit;
            }

            $error = 'Identifiants incorrects';
        }

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/auth/login.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    public function logout(): void {
        Auth::logout();

        header('Location: /covoiturage-projet/public/');
        exit;
    }
}


