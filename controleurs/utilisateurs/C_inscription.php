<?php
    require_once "controleurs/C_menu.php";

    class C_inscription
    {
        private $data;
        private $controleurMenu;

        public function __construct()
        {
            $this->data = array();
            $this->controleurMenu = new C_menu();
        }

        public function action_afficher()
        {
            // Remplir les données via le menu
            $this->controleurMenu->FillData($this->data);

            // Inclure la vue
            require_once "vues/partiels/v_entete.php";
            require_once "vues/utilisateurs/v_inscription.php";
            require_once "vues/partiels/v_piedPage.php";
        }

        public function action_inscrire($email, $password, $confirmPassword)
        {
            // à faire : valider et enregistrer les informations d'inscription
            $this->controleurMenu->FillData($this->data);

            // Pour l'instant, rediriger vers la page de connexion après "inscription"
            header("Location: index.php?page=connexion");
            exit();
        }
    }