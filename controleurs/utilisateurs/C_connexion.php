<?php
require_once "controleurs/C_menu.php";
require_once "modeles/M_utilisateur.php";

class C_connexion
{
    private $data;
    private $controleurMenu;
    private $modeleUtilisateur;

    public function __construct()
    {
        $this->data = array();
        $this->controleurMenu = new C_menu();
        $this->modeleUtilisateur = new M_utilisateur();
    }

    public function action_afficher()
    {
        // Remplir les données via le menu
        $this->controleurMenu->FillData($this->data);

        // Inclure la vue
        require_once "vues/partiels/v_entete.php";
        if (isset($this->data['typeMessage']) && isset($this->data['leMessage'])) {
            require_once "vues/partiels/v_message.php";
        }
        require_once "vues/utilisateurs/v_connexion.php";
        require_once "vues/partiels/v_piedPage.php";
    }

    public function action_connexion()
    {
        $email = $_POST['login'];
        $password = $_POST['mdp'];

        $user = $this->modeleUtilisateur->ConnexionUtilisateur($email, $password);
        
        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            header("Location: index.php?page=profil");
        } else {
            $this->data['typeMessage'] = "error";
            $this->data['leMessage'] = "❌ Email ou mot de passe incorrect.";
            $this->action_afficher();
        }

        $this->controleurMenu->FillData($this->data);

        exit();
    }
}
?>
