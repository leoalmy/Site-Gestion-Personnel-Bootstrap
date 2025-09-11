<?php
    require_once "controleurs/C_base.php";
    require_once "modeles/M_service.php";

    class C_ajouterService extends C_base
    {
        private $modeleService;

        public function __construct()
        {
            parent::__construct();
            $this->modeleService=new M_service();
        }

        public function action_saisie()
        {
            $this->data['nextCode'] = $this->modeleService->GenererCode();
            require_once "vues/partiels/v_entete.php";
            require_once "vues/services/v_saisie.php";
            require_once "vues/partiels/v_modalConfirm.php";
            require_once "vues/partiels/v_piedPage.php";
        }

        public function action_ajout($designation)
        {
            $ok = $this->modeleService->Ajouter($designation);
            if ($ok) {
                $this->data['typeMessage'] = "success";
                $this->data['leMessage'] = "Service ajouté avec succès.";
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