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

    public function action_supprimer($matricule)
    {
        $ok = $this->modeleEmploye->Supprimer($matricule);
        if ($ok) {
            // ✅ redirect back to list with success flag
            header("Location: index.php?page=listeEmployes&service=all&msg=deleted");
            exit();
        } else {
            // ❌ failure → show modal error and then redirect the list page
            $modalId = 'errorModal';
            $title = 'Erreur';
            $showModal = true;
            $type = "error";
            $body = "❌ Erreur lors de la suppression de l'employé.";
            $redirectUrl = "index.php?page=listeEmployes&service=all";
            $redirectDelay = 4000;
            require_once "vues/partiels/v_entete.php";
            require_once "vues/partiels/v_modal.php";
            require_once "vues/partiels/v_piedPage.php";
        }
    }
}
