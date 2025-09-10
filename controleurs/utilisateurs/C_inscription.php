<?php
    require_once "controleurs/C_menu.php";
    require_once "modeles/M_utilisateur.php";

    class C_inscription
    {
        private $data;
        private $controleurMenu;

        public function __construct()
        {
            $this->data = array();
            $this->controleurMenu = new C_menu();
            $this->modeleUtilisateur = new M_utilisateur();
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

        public function action_inscrire()
        {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $password = $_POST['mdp'];
            $confirmpassword = $_POST['mdpConf'];
            $tel = $_POST['tel'];

            // à faire : valider et enregistrer les informations d'inscription
            $this->controleurMenu->FillData($this->data);

            // Pour l'instant, rediriger vers la page de connexion après "inscription"
            if ($password === $confirmpassword) {
                $success = $this->modeleUtilisateur->AjouterUtilisateur($nom, $prenom, $email, $password, $tel);
                if ($success) {
                    header("Location: index.php?page=connexion");
                } else {
                    $this->data['typeMessage'] = "error";
                    $this->data['leMessage'] = "L'email est déjà utilisé.";
                    require_once "vues/partiels/v_entete.php";
                    //require_once "vues/partiels/v_message.php";
                    //require_once "vues/utilisateurs/v_inscription.php";
                    require_once "vues/partiels/v_piedPage.php";
                }
            } else {
                $this->data['typeMessage'] = "error";
                $this->data['leMessage'] = "Les mots de passe ne correspondent pas.";
                require_once "vues/partiels/v_entete.php";
                require_once "vues/partiels/v_message.php";
                require_once "vues/utilisateurs/v_inscription.php";
                require_once "vues/partiels/v_piedPage.php";
            }
            exit();
        }
    }