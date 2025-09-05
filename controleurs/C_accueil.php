<?php
require_once "C_menu.php";

class C_accueil
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
        require_once "vues/v_entete.php";
        require_once "vues/v_accueil.php";
        require_once "vues/v_piedPage.php";
    }
}
?>
