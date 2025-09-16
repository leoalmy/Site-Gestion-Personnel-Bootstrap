<?php

return [
    "accueil" => [
        "file" => "controleurs/C_accueil.php",
        "class" => "C_accueil",
        "method" => "action_afficher",
        "protected" => false,
        "params" => []
    ],

    "listeEmployes" => [
        "file" => "controleurs/employes/C_consulter.php",
        "class" => "C_consulterEmployes",
        "method" => "action_listeEmployes",
        "protected" => false,
        "params" => [
            ["source" => "get", "name" => "service"]
        ]
    ],

    "saisieEmploye" => [
        "file" => "controleurs/employes/C_ajouter.php",
        "class" => "C_ajouterEmploye",
        "method" => "action_saisie",
        "protected" => true,
        "params" => []
    ],

    "ajoutEmploye" => [
        "file" => "controleurs/employes/C_ajouter.php",
        "class" => "C_ajouterEmploye",
        "method" => "action_ajout",
        "protected" => true,
        "params" => [
            ["source" => "post", "name" => "nom"],
            ["source" => "post", "name" => "prenom"],
            ["source" => "post", "name" => "service"]
        ]
    ],

    "supprimerEmploye" => [
        "file" => "controleurs/employes/C_supprimer.php",
        "class" => "C_supprimerEmploye",
        "method" => "action_supprimer",
        "protected" => true,
        "params" => [
            ["source" => "get", "name" => "matricule"]
        ]
    ],

    "modifierEmploye" => [
        "file" => "controleurs/employes/C_modifier.php",
        "class" => "C_modifierEmploye",
        "method" => [
            "get" => "action_afficher",
            "post" => "action_modifier"
        ],
        "protected" => true,
        "params" => []
    ],

    "listeServices" => [
        "file" => "controleurs/services/C_consulter.php",
        "class" => "C_consulterServices",
        "method" => "action_listeServices",
        "protected" => false,
        "params" => []
    ],

    "saisieService" => [
        "file" => "controleurs/services/C_ajouter.php",
        "class" => "C_ajouterService",
        "method" => "action_saisie",
        "protected" => true,
        "params" => []
    ],

    "ajoutService" => [
        "file" => "controleurs/services/C_ajouter.php",
        "class" => "C_ajouterService",
        "method" => "action_ajout",
        "protected" => true,
        "params" => [
            ["source" => "post", "name" => "designation"]
        ]
    ],

    "supprimerService" => [
        "file" => "controleurs/services/C_supprimer.php",
        "class" => "C_supprimerService",
        "method" => "action_supprimer",
        "protected" => true,
        "params" => [
            ["source" => "get", "name" => "code"]
        ]
    ],

    "modifierService" => [
        "file" => "controleurs/services/C_modifier.php",
        "class" => "C_modifierService",
        "method" => [
            "get" => "action_afficher",
            "post" => "action_modifier"
        ],
        "protected" => true,
        "params" => []
    ],

    "connexion" => [
        "file" => "controleurs/utilisateurs/C_connexion.php",
        "class" => "C_connexion",
        "method" => [
            "get" => "action_afficher",
            "post" => "action_connexion"
        ],
        "protected" => false,
        "params" => []
    ],

    "deconnexion" => [
        "file" => "controleurs/utilisateurs/C_deconnexion.php",
        "class" => "C_deconnexion",
        "method" => "action_deconnexion",
        "protected" => true,
        "params" => []
    ],

    "inscription" => [
        "file" => "controleurs/utilisateurs/C_inscription.php",
        "class" => "C_inscription",
        "method" => [
            "get" => "action_afficher",
            "post" => "action_inscrire"
        ],
        "protected" => false,
        "params" => []
    ],

    "profil" => [
        "file" => "controleurs/utilisateurs/C_profil.php",
        "class" => "C_profil",
        "method" => "action_afficher",
        "protected" => true,
        "params" => []
    ],

    "consulterComptes" => [
        "file" => "controleurs/utilisateurs/C_consulter.php",
        "class" => "C_consulter",
        "method" => "action_afficher",
        "protected" => true,
        "params" => []
    ]
];
