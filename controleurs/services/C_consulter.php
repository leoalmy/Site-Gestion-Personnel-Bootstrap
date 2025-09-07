<?php
    require_once "controleurs/C_menu.php";
    require_once "modeles/M_service.php";

    class C_consulterServices
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

        public function action_listeServices()
        {
            $this->controleurMenu->FillData($this->data) ;
            $this->data['lesServices']=$this->modeleService->GetListe();
            require_once "vues/partiels/v_entete.php";
            require_once "vues/services/v_liste.php";
            require_once "vues/partiels/v_piedPage.php";
        }
    }