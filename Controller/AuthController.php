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
 */
class AuthController
{
    private UserModel $userModel;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Connexion utilisateur
     * - GET : affiche le formulaire
     * - POST : traite la connexion
     */
    public function login(): void
    {
        // Génération CSRF si absent
        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            /* =========================
             * Sécurité CSRF
             * ========================= */
            if (
                !isset($_POST['csrf']) ||
                $_POST['csrf'] !== $_SESSION['csrf']
            ) {
                die('Tentative CSRF détectée');
            }

            /* =========================
             * Données formulaire
             * ========================= */
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || $password === '') {
                $error = "Veuillez remplir tous les champs.";
            } else {

                /* =========================
                 * Authentification
                 * ========================= */
                $user = $this->userModel->authenticate($email, $password);

                if ($user) {
                    Auth::login($user);

                    // Redirection home utilisateur
                    header('Location: /covoiturage-projet/public/homeuser');
                    exit;
                } else {
                    $error = "Email ou mot de passe incorrect.";
                }
            }
        }

        /* =========================
         * Affichage formulaire
         * ========================= */
        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/auth/login.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Déconnexion utilisateur
     */
    public function logout(): void
    {
        Auth::logout();
        header('Location: /covoiturage-projet/public/');
        exit;
    }
}





