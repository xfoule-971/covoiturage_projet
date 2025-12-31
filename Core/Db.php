<?php
namespace Core;

use PDO;
use PDOException;

/**
 * Class Db
 *
 * Gestion centralisée de la connexion à la base de données.
 * Utilise le pattern Singleton afin de :
 *  - limiter le nombre de connexions
 *  - garantir une seule instance PDO dans toute l'application
 *
 * Cette classe est réutilisable pour d'autres projets intranet
 * (CE, billetterie, achats groupés, etc.).
 */
class Db
{
    /**
     * Instance unique de PDO
     *
     * @var PDO|null
     */
    private static ?PDO $pdo = null;

    /**
     * Retourne l'instance PDO (créée une seule fois)
     *
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        // Création de la connexion uniquement si elle n'existe pas encore
        if (self::$pdo === null) {

            try {
                self::$pdo = new PDO(
                    // DSN : connexion MySQL locale (XAMPP)
                    'mysql:host=127.0.0.1;dbname=covoiturage_db;charset=utf8',

                    // Identifiants (en intranet, pas de compte distant)
                    'root',
                    '',

                    // Options PDO
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_EMULATE_PREPARES   => false
                    ]
                );

            } catch (PDOException $e) {

                /*
                 * En environnement de développement :
                 * on affiche l'erreur pour faciliter le debug.
                 *
                 * En production, on pourrait :
                 *  - loguer l'erreur
                 *  - afficher un message générique
                 */
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}





