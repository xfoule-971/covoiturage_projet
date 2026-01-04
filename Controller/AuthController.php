<?php
namespace Controller;

use Models\UserModel;
use Core\Auth;

/**
 * Class AuthController
 *
 * Gère l'authentification :
 * - connexion
 * - déconnexion
 * - protection CSRF
 * - sécurisation de la session
 */
class AuthController {

    private UserModel $userModel;

    /**
     * Constructeur
     * - Initialise le modèle utilisateur
     * - Démarre la session si nécessaire
     */
    public function __construct() {
        $this->userModel = new UserModel();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Affiche et traite le formulaire de connexion
     */
    public function login(): void {

        // Création du token CSRF si absent
        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }

        $error = null;

        // Si formulaire soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Vérification CSRF
            if (
                !isset($_POST['csrf']) ||
                $_POST['csrf'] !== $_SESSION['csrf']
            ) {
                die('⛔ Tentative CSRF détectée');
            }

            // Nettoyage des entrées
            $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            // Tentative d'authentification
            $user = $this->userModel->authenticate($email, $password);

            if ($user) {
                // Connexion utilisateur
                Auth::login($user);

                // Protection contre le session fixation
                session_regenerate_id(true);

                // Redirection accueil
                header('Location: /covoiturage-projet/public/');
                exit;
            }

            // Erreur si échec
            $error = 'Identifiants incorrects';
        }

        // Affichage vue avec layout
        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/auth/login.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Déconnexion utilisateur
     */
    public function logout(): void {
        Auth::logout();

        header('Location: /covoiturage-projet/public/');
        exit;
    }
}


