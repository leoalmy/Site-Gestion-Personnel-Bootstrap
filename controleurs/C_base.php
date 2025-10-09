<?php
require_once "controleurs/C_menu.php";
require_once __DIR__ . "/../app/helpers/RoleManager.php";

use App\Helpers\RoleManager;

class C_base
{
    protected $data = [];

    public function __construct()
    {
        $this->data['isLoggedOn'] = !empty($_SESSION['user']);
        $this->data['user'] = $_SESSION['user'] ?? null;

        try {
            $menu = new C_menu();
            $menu->FillData($this->data);
        } catch (\Exception $e) {
            error_log($e->getMessage());
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
        if (isset($_SESSION['user'])) {
            return $_SESSION['user']->GetRole() ?? "ROLE_MEMBRE";
        }
        return "ROLE_AUCUN";
    }

    protected function checkCsrf() {
        $token = $_POST['csrf_token'] ?? '';
        if (!verify_csrf_token($token)) {
            die('Invalid CSRF token');
        }
    }

    protected function requireRole(string $role) {
        $roleHierarchy = require __DIR__ . "/../config/roles.php";
        $roleManager = new RoleManager($roleHierarchy);

        $user = $_SESSION['user'] ?? null;
        $userRoles = $user ? [$user->GetRole()] : [];

        if (!$roleManager->hasRole($userRoles, $role)) {
            http_response_code(403);
            die("🚫 Vous n'avez pas le rôle requis ($role)");
        }
    }

    public function afficherErreur($message)
    {
        if (is_array($message)) {
            $message = implode("\n", $message);
        }

        $this->data['typeMessage'] = "error";
        $this->data['leMessage'] = $message;
        $this->action_afficher();
        exit();
    }

    public function action_afficher()
    {
        if (isset($this->data['leMessage'])) {
            echo "<div class='error'>{$this->data['leMessage']}</div>";
        }
    }
}
?>
