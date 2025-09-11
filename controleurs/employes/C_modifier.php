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

                if (isset($_GET['matricule'])) 
                {
                    $matricule = $_GET['matricule'];
                    $employe = $this->modeleEmploye->GetEmploye($matricule);
                    
                    if ($employe)
                    {
                        $services = $this->modeleService->GetListe();
                        require_once "vues/employes/v_modifier.php";
                    } 
                    else 
                    {
                        $this->data['typeMessage'] = "error";
                        $this->data['leMessage'] = "Employé non trouvé.";
                        require_once "vues/partiels/v_message.php";
                    }
                } 
                else 
                {
                    $this->data['typeMessage'] = "error";
                    $this->data['leMessage'] = "Matricule non spécifié.";
                    require_once "vues/partiels/v_message.php";
                }
                require_once "vues/partiels/v_piedPage.php";
            }

        public function action_modifier()
        {
            $matricule = $_POST['matricule'] ?? null;
            $nom       = $_POST['nom'] ?? null;
            $prenom    = $_POST['prenom'] ?? null;
            $service   = $_POST['service'] ?? null;

            if ($matricule && $nom && $prenom && $service) {
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
                $this->data['leMessage'] = "Tous les champs sont requis.";
            }

            $this->data['unEmploye'] = $this->modeleEmploye->GetEmploye($matricule);
            $this->data['lesServices'] = $this->modeleService->GetListe();
            require_once "vues/v_entete.php";
            require_once "vues/v_message.php";
            require_once "vues/v_modifierEmploye.php";
        }
    }