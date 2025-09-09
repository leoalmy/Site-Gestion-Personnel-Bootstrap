<?php
    require_once "controleurs/C_menu.php";

    class C_profil
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
            require_once "vues/utilisateurs/v_profil.php";
            require_once "vues/partiels/v_piedPage.php";
        }
    }
?>