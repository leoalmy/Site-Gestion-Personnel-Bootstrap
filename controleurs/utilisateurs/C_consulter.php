<?php
    require_once "controleurs/C_base.php";
    require_once "metiers/Utilisateurs.php";

    class C_consulter extends C_base
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function action_afficher()
        {
            if ($this->data['isLoggedOn'] && $this->getCurrentUserRole() == 'admin') {
                require_once "modeles/M_utilisateur.php";
                $m_user = new M_utilisateur();
                $users = $m_user->GetAllUtilisateurs();

                require_once "vues/partiels/v_entete.php";
                require "vues/utilisateurs/v_listeComptes.php"; // pass $users
                require_once "vues/partiels/v_piedPage.php";
            } else {
                header("Location: index.php?page=connexion");
                exit();
            }
        }
    }
?>