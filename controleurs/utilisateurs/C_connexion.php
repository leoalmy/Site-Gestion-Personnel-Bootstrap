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
        require_once "vues/utilisateurs/v_connexion.php";
        require_once "vues/partiels/v_piedPage.php";
    }

    public function action_connexion()
    {
        $email = $_POST['login'];
        $password = $_POST['mdp'];

        $user = $this->modeleUtilisateur->ConnexionUtilisateur($email, $password);
        
        if ($user) {
            echo "✅ Bienvenue " . $user->GetEmail();
            // Ici tu pourrais démarrer une session : $_SESSION['user'] = $user;
            // header("Location: index.php?page=profil");
        } else {
            echo "❌ Email ou mot de passe incorrect";
        }

        // à faire : vérifier les informations d'identification
        $this->controleurMenu->FillData($this->data);

        
        exit();
    }
}
?>
