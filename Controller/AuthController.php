<?php
namespace Controller;

use Models\UserModel;
use Core\Auth;

/**
 * Class AuthController
 *
 * Gestion de l'authentification :
 *  - connexion / déconnexion
 *  - contrôle CSRF
 *  - sécurisation session
 */
class AuthController {

    private UserModel $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    /**
     * Affiche et traite le formulaire de connexion
     */
    public function login(): void {

        // Génération du token CSRF si inexistant
        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }

        $error = null;

        // Traitement du formulaire POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Vérification du token CSRF
            if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
                die('⛔ Tentative CSRF détectée');
            }

            // Nettoyage des données
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            // Tentative d’authentification via UserModel
            $user = $this->userModel->authenticate($email, $password);

            if ($user) {
                // Connecte l'utilisateur en session
                Auth::login($user);

                // Régénération de l'ID de session (sécurité)
                session_regenerate_id(true);

                // Redirection vers la page d'accueil
                header('Location: /covoiturage-projet/public/');
                exit;
            }

            $error = "Identifiants incorrects";
        }

        // Chargement des vues
        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/auth/login.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Déconnecte l'utilisateur
     */
    public function logout(): void {
        Auth::logout();

        // Redirection vers l'accueil
        header('Location: /covoiturage-projet/public/');
        exit;
    }
}

