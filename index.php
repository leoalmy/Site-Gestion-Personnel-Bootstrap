<?php

    if (!empty($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = "accueil";
    }

    switch ($page) {
        case "accueil":
            require_once "controleurs/C_accueil.php";
            $controleur = new C_accueil();
            $controleur->action_afficher();
            break;

        case "listeEmployes":
            require_once "controleurs/C_consulterEmployes.php";
            $controleur=new C_consulterEmployes();
            $controleur->action_listeEmployes($_GET['service']);
            break; 

        default:
            require_once "controleurs/C_accueil.php";
            $controleur = new C_accueil();
            $controleur->action_afficher();
            break;
    }
?>
