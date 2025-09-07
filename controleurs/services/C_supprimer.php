<?php
    require_once "controleurs/C_menu.php";
    require_once "modeles/M_service.php";

    class C_supprimerService
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

        public function action_supprimer($code)
        {
            $this->controleurMenu->FillData($this->data) ;
            $ok = $this->modeleService->Supprimer($code);
            if ($ok) {
                header("Location: index.php?service=all&page=listeServices&msg=deleted");
                exit();
            } else {
                $this->data['typeMessage'] = "error";
                $this->data['leMessage'] = "Erreur lors de la suppression du service.";
                require_once "vues/partiels/v_entete.php";
                require_once "vues/partiels/v_message.php";
                require_once "vues/partiels/v_piedPage.php";
            }
        }
    }