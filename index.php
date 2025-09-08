<?php
    $routes = [
        "accueil" => [
            "file" => "controleurs/C_accueil.php",
            "class" => "C_accueil",
            "method" => "action_afficher",
            "params" => []
        ],

        "listeEmployes" => [
            "file" => "controleurs/employes/C_consulter.php",
            "class" => "C_consulterEmployes",
            "method" => "action_listeEmployes",
            "params" => [$_GET['service'] ?? null]
        ],

        "saisieEmploye" => [
            "file" => "controleurs/employes/C_ajouter.php",
            "class" => "C_ajouterEmploye",
            "method" => "action_saisie",
            "params" => []
        ],

        "ajoutEmploye" => [
            "file" => "controleurs/employes/C_ajouter.php",
            "class" => "C_ajouterEmploye",
            "method" => "action_ajout",
            "params" => [
                $_POST['nom'] ?? null,
                $_POST['prenom'] ?? null,
                $_POST['service'] ?? null
            ]
        ],

        "supprimerEmploye" => [
            "file" => "controleurs/employes/C_supprimer.php",
            "class" => "C_supprimerEmploye",
            "method" => "action_supprimer",
            "params" => [$_GET['matricule'] ?? null]
        ],

        "modifierEmploye" => [
            "file" => "controleurs/employes/C_modifier.php",
            "class" => "C_modifierEmploye",
            "method" => ($_SERVER['REQUEST_METHOD'] === 'POST') 
                ? "action_modifier" 
                : "action_afficher",
            "params" => []
        ],

        "listeServices" => [
            "file" => "controleurs/services/C_consulter.php",
            "class" => "C_consulterServices",
            "method" => "action_listeServices",
            "params" => []
        ],

        "saisieService" => [
            "file" => "controleurs/services/C_ajouter.php",
            "class" => "C_ajouterService",
            "method" => "action_saisie",
            "params" => []
        ],

        "ajoutService" => [
            "file" => "controleurs/services/C_ajouter.php",
            "class" => "C_ajouterService",
            "method" => "action_ajout",
            "params" => [$_POST['designation'] ?? null]
        ],

        "supprimerService" => [
            "file" => "controleurs/services/C_supprimer.php",
            "class" => "C_supprimerService",
            "method" => "action_supprimer",
            "params" => [$_GET['code'] ?? null]
        ],

        "modifierService" => [
            "file" => "controleurs/services/C_modifier.php",
            "class" => "C_modifierService",
            "method" => ($_SERVER['REQUEST_METHOD'] === 'POST') 
                ? "action_modifier" 
                : "action_afficher",
            "params" => []
        ]
    ];


    $page = $_GET['page'] ?? 'accueil';

    if (isset($routes[$page])) {
        $route = $routes[$page];
        require_once $route['file'];
        $controller = new $route['class'];
        call_user_func_array([$controller, $route['method']], $route['params']);
    } else {
        // Fallback to accueil
        require_once "controleurs/C_accueil.php";
        $controller = new C_accueil();
        $controller->action_afficher();
    }
?>
