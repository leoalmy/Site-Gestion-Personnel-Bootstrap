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

        case "saisieEmploye":
            require_once "controleurs/C_ajouterEmploye.php";
            $controleur=new C_ajouterEmploye();
            $controleur->action_saisie(); 
            break;

        case "ajoutEmploye":
            require_once "controleurs/C_ajouterEmploye.php";
            $controleur=new C_ajouterEmploye();
            $controleur->action_ajout($_POST["nom"],$_POST["prenom"], $_POST["service"]); 
            break;

        case "supprimerEmploye":
            require_once "controleurs/C_supprimerEmploye.php";
            $controleur=new C_supprimerEmploye();
            $controleur->action_supprimer($_GET["matricule"]);
            break;

        case "modifierEmploye":
            require_once "controleurs/C_modifierEmploye.php";
            $controleur = new C_modifierEmploye();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Form submitted
                $controleur->action_modifier(
                    $_POST['matricule'] ?? null,
                    $_POST['nom'] ?? null,
                    $_POST['prenom'] ?? null,
                    $_POST['service'] ?? null
                );
            } else {
                // Display form
                $controleur->action_afficher();
            }
            break;

        default:
            require_once "controleurs/C_accueil.php";
            $controleur = new C_accueil();
            $controleur->action_afficher();
            break;
    }
?>
