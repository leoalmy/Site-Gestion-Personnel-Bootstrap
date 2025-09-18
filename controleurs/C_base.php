<?php
require_once "controleurs/C_menu.php";

class C_base
{
        protected $data = [];

        public function __construct()
        {
            // Always set session-related flags
            $this->data['isLoggedOn'] = !empty($_SESSION['user']);
            $this->data['user'] = $_SESSION['user'] ?? null;

            try {
                $menu = new C_menu();
                $menu->FillData($this->data);
            } catch (\Exception $e) {
                // Log the technical details
                error_log($e->getMessage());

                // Set a friendly error for the modal
                $this->data['typeMessage'] = "error";
                $this->data['leMessage'] = "⚠️ Impossible de charger le menu (problème de base de données).";
            }
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