<?php
    require_once "controleurs/C_menu.php";
    require_once "modeles/M_service.php";

    class C_modifierService
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

        public function action_afficher()
        {
            if (isset($_GET['code'])) {
                $code = $_GET['code'];
                $this->data['leService'] = $this->modeleService->GetService($code);
                if ($this->data['leService']) {
                    $this->controleurMenu->FillData($this->data);
                    require_once "vues/partiels/v_entete.php";
                    require_once "vues/services/v_modifier.php";
                    require_once "vues/partiels/v_piedPage.php";
                } else {
                    // Service not found
                    header("Location: index.php?service=all&page=listeServices&msg=notfound");
                    exit();
                }
            } else {
                // No code provided
                header("Location: index.php?service=all&page=listeServices&msg=nocode");
                exit();
            }
        }

        public function action_modifier()
        {
            if (isset($_POST['code']) && isset($_POST['designation'])) {
                $code = $_POST['code'];
                $designation = $_POST['designation'];

                $ok = $this->modeleService->Modifier($code, $designation);
                if ($ok) {
                    header("Location: index.php?service=all&page=listeServices&msg=modified");
                    exit();
                } else {
                    $this->data['typeMessage'] = "error";
                    $this->data['leMessage'] = "Erreur lors de la modification du service.";
                    $this->controleurMenu->FillData($this->data);
                    require_once "vues/partiels/v_entete.php";
                    require_once "vues/partiels/v_message.php";
                    require_once "vues/partiels/v_piedPage.php";
                }
            } else {
                // Missing data
                header("Location: index.php?service=all&page=listeServices&msg=missingdata");
                exit();
            }
        }
    }