<?php
    require_once "C_menu.php";
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
            require_once "vues/v_entete.php";
            if (isset($_GET['matricule'])) {
                $matricule = $_GET['matricule'];

                $m_employe = new M_employe();
                $ok = $m_employe->Supprimer($matricule);

                if ($ok) {
                    $this->data['typeMessage'] = "success";
                    $this->data['leMessage'] = "L'employé avec le matricule $matricule a été supprimé avec succès.";
                    
                } else {
                    $this->data['typeMessage'] = "error";
                    $this->data['leMessage'] = "Erreur lors de la suppression de l'employé.";
                }
            } else {
                header("Location: index.php?page=accueil");
                exit();
            }
            require_once "vues/v_message.php";
            require_once "vues/v_piedPage.php";
        }
    }
?>