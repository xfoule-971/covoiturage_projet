<?php
namespace Core;

/**
 * Class Autoloader
 *
 * Autoloader maison basé sur les namespaces.
 * Permet de charger automatiquement les classes du projet
 * sans utiliser require_once partout.
 *
 * Architecture prise en charge :
 *  - Core\
 *  - Router\
 *  - Controller\
 *  - Models\
 *
 * Compatible Windows (XAMPP) et Linux (serveur intranet).
 * Réutilisable pour d'autres projets MVC de l'entreprise.
 */
class Autoloader
{
    /**
     * Enregistre la fonction d'autoload auprès de PHP
     */
    public static function register(): void
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    /**
     * Charge automatiquement un fichier PHP correspondant à une classe
     *
     * @param string $class Nom complet de la classe avec namespace
     */
    public static function autoload(string $class): void
    {
        // Racine du projet (ex: C:/xampp/htdocs/covoiturage-projet/)
        $baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;

        /*
         * Tableau des namespaces supportés
         * clé   = namespace
         * valeur = dossier correspondant
         */
        $prefixes = [
            'Core\\'       => 'Core/',
            'Router\\'     => 'Router/',
            'Controller\\' => 'Controller/',
            'Models\\'     => 'Models/',
        ];

        // Parcourt les namespaces connus
        foreach ($prefixes as $prefix => $dir) {

            // Vérifie si la classe commence par le namespace courant
            if (strpos($class, $prefix) === 0) {

                // Supprime le namespace pour obtenir le nom du fichier
                $relativeClass = str_replace($prefix, '', $class);

                // Construit le chemin complet vers le fichier PHP
                $file = $baseDir
                      . $dir
                      . str_replace('\\', '/', $relativeClass)
                      . '.php';

                // Inclusion du fichier s'il existe
                if (file_exists($file)) {
                    require_once $file;
                }

                // On sort dès qu'un namespace correspond
                return;
            }
        }
    }
}




