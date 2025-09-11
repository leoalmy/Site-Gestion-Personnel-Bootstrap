<?php
    require_once "C_menu.php";

    class C_base
    {
        protected $data = [];
        protected $controleurMenu;

        public function __construct()
        {
            // Always initialize session data
            $this->data['isLoggedOn'] = $this->isLoggedOn();
            $this->data['user'] = $this->getCurrentUser();

            // Always initialize menu
            $this->controleurMenu = new C_menu();
            $this->controleurMenu->FillData($this->data);
        }

        protected function isLoggedOn(): bool {
            return isset($_SESSION['user']);
        }

        protected function getCurrentUser() {
            return $_SESSION['user'] ?? null;
        }
    }
?>