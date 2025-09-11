<?php
    require_once "controleurs/C_base.php";
    require_once "modeles/M_service.php";

    class C_consulterServices extends C_base
    {
        private $modeleService;

        public function __construct()
        {
            parent::__construct();
            $this->modeleService=new M_service();
        }

        public function action_listeServices()
        {
            if (!empty($_GET['msg']) && $_GET['msg'] == 'deleted') {
                $this->data['typeMessage'] = "success";
                $this->data['leMessage'] = "Le service a été supprimé avec succès.";
            }
            elseif (!empty($_GET['msg']) && $_GET['msg'] == 'modified') {
                $this->data['typeMessage'] = "success";
                $this->data['leMessage'] = "Le service a été modifié avec succès.";
            }
            elseif (!empty($_GET['msg']) && $_GET['msg'] == 'added') {
                $this->data['typeMessage'] = "success";
                $this->data['leMessage'] = "Le service a été ajouté avec succès.";
            }

            $this->data['lesServices']=$this->modeleService->GetListe();
            require_once "vues/partiels/v_entete.php";
            if (isset($_GET['msg'])) {
                require_once "vues/partiels/v_message.php";
            }
            require_once "vues/services/v_liste.php";
            require_once "vues/partiels/v_modalConfirm.php";
            require_once "vues/partiels/v_piedPage.php";
        }
    }