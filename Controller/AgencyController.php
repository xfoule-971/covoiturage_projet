<?php
namespace Controller;

use Models\AgencyModel;
use Core\Auth;

/**
 * Class AgencyController
 *
 * Gestion des agences (villes)
 */
class AgencyController {

    private AgencyModel $agencyModel;

    public function __construct() {
        $this->agencyModel = new AgencyModel();
    }

    /**
     * Liste des agences (public + admin)
     */
    public function index(): void {
        $agencies = $this->agencyModel->findAll();

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/agencies/index.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    /**
     * Création d'une agence (ADMIN)
     */
    public function create(array $data): void {
        Auth::requireAdmin();

        $name = trim($data['name'] ?? '');

        if (!$name) {
            die('Nom obligatoire');
        }

        $this->agencyModel->create(['name' => $name]);

        header('Location: /covoiturage-projet/public/agencies');
        exit;
    }

    /**
     * Mise à jour d'une agence (ADMIN)
     */
    public function update(int $id, array $data): void {
        Auth::requireAdmin();

        $name = trim($data['name'] ?? '');

        if (!$name) {
            die('Nom obligatoire');
        }

        $this->agencyModel->update($id, ['name' => $name]);

        header('Location: /covoiturage-projet/public/agencies');
        exit;
    }

    /**
     * Suppression d'une agence (ADMIN)
     */
    public function delete(int $id): void {
        Auth::requireAdmin();

        $this->agencyModel->delete($id);

        header('Location: /covoiturage-projet/public/agencies');
        exit;
    }
}




