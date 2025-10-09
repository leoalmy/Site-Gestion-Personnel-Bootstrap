<?php
namespace App\Helpers;

class RoleManager {
    private array $hierarchy;

    public function __construct(array $hierarchy) {
        $this->hierarchy = $hierarchy;
    }

    public function getAllRolesFor(string $role): array {
        $roles = [$role];
        if (isset($this->hierarchy[$role])) {
            foreach ($this->hierarchy[$role] as $inheritedRole) {
                $roles = array_merge($roles, $this->getAllRolesFor($inheritedRole));
            }
        }
        return array_unique($roles);
    }

    public function hasRole(array $userRoles, string $requiredRole): bool {
        foreach ($userRoles as $role) {
            if (in_array($requiredRole, $this->getAllRolesFor($role), true)) {
                return true;
            }
        }
        return false;
    }
}
?>