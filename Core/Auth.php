<?php
namespace Core;

/**
 * Class Auth
 *
 * Gestion centralisée de l'authentification et des autorisations.
 * Cette classe permet :
 *  - de savoir si un utilisateur est connecté
 *  - de récupérer l'utilisateur courant
 *  - de vérifier les droits ADMIN
 *
 * Aucune logique métier n'est dupliquée dans les contrôleurs.
 * Réutilisable pour d'autres applications intranet.
 */
class Auth
{
    /**
     * Vérifie si un utilisateur est connecté
     *
     * @return bool
     */
    public static function check(): bool
    {
        return isset($_SESSION['user']);
    }

    /**
     * Retourne l'utilisateur connecté
     *
     * @return object|null
     */
    public static function user(): ?object
    {
        return $_SESSION['user'] ?? null;
    }

    /**
     * Vérifie si l'utilisateur connecté est administrateur
     *
     * @return bool
     */
    public static function isAdmin(): bool
    {
        return self::check() && $_SESSION['user']->role === 'ADMIN';
    }

    /**
     * Oblige la connexion à l'application
     * Redirige vers la page de connexion si nécessaire
     *
     * À utiliser dans les contrôleurs USER et ADMIN
     */
    public static function requireLogin(): void
    {
        if (!self::check()) {
            header('Location: /covoiturage-projet/public/login');
            exit;
        }
    }

    /**
     * Oblige les droits administrateur
     *
     * À utiliser dans les contrôleurs ADMIN uniquement
     */
    public static function requireAdmin(): void
    {
        if (!self::isAdmin()) {
            http_response_code(403);
            die('Accès administrateur requis');
        }
    }

    /**
     * Connecte un utilisateur (appelé après vérification du mot de passe)
     *
     * @param object $user
     */
    public static function login(object $user): void
    {
        $_SESSION['user'] = $user;
    }

    /**
     * Déconnecte l'utilisateur courant
     */
    public static function logout(): void
    {
        unset($_SESSION['user']);
        session_destroy();
    }
}


