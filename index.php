<?php
    require_once "metiers/Utilisateurs.php";
    session_start();

    $routes = [
        "accueil" => [
            "file" => "controleurs/C_accueil.php",
            "class" => "C_accueil",
            "method" => "action_afficher",
            "params" => [],
            "protected" => false
        ],

        "listeEmployes" => [
            "file" => "controleurs/employes/C_consulter.php",
            "class" => "C_consulterEmployes",
            "method" => "action_listeEmployes",
            "params" => [$_GET['service'] ?? null],
            "protected" => false
        ],

        "saisieEmploye" => [
            "file" => "controleurs/employes/C_ajouter.php",
            "class" => "C_ajouterEmploye",
            "method" => "action_saisie",
            "params" => [],
            "protected" => true
        ],

        "ajoutEmploye" => [
            "file" => "controleurs/employes/C_ajouter.php",
            "class" => "C_ajouterEmploye",
            "method" => "action_ajout",
            "params" => [
                $_POST['nom'] ?? null,
                $_POST['prenom'] ?? null,
                $_POST['service'] ?? null
            ],
            "protected" => true
        ],

        "supprimerEmploye" => [
            "file" => "controleurs/employes/C_supprimer.php",
            "class" => "C_supprimerEmploye",
            "method" => "action_supprimer",
            "params" => [$_GET['matricule'] ?? null],
            "protected" => true
        ],

        "modifierEmploye" => [
            "file" => "controleurs/employes/C_modifier.php",
            "class" => "C_modifierEmploye",
            "method" => ($_SERVER['REQUEST_METHOD'] === 'POST') 
                ? "action_modifier" 
                : "action_afficher",
            "params" => [],
            "protected" => true
        ],

        "listeServices" => [
            "file" => "controleurs/services/C_consulter.php",
            "class" => "C_consulterServices",
            "method" => "action_listeServices",
            "params" => [],
            "protected" => false
        ],

        "saisieService" => [
            "file" => "controleurs/services/C_ajouter.php",
            "class" => "C_ajouterService",
            "method" => "action_saisie",
            "params" => [],
            "protected" => true
        ],

        "ajoutService" => [
            "file" => "controleurs/services/C_ajouter.php",
            "class" => "C_ajouterService",
            "method" => "action_ajout",
            "params" => [$_POST['designation'] ?? null],
            "protected" => true
        ],

        "supprimerService" => [
            "file" => "controleurs/services/C_supprimer.php",
            "class" => "C_supprimerService",
            "method" => "action_supprimer",
            "params" => [$_GET['code'] ?? null],
            "protected" => true
        ],

        "modifierService" => [
            "file" => "controleurs/services/C_modifier.php",
            "class" => "C_modifierService",
            "method" => ($_SERVER['REQUEST_METHOD'] === 'POST') 
                ? "action_modifier" 
                : "action_afficher",
            "params" => [],
            "protected" => true
        ],

        "connexion" => [
            "file" => "controleurs/utilisateurs/C_connexion.php",
            "class" => "C_connexion",
            "method" => ($_SERVER['REQUEST_METHOD'] === 'POST') 
                ? "action_connexion" 
                : "action_afficher",
            "params" => [],
            "protected" => false
        ],

        "deconnexion" => [
            "file" => "controleurs/utilisateurs/C_deconnexion.php",
            "class" => "C_deconnexion",
            "method" => "action_deconnexion",
            "params" => [],
            "protected" => true
        ],

        "inscription" => [
            "file" => "controleurs/utilisateurs/C_inscription.php",
            "class" => "C_inscription",
            "method" => ($_SERVER['REQUEST_METHOD'] === 'POST') 
                ? "action_inscrire" 
                : "action_afficher",
            "params" => [],
            "protected" => false
        ],

        "profil" => [
            "file" => "controleurs/utilisateurs/C_profil.php",
            "class" => "C_profil",
            "method" => "action_afficher",
            "params" => [],
            "protected" => true
        ],

        "consulterComptes" => [
            "file" => "controleurs/utilisateurs/C_consulter.php",
            "class" => "C_consulter",
            "method" => "action_afficher",
            "params" => [],
            "protected" => true
        ]
    ];


    $page = $_GET['page'] ?? 'accueil';

    if (isset($routes[$page])) {
        $route = $routes[$page];

        // Check if page requires authentication
        if (!empty($route['protected']) && !isset($_SESSION['user'])) {
            // Redirect to login if not logged in
            header("Location: index.php?page=connexion");
            exit();
        }

        if ($page == "connexion" && isset($_SESSION['user'] )|| $page == "inscription" && isset($_SESSION['user'])) {
            header("Location: index.php?page=accueil");
            exit();
        }

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
