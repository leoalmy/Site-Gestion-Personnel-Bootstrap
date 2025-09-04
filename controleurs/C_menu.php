<?php
    require_once "modeles/M_service.php";
    class C_menu
    {
        private $modeleService;
        public function __construct()
        {
            $this->modeleService=new M_service();
        }
        public function FillData(&$data)
        {
            $data['lesServices']=$this->modeleService->GetListe();
        } 
    }
?>