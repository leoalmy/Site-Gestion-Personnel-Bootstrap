<?php
require_once "metiers/Utilisateurs.php";
session_start();

// Helpers
require_once __DIR__ . "/app/helpers/csrf.php";
require_once __DIR__ . "/app/helpers/RoleManager.php";

use App\Helpers\RoleManager;

// Load configs
$routes = require __DIR__ . "/config/routes.php";
$roleHierarchy = require __DIR__ . "/config/roles.php";
$roleManager = new RoleManager($roleHierarchy);

// Determine page
$page = preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['page'] ?? 'accueil');
if (!isset($routes[$page])) {
    $page = "accueil";
}

$route = $routes[$page];

// Protected route check (requires login)
if (!empty($route['protected']) && empty($_SESSION['user'])) {
    redirect("connexion");
}

// Prevent logged-in users from accessing login/register
if (in_array($page, ['connexion', 'inscription']) && !empty($_SESSION['user'])) {
    redirect("accueil");
}

// Role-based access check (optional)
if (!empty($route['role_required'])) {
    $currentUser = $_SESSION['user'] ?? null;
    $userRoles = $currentUser ? [$currentUser->GetRole()] : [];

    if (!$roleManager->hasRole($userRoles, $route['role_required'])) {
        http_response_code(403);
        require __DIR__ . "/vues/errors/403.php";
        exit();
    }
}

// Load and execute controller
require_once $route['file'];
$controller = new $route['class'];

// Detect HTTP method
if (is_array($route['method'])) {
    $method = strtolower($_SERVER['REQUEST_METHOD']);
    $method = $route['method'][$method] ?? reset($route['method']);
} else {
    $method = $route['method'];
}

// Gather params
$params = [];
foreach ($route['params'] as $param) {
    $source = $param['source'] === 'post' ? $_POST : $_GET;
    $params[] = $source[$param['name']] ?? null;
}

// Execute
call_user_func_array([$controller, $method], $params);


// Utility: simple redirect
function redirect($page) {
    header("Location: index.php?page=$page");
    exit();
}
?>
