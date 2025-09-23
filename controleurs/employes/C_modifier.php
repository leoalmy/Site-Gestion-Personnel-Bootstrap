<?php
require_once "controleurs/C_base.php";
require_once "modeles/M_employe.php";
require_once "modeles/M_service.php";

class C_modifierEmploye extends C_base
{
    private $modeleService;
    private $modeleEmploye;

    public function __construct()
    {
        parent::__construct();
        $this->modeleService = new M_service();
        $this->modeleEmploye = new M_employe();
    }

    public function action_afficher()
    {
        require_once "vues/partiels/v_entete.php";

        if (isset($_GET['matricule'])) {
            $matricule = $_GET['matricule'] ?? '';

            // ✅ Validation matricule
            if (!preg_match('/^e[0-9]+$/', $matricule)) {
                $this->data['typeMessage'] = "error";
                $this->data['leMessage'] = "Matricule non valide.";
                require_once "vues/partiels/v_message.php";
            } else {
                $employe = $this->modeleEmploye->GetEmploye($matricule);

                if ($employe) {
                    $this->data['unEmploye'] = $employe;
                    $this->data['lesServices'] = $this->modeleService->GetListe();
                    require_once "vues/employes/v_modifier.php";
                } else {
                    $this->data['typeMessage'] = "error";
                    $this->data['leMessage'] = "Employé non trouvé.";
                    require_once "vues/partiels/v_message.php";
                }
            }
        } else {
            $this->data['typeMessage'] = "error";
            $this->data['leMessage'] = "Matricule non spécifié.";
            require_once "vues/partiels/v_message.php";
        }

        require_once "vues/partiels/v_piedPage.php";
    }

    public function action_modifier()
    {
        $matricule = $_POST['matricule'] ?? '';
        $nom       = trim($_POST['nom'] ?? '');
        $prenom    = trim($_POST['prenom'] ?? '');
        $service   = trim($_POST['service'] ?? '');

        $erreurs = [];

        // ✅ Validation matricule
        if (!preg_match('/^e[0-9]+$/', $matricule)) {
            $erreurs[] = "Matricule invalide (doit commencer par 'e' suivi de chiffres).";
        }

        // ✅ Validation des autres champs
        if (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ\- ]{2,50}$/u', $nom)) {
            $erreurs[] = "Nom invalide (2 à 50 caractères).";
        }
        if (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ\- ]{2,50}$/u', $prenom)) {
            $erreurs[] = "Prénom invalide (2 à 50 caractères).";
        }
        if (empty($service)) {
            $erreurs[] = "Service obligatoire.";
        }

        if (empty($erreurs)) {
            $ok = $this->modeleEmploye->Modifier($matricule, $nom, $prenom, $service);
            if ($ok) {
                header("Location: index.php?service=all&page=listeEmployes&msg=modified");
                exit();
            } else {
                $this->data['typeMessage'] = "error";
                $this->data['leMessage'] = "Erreur lors de la modification de l'employé.";
            }
        } else {
            $this->data['typeMessage'] = "error";
            $this->data['leMessage'] = implode("\n", $erreurs); // ✅ séparateur lignes
        }

        // ✅ Toujours recharger les données pour la vue
        $this->data['unEmploye'] = $this->modeleEmploye->GetEmploye($matricule);
        $this->data['lesServices'] = $this->modeleService->GetListe();

        require_once "vues/partiels/v_entete.php";
        require_once "vues/employes/v_modifier.php";
        require_once "vues/partiels/v_piedPage.php";
    }
}
