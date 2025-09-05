<?php
    require_once "C_menu.php";
    require_once "modeles/M_service.php";
    require_once "modeles/M_employe.php";
    class C_consulterEmployes
    {
        private $data;
        private $modele_employe;

        public function __construct()
        {
            $this->data=array();
            $this->controleurMenu=new C_menu();
            $this->modeleService=new M_service();
            $this->modeleEmploye=new M_employe(); 
        }

        public function action_listeEmployes($codeService)
        {
            $this->controleurMenu->FillData($this->data) ;
            if ($codeService=="all")
            {
            $this->data['leService']=null;
            $this->data['lesEmployes']=$this->modeleEmploye->GetListe();
            }
            else
            {
                $this->data['leService']=$this->modeleService->GetService($codeService);
                $this->data['lesEmployes' ]=$this->modeleEmploye
                    ->GetListeService($codeService);
            }

            require_once "vues/v_entete.php";
            require_once "vues/v_listeEmployes.php";
            require_once "vues/v_piedPage.php";
        }
    } 