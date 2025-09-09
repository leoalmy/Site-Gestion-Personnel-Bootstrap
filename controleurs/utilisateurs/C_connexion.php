<?php
require_once "controleurs/C_menu.php";

class C_connexion
{
    private $data;
    private $controleurMenu;

    public function __construct()
    {
        $this->data = array();
        $this->controleurMenu = new C_menu();
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

    public function action_connexion($email, $password)
    {
        // à faire : vérifier les informations d'identification
        $this->controleurMenu->FillData($this->data);

        // Pour l'instant, rediriger vers la page d'accueil après "connexion"
        header("Location: index.php?page=accueil");
        exit();
    }
}
?>
