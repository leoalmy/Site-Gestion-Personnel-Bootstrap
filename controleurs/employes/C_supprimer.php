<?php
    require_once "controleurs/C_menu.php";
    require_once "modeles/M_employe.php";

    class C_supprimerEmploye
    {
        private $data = array();

        public function __construct()
        {
            $this->data = array();
            $this->controleurMenu = new C_menu();
        }

        public function action_supprimer($matricule)
        {
            $this->controleurMenu->FillData($this->data);
            $modeleEmploye = new M_employe();
            $ok = $modeleEmploye->Supprimer($matricule);
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