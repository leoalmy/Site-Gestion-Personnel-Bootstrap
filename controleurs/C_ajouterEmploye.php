<?php
    require_once "C_menu.php";
    require_once "modeles/M_employe.php";

    class C_ajouterEmploye
    {
        private $data;
        private $controleurMenu;
        private $modeleEmploye;

        public function __construct()
        {
            $this->data=array();
            $this->controleurMenu=new C_menu();
            $this->modeleEmploye=new M_employe();
        }

        public function action_saisie()
        { 
            $this->controleurMenu->FillData($this->data) ;
            require_once "vues/v_entete.php";
            require_once "vues/v_saisieEmploye.php";
            require_once "vues/v_piedPage.php";
        }

        public function action_ajout($matricule, $nom, $prenom, $service)
        {
            $this->controleurMenu->FillData($this->data);

            // Vérifie si l'employé existe déjà
            if (is_null($this->modeleEmploye->GetEmploye($matricule))) {
                // Ajout de l'employé
                $employe = $this->modeleEmploye->Ajouter($matricule, $nom, $prenom, $service);

                if (is_null($employe)) {
                    $this->data['leMessage'] = "L'ajout a échoué pour une raison indéterminée.";
                } else {
                    $this->data['leMessage'] = $employe->GetNom() . " " . $employe->GetPrenom() . " a été ajouté.";
                }
            } else {
                $this->data['leMessage'] = "Le matricule " . $matricule . " existe déjà, ajout annulé.";
            }

            require_once "vues/v_entete.php";
            require_once "vues/v_message.php";
            require_once "vues/v_piedPage.php";
        }
    }
?>