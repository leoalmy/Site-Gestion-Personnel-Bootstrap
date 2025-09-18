<?php
require_once "controleurs/C_base.php";
require_once "modeles/M_Utilisateur.php";

class C_connexion extends C_base
{
    private $modeleUtilisateur;

    public function __construct()
    {
        parent::__construct();
        $this->modeleUtilisateur = new M_utilisateur();
    }

    public function action_afficher()
    {
        // Inclure la vue
        require_once "vues/partiels/v_entete.php";
        require_once "vues/utilisateurs/v_connexion.php";
        require_once "vues/partiels/v_piedPage.php";
    }

    public function action_connexion()
    {
        $email = $_POST['login'];
        $password = $_POST['mdp'];

        $user = $this->modeleUtilisateur->ConnexionUtilisateur($email, $password);
        
        if ($user) {
            $_SESSION['user'] = $user;
            header("Location: index.php?page=profil");
        } else {
            $this->data['typeMessage'] = "error";
            $this->data['leMessage'] = "❌ Email ou mot de passe incorrect.";
            $this->action_afficher();
        }

        exit();
    }
}
?>
