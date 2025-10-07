<?php
require_once "controleurs/C_base.php";
require_once "modeles/M_service.php";

class C_modifierService extends C_base
{
    private $modeleService;

    public function __construct()
    {
        parent::__construct();
        $this->modeleService = new M_service();
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
            } else {
                $modalId = 'errorModal';
                $title = 'Erreur';
                $type = "error";
                $body = "❌ Service non trouvé.";
                $redirectUrl = "index.php?page=listeServices";
                $redirectDelay = 4000;
                $showModal = true;
                require_once "vues/partiels/v_modal.php";
            }
        } else {
            $modalId = 'errorModal';
            $title = 'Erreur';
            $type = "error";
            $body = "❌ Code du service manquant.";
            $redirectUrl = "index.php?page=listeServices";
            $redirectDelay = 4000;
            $showModal = true;
            require_once "vues/partiels/v_modal.php";
        }

        require_once "vues/partiels/v_piedPage.php";
    }

    public function action_modifier()
    {
        $code        = $_POST['code']             ?? '';
        $designation = trim($_POST['designation'] ?? '');
        $erreurs = [];

        if (empty($code)) {
            $erreurs[] = "Code du service manquant.";
        }
        if (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ\- ]{2,50}$/u', $designation)) {
            $erreurs[] = "La désignation est invalide (2 à 50 caractères).";
        }

        if (empty($erreurs)) {
            $ok = $this->modeleService->Modifier($code, $designation);
            if ($ok) {
                header("Location: index.php?page=listeServices&msg=modified");
                exit();
            } else {
                $this->data['typeMessage'] = "error";
                $this->data['leMessage']   = "❌ Erreur lors de la modification du service.";
            }
        } else {
            $this->data['typeMessage'] = "error";
            $this->data['leMessage']   = implode("\n", $erreurs);
        }

        // 🔄 Réaffichage du formulaire avec données existantes
        $this->data['leService'] = $this->modeleService->GetService($code);

        require_once "vues/partiels/v_entete.php";
        require_once "vues/services/v_modifier.php";
        require_once "vues/partiels/v_piedPage.php";
    }
}
