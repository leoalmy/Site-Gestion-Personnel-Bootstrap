<?php
require_once "controleurs/C_base.php";
require_once "modeles/M_employe.php";
require_once "modeles/M_service.php";

class C_ajouterEmploye extends C_base
{
    private $modeleEmploye;
    private $modeleService;

    public function __construct()
    {
        parent::__construct();
        $this->modeleEmploye = new M_employe();
        $this->modeleService = new M_service();
    }

    // --- Afficher le formulaire de saisie ---
    public function action_saisie()
    {
        // Génère le prochain matricule automatiquement
        $this->data['nextMatricule'] = $this->modeleEmploye->GenererMatricule();

        // Liste des services pour le select
        $this->data['lesServices'] = $this->modeleService->GetListe();

        require_once "vues/partiels/v_entete.php";
        require_once "vues/employes/v_saisie.php";
        require_once "vues/partiels/v_piedPage.php";
    }

    // --- Traitement du formulaire ---
    public function action_ajout($nom, $prenom, $service)
    {
        $erreurs = [];

        // Validation
        if (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ\- ]{2,50}$/u', $nom)) {
            $erreurs[] = "Nom invalide (2 à 50 caractères).";
        }
        if (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ\- ]{2,50}$/u', $prenom)) {
            $erreurs[] = "Prénom invalide (2 à 50 caractères).";
        }
        if (empty($service)) {
            $erreurs[] = "Le service est obligatoire.";
        }

        if (empty($erreurs)) {
            $ok = $this->modeleEmploye->Ajouter($nom, $prenom, $service);
            if ($ok) {
                // ✅ Redirection sur la liste avec message succès
                header("Location: index.php?service=all&page=listeEmployes&msg=added");
                exit();
            } else {
                $this->data['typeMessage'] = "error";
                $this->data['leMessage'] = "Erreur lors de l'ajout de l'employé.";
            }
        } else {
            // Gestion des erreurs
            $this->data['typeMessage'] = "error";
            $this->data['leMessage'] = implode("\n", $erreurs);
        }

        // Réafficher le formulaire avec erreurs
        $this->data['nextMatricule'] = $this->modeleEmploye->GenererMatricule();
        $this->data['lesServices'] = $this->modeleService->GetListe();

        require_once "vues/partiels/v_entete.php";
        require_once "vues/employes/v_saisie.php";
        require_once "vues/partiels/v_piedPage.php";
    }
}
?>