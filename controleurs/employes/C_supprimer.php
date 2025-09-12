<?php
require_once "controleurs/C_base.php";
require_once "modeles/M_employe.php";

class C_supprimerEmploye extends C_base
{
    private $modeleEmploye;

    public function __construct()
    {
        parent::__construct();
        $this->controleurMenu = new C_menu();
        $this->modeleEmploye = new M_employe(); // fixed
    }

    public function action_supprimer($matricule)
    {
        $ok = $this->modeleEmploye->Supprimer($matricule); // fixed
        if ($ok) {
            header("Location: index.php?service=all&page=listeEmployes&msg=deleted");
            exit();
        } else {
            $this->data['typeMessage'] = "error";
            $this->data['leMessage'] = "Erreur lors de la suppression de l'employé.";
            require_once "vues/partiels/v_entete.php";
            require_once "vues/partiels/v_message.php";
            require_once "vues/partiels/v_piedPage.php";
        }
    }
}
?>
