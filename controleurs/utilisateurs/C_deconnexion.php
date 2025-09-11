<?php
    require_once "controleurs/C_base.php";

    class C_deconnexion extends C_base
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function action_deconnexion()
        {
            $_SESSION['user'] = null;
            header('Location: index.php?page=accueil');
        }
    }
?>