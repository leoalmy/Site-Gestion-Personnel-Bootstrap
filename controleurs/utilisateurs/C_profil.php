<?php
    require_once "controleurs/C_base.php";
    require_once "metiers/Utilisateurs.php";

    class C_profil extends C_base
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function action_afficher()
        {
            if($this->data['isLoggedOn']) {
                require_once "vues/partiels/v_entete.php";
                require_once "vues/utilisateurs/v_profil.php";
                require_once "vues/partiels/v_piedPage.php";
            } else {
                header("Location: index.php?page=connexion");
                exit();
            }
        }
    }
?>