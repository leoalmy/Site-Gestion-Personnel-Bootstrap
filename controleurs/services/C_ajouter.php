<?php
require_once "controleurs/C_base.php";
require_once "modeles/M_service.php";

class C_ajouterService extends C_base
{
    private $modeleService;

    public function __construct()
    {
        parent::__construct();
        $this->modeleService = new M_service();
    }

    public function action_saisie()
    {
        $this->data['nextCode'] = $this->modeleService->GenererCode();
        require_once "vues/partiels/v_entete.php";
        require_once "vues/services/v_saisie.php";
        require_once "vues/partiels/v_piedPage.php";
    }

    public function action_ajout()
    {
        $designation = trim($_POST['designation'] ?? '');
        $erreurs = [];

        // Validation
        if (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ\- ]{2,50}$/u', $designation)) {
            $erreurs[] = "La désignation du service est invalide (2 à 50 caractères).";
        }

        if (empty($erreurs)) {
            $ok = $this->modeleService->Ajouter($designation);
            if ($ok) {
                header("Location: index.php?page=listeServices&msg=added");
                exit();
            } else {
                $this->data['typeMessage'] = "error";
                $this->data['leMessage']   = "Erreur lors de l'ajout du service.";
            }
        } else {
            $this->data['typeMessage'] = "error";
            $this->data['leMessage']   = implode("\n", $erreurs);
        }

        // Réaffichage du formulaire
        $this->data['nextCode'] = $this->modeleService->GenererCode();
        require_once "vues/partiels/v_entete.php";
        require_once "vues/services/v_saisie.php";
        require_once "vues/partiels/v_piedPage.php";
    }
}
