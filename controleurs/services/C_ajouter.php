<?php
    require_once "controleurs/C_menu.php";
    require_once "modeles/M_service.php";

    class C_ajouterService
    {
        private $data;
        private $controleurMenu;
        private $modeleService;

        public function __construct()
        {
            $this->data=array();
            $this->controleurMenu=new C_menu();
            $this->modeleService=new M_service();
        }

        public function action_saisie()
        { 
            $this->controleurMenu->FillData($this->data) ;
            require_once "vues/partiels/v_entete.php";
            require_once "vues/services/v_saisie.php";
            require_once "vues/partiels/v_piedPage.php";
        }

        public function action_ajout($libelle)
        {
            $this->controleurMenu->FillData($this->data) ;
            $ok = $this->modeleService->Ajouter($libelle);
            if ($ok) {
                header("Location: index.php?service=all&page=listeServices&msg=added");
                exit();
            } else {
                $this->data['typeMessage'] = "error";
                $this->data['leMessage'] = "Erreur lors de l'ajout du service.";
                require_once "vues/partiels/v_entete.php";
                require_once "vues/partiels/v_message.php";
                require_once "vues/partiels/v_piedPage.php";
            }
        }
    }