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
            $this->data['nextMatricule'] = $this->modeleEmploye->GenererMatricule();
            $this->controleurMenu->FillData($this->data) ;
            require_once "vues/v_entete.php";
            require_once "vues/v_saisieEmploye.php";
            require_once "vues/v_piedPage.php";
        }

        public function action_ajout($nom, $prenom, $service)
        {
            $this->controleurMenu->FillData($this->data);

            // Ajout de l'employé (matricule généré automatiquement dans le modèle)
            $employe = $this->modeleEmploye->Ajouter($nom, $prenom, $service);

            if (is_null($employe)) {
                $this->data['typeMessage'] = "error";
                $this->data['leMessage'] = "L'ajout a échoué pour une raison indéterminée.";
            } else {
                $this->data['typeMessage'] = "success";
                $this->data['leMessage'] =
                    $employe->GetNom() . " " . $employe->GetPrenom() .
                    " a été ajouté avec le matricule " . $employe->GetMatricule() . ".";
            }

            require_once "vues/v_entete.php";
            require_once "vues/v_message.php";
            require_once "vues/v_piedPage.php";
        }
    }
?>