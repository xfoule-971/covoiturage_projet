<?php
namespace Controller;

use Models\UserModel;
use Core\Auth;

/**
 * Class AuthController
 *
 * Gère l'authentification des utilisateurs :
 * - affichage du formulaire de connexion
 * - traitement du formulaire
 * - sécurisation CSRF
 * - connexion / déconnexion
 *
 * Aucune logique métier n'est mise dans les vues.
 */
class AuthController
{
    /**
     * Modèle utilisateur
     *
     * @var UserModel
     */
    private UserModel $userModel;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Connexion utilisateur (GET + POST)
     *
     * GET  → affiche le formulaire
     * POST → traite la connexion
     */
    public function login(): void
    {
        // ===============================
        // DÉMARRAGE SESSION SI NÉCESSAIRE
        // ===============================
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // ===============================
        // GÉNÉRATION TOKEN CSRF
        // ===============================
        if (empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }

        $error = null;

        // ===============================
        // TRAITEMENT FORMULAIRE
        // ===============================
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // ---- Vérification CSRF ----
            if (
                empty($_POST['csrf']) ||
                !hash_equals($_SESSION['csrf'], $_POST['csrf'])
            ) {
                http_response_code(403);
                die('⛔ Requête CSRF invalide');
            }

            // ---- Nettoyage entrées ----
            $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (!$email || !$password) {
                $error = 'Tous les champs sont obligatoires';
            } else {

                // ---- Authentification via le modèle ----
                $user = $this->userModel->authenticate($email, $password);

                if ($user) {

                    // ---- Connexion utilisateur ----
                    Auth::login($user);

                    // ---- Sécurité : nouvelle session ----
                    session_regenerate_id(true);

                    // ---- Redirection utilisateur ----
                    header('Location: /covoiturage-projet/public/home-user');
                    exit;
                }

                $error = 'Email ou mot de passe incorrect';
            }
        }

        // ===============================
        // AFFICHAGE VUE
        // ===============================
        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/auth/login.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Déconnexion utilisateur
     */
    public function logout(): void
    {
        // Déconnexion centralisée
        Auth::logout();

        // Redirection vers accueil public
        header('Location: /covoiturage-projet/public/');
        exit;
    }
}




