<?php
    require_once "controleurs/C_base.php";
    require_once "modeles/M_utilisateur.php";

    class C_inscription extends C_base
    {
        private $modeleUtilisateur;

        public function __construct()
        {
            parent::__construct();
            $this->modeleUtilisateur = new M_utilisateur();
        }

        public function action_afficher()
        {
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

            // Pour l'instant, rediriger vers la page de connexion après "inscription"
            if ($password === $confirmpassword) {
                $success = $this->modeleUtilisateur->AjouterUtilisateur($nom, $prenom, $email, $password, $tel);
                if ($success) {
                    header("Location: index.php?page=connexion");
                } else {
                    $this->data['typeMessage'] = "error";
                    $this->data['leMessage'] = "❌ L'email est déjà utilisé.";
                    require_once "vues/partiels/v_entete.php";
                    require_once "vues/utilisateurs/v_inscription.php";
                    require_once "vues/partiels/v_piedPage.php";
                }
            } else {
                $this->data['typeMessage'] = "error";
                $this->data['leMessage'] = "❌ Les mots de passe ne correspondent pas.";
                require_once "vues/partiels/v_entete.php";
                require_once "vues/utilisateurs/v_inscription.php";
                require_once "vues/partiels/v_piedPage.php";
            }
            exit();
        }
    }