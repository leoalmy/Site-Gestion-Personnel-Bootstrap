<?php
require_once "controleurs/C_base.php";
require_once "modeles/M_service.php";

class C_modifierService extends C_base
{
    private $modeleService;

    public function __construct()
    {
        parent::__construct();
        $this->modeleService  = new M_service();
    }

    public function action_afficher()
    {
        require_once "vues/partiels/v_entete.php";

        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            $service = $this->modeleService->GetService($code);

            if ($service) {
                $this->data['leService'] = $service;
                require_once "vues/services/v_modifier.php";
                require_once "vues/partiels/v_modalConfirm.php";
            } else {
                $this->data['typeMessage'] = "error";
                $this->data['leMessage']   = "Service non trouvé.";
                require_once "vues/partiels/v_message.php";
            }
        } else {
            $this->data['typeMessage'] = "error";
            $this->data['leMessage']   = "Code du service non spécifié.";
            require_once "vues/partiels/v_message.php";
        }

        require_once "vues/partiels/v_piedPage.php";
    }

    public function action_modifier()
    {
        $code        = $_POST['code']        ?? null;
        $designation = $_POST['designation'] ?? null;

        if ($code && $designation) {
            $ok = $this->modeleService->Modifier($code, $designation);

            if ($ok) {
                header("Location: index.php?service=all&page=listeServices&msg=modified");
                exit();
            } else {
                $this->data['typeMessage'] = "error";
                $this->data['leMessage']   = "Erreur lors de la modification du service.";
            }
        } else {
            $this->data['typeMessage'] = "error";
            $this->data['leMessage']   = "Tous les champs sont requis.";
        }

        $this->data['leService'] = $this->modeleService->GetService($code);
        require_once "vues/partiels/v_entete.php";
        require_once "vues/partiels/v_message.php";
        require_once "vues/services/v_modifier.php";
        require_once "vues/partiels/v_modalConfirm.php";
        require_once "vues/partiels/v_piedPage.php";
    }
}