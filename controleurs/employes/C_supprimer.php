<?php
require_once "controleurs/C_base.php";
require_once "modeles/M_employe.php";

class C_supprimerEmploye extends C_base
{
    private $controleurMenu;
    private $modeleEmploye;

    public function __construct()
    {
        parent::__construct();
        $this->controleurMenu = new C_menu();
        $this->modeleEmploye  = new M_employe();
    }

    public function action_supprimer($matricule = null)
    {
        // ✅ S'assurer que la requête est bien POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?page=listeEmployes&service=all");
            exit();
        }

        // ✅ Vérifie le token CSRF (méthode héritée de C_base)
        $this->checkCsrf();

        // ✅ Récupère le matricule depuis POST si non fourni
        if (empty($matricule)) {
            $matricule = $_POST['matricule'] ?? null;
        }

        if (empty($matricule)) {
            $this->showErrorModal("Matricule manquant pour la suppression.");
            return;
        }

        // ✅ Supprime l’employé
        $ok = $this->modeleEmploye->Supprimer($matricule);
        if ($ok) {
            header("Location: index.php?page=listeEmployes&typeMessage=success&leMessage=" . urlencode("Employé supprimé avec succès"));
            exit();
        } else {
            $this->showErrorModal("❌ Erreur lors de la suppression de l'employé.");
        }
    }

    private function showErrorModal(string $message)
    {
        $modalId = 'errorModal';
        $title = 'Erreur';
        $showModal = true;
        $type = "error";
        $body = $message;
        $redirectUrl = "index.php?page=listeEmployes&service=all";
        $redirectDelay = 4000;
        require_once "vues/partiels/v_entete.php";
        require_once "vues/partiels/v_modal.php";
        require_once "vues/partiels/v_piedPage.php";
    }
}
