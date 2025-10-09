<?php
return [
    "accueil" => [
        "file" => "controleurs/C_accueil.php",
        "class" => "C_accueil",
        "method" => "action_afficher",
        "protected" => false,
        "role_required" => null,
        "params" => []
    ],

    "listeEmployes" => [
        "file" => "controleurs/employes/C_consulter.php",
        "class" => "C_consulterEmployes",
        "method" => "action_listeEmployes",
        "protected" => false,
        "role_required" => null,
        "params" => [
            ["source" => "get", "name" => "service"]
        ]
    ],

    "saisieEmploye" => [
        "file" => "controleurs/employes/C_ajouter.php",
        "class" => "C_ajouterEmploye",
        "method" => "action_saisie",
        "protected" => true,
        "role_required" => "ROLE_EDITOR",
        "params" => []
    ],

    "ajoutEmploye" => [
        "file" => "controleurs/employes/C_ajouter.php",
        "class" => "C_ajouterEmploye",
        "method" => "action_ajout",
        "protected" => true,
        "role_required" => "ROLE_EDITOR",
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
        "role_required" => "ROLE_ADMIN",
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
        "role_required" => "ROLE_EDITOR",
        "params" => []
    ],

    "listeServices" => [
        "file" => "controleurs/services/C_consulter.php",
        "class" => "C_consulterServices",
        "method" => "action_listeServices",
        "protected" => false,
        "role_required" => null,
        "params" => []
    ],

    "saisieService" => [
        "file" => "controleurs/services/C_ajouter.php",
        "class" => "C_ajouterService",
        "method" => "action_saisie",
        "protected" => true,
        "role_required" => "ROLE_EDITOR",
        "params" => []
    ],

    "ajoutService" => [
        "file" => "controleurs/services/C_ajouter.php",
        "class" => "C_ajouterService",
        "method" => "action_ajout",
        "protected" => true,
        "role_required" => "ROLE_EDITOR",
        "params" => [
            ["source" => "post", "name" => "designation"]
        ]
    ],

    "supprimerService" => [
        "file" => "controleurs/services/C_supprimer.php",
        "class" => "C_supprimerService",
        "method" => "action_supprimer",
        "protected" => true,
        "role_required" => "ROLE_ADMIN",
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
        "role_required" => "ROLE_EDITOR",
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
        "role_required" => null,
        "params" => []
    ],

    "deconnexion" => [
        "file" => "controleurs/utilisateurs/C_deconnexion.php",
        "class" => "C_deconnexion",
        "method" => "action_deconnexion",
        "protected" => true,
        "role_required" => "ROLE_MEMBRE",
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
        "role_required" => null,
        "params" => []
    ],

    "profil" => [
        "file" => "controleurs/utilisateurs/C_profil.php",
        "class" => "C_profil",
        "method" => "action_afficher",
        "protected" => true,
        "role_required" => "ROLE_MEMBRE",
        "params" => []
    ],

    "consulterComptes" => [
        "file" => "controleurs/utilisateurs/C_consulter.php",
        "class" => "C_consulter",
        "method" => "action_afficher",
        "protected" => true,
        "role_required" => "ROLE_ADMIN",
        "params" => []
    ]
];
