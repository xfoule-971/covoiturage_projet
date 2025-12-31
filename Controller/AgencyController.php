<?php
namespace Controller;

use Models\AgencyModel;
use Core\Auth;

/**
 * Class AgencyController
 *
 * Contrôleur des agences (villes)
 *
 * Fonctionnalités :
 *  - Liste des agences (accessible aux utilisateurs et admins)
 *  - Création, modification, suppression (ADMIN uniquement)
 */
class AgencyController {

    private AgencyModel $agencyModel;

    public function __construct() {
        $this->agencyModel = new AgencyModel();
    }

    /**
     * Liste toutes les agences
     * Pour les utilisateurs : consultation uniquement
     * Pour les admins : accès aux actions CRUD
     */
    public function index(): void {
        // Récupération des agences
        $agencies = $this->agencyModel->findAll();

        // Vue adaptée (différencie USER / ADMIN)
        require __DIR__ . '/../Views/agencies/index.php';
    }

    /**
     * Création d'une nouvelle agence (ADMIN seulement)
     *
     * @param array $data ['name' => 'Nom de l’agence']
     */
    public function create(array $data): void {
        Auth::requireAdmin();

        $name = trim($data['name'] ?? '');
        if (empty($name)) {
            die('Nom de l’agence obligatoire');
        }

        $this->agencyModel->create(['name' => $name]);

        header('Location: /covoiturage-projet/public/agencies');
        exit;
    }

    /**
     * Suppression d'une agence par ID (ADMIN seulement)
     *
     * @param int $id
     */
    public function delete(int $id): void {
        Auth::requireAdmin();
        $this->agencyModel->delete($id);

        header('Location: /covoiturage-projet/public/agencies');
        exit;
    }

    /**
     * Modification d'une agence (ADMIN seulement)
     *
     * @param int $id
     * @param array $data ['name' => 'Nouveau nom']
     */
    public function update(int $id, array $data): void {
        Auth::requireAdmin();
        $name = trim($data['name'] ?? '');
        if (empty($name)) {
            die('Nom de l’agence obligatoire');
        }

        $this->agencyModel->update($id, ['name' => $name]);

        header('Location: /covoiturage-projet/public/agencies');
        exit;
    }
}



