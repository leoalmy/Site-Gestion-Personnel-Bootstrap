<?php
    require_once "controleurs/C_base.php";
    require_once "modeles/M_service.php";

    class C_supprimerService extends C_base
    {
        private $modeleService;

        public function __construct()
        {
            parent::__construct();
            $this->modeleService=new M_service();
        }

        public function action_supprimer($code)
        {
            $ok = $this->modeleService->Supprimer($code);
            if ($ok) {
                header("Location: index.php?page=listeServices&msg=deleted");
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