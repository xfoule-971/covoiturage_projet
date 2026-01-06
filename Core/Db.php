<?php
namespace Core;

use PDO;
use PDOException;

/**
 * Class Db
 *
 * Gestion centralisée de la connexion à la base de données.
 * Implémente le pattern Singleton afin de :
 *  - garantir une seule instance PDO
 *  - limiter le nombre de connexions simultanées
 *  - centraliser la configuration MySQL
 *
 * Cette classe est volontairement générique afin d’être
 * réutilisable dans d’autres projets intranet
 * (covoiturage, CE, billetterie, etc.).
 */
class Db
{
    /**
     * Instance unique de PDO (Singleton)
     *
     * @var PDO|null
     */
    private static ?PDO $pdo = null;

    /**
     * Retourne l’instance PDO.
     * Si elle n’existe pas encore, elle est créée.
     *
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        // Si aucune connexion n’existe encore, on la crée
        if (self::$pdo === null) {

            try {

                /**
                 * DSN (Data Source Name)
                 * Connexion à MySQL en local (XAMPP)
                 */
                $dsn = 'mysql:host=127.0.0.1;dbname=covoiturage_db;charset=utf8';

                /**
                 * Identifiants MySQL
                 * ⚠️ IMPORTANT :
                 *  - On n’utilise JAMAIS "root" dans une application
                 *  - On utilise un utilisateur RESTREINT
                 */
                $username = 'covoit_user';
                $password = 'MotDePasseSolide!2025';

                /**
                 * Options PDO recommandées
                 */
                $options = [
                    // Les erreurs PDO lèvent des exceptions
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

                    // Les résultats sont retournés sous forme d’objets
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,

                    // Désactivation de l’émulation des requêtes préparées
                    // (meilleure sécurité et compatibilité MySQL)
                    PDO::ATTR_EMULATE_PREPARES => false
                ];

                // Création de l’instance PDO
                self::$pdo = new PDO($dsn, $username, $password, $options);

            } catch (PDOException $e) {

                /**
                 * En environnement de développement :
                 * on affiche l’erreur pour faciliter le debug.
                 *
                 * En production :
                 *  - on loguerait l’erreur
                 *  - on afficherait un message générique
                 */
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }

        // Retourne l’instance PDO existante ou nouvellement créée
        return self::$pdo;
    }
}






