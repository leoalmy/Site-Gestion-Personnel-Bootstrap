<?php
    require_once "controleurs/C_menu.php";

    class C_deconnexion
    {
        private $data;
        private $controleurMenu;

        public function __construct()
        {
            $this->data = array();
            $this->controleurMenu = new C_menu();
        }

        public function action_deconnexion()
        {
            // à faire
        }
    }
?>