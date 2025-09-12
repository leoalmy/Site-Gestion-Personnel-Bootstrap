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
            $this->data['userRole'] = $this->getCurrentUserRole();

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

        protected function getCurrentUserRole() {
            if(isset($_SESSION['user'])) {
                return $_SESSION['user']->GetRole() ?? "membre";
            }
            else {
                return "Aucun rôle";
            }
        }
    }
?>