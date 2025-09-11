<?php
    require_once "controleurs/C_base.php";
    require_once "modeles/M_employe.php";

    class C_ajouterEmploye extends C_base
    {
        private $modeleEmploye;

        public function __construct()
        {
            parent::__construct();
            $this->modeleEmploye=new M_employe();
        }

        public function action_saisie()
        { 
            $this->data['nextMatricule'] = $this->modeleEmploye->GenererMatricule();
            require_once "vues/partiels/v_entete.php";
            require_once "vues/employes/v_saisie.php";
            require_once "vues/partiels/v_piedPage.php";
        }

        public function action_ajout($nom, $prenom, $service)
        {
            $ok = $this->modeleEmploye->Ajouter($nom, $prenom, $service);
            if ($ok) {
                header("Location: index.php?service=all&page=listeEmployes&msg=added");
                exit();
            } else {
                $this->data['typeMessage'] = "error";
                $this->data['leMessage'] = "Erreur lors de l'ajout de l'employé.";
                require_once "vues/partiels/v_entete.php";
                require_once "vues/partiels/v_message.php";
                require_once "vues/partiels/v_piedPage.php";
            }
        }
    }
?>