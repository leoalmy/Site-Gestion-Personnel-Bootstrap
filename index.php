<?php
    require_once "metiers/Utilisateurs.php";
    session_start();

    require_once __DIR__ . "/app/helpers/csrf.php";
    $routes = require __DIR__ . "/config/routes.php";

    $page = preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['page'] ?? 'accueil');
    if (!isset($routes[$page])) {
        $page = "accueil";
    }

    $route = $routes[$page];

    if (!empty($route['protected']) && empty($_SESSION['user'])) {
        redirect("connexion");
    }

    if (in_array($page, ['connexion','inscription']) && !empty($_SESSION['user'])) {
        redirect("accueil");
    }

    require_once $route['file'];
    $controller = new $route['class'];

    if (is_array($route['method'])) {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $method = $route['method'][$method] ?? reset($route['method']);
    } else {
        $method = $route['method'];
    }

    $params = [];
    foreach ($route['params'] as $param) {
        $source = $param['source'] === 'post' ? $_POST : $_GET;
        $params[] = $source[$param['name']] ?? null;
    }

    call_user_func_array([$controller, $method], $params);

    function redirect($page) {
        header("Location: index.php?page=$page");
        exit();
    }
?>