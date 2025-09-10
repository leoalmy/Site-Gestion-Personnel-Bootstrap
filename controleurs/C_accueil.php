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

        // Définir l'image avec 5% de chance de changer
        $rand = mt_rand(1, 100); // nombre aléatoire entre 1 et 100
        if ($rand <= 5) { // 5% de chance
            $this->data['image_accueil'] = "./public/images/accueil_alt.jpg";
        } else {
            $this->data['image_accueil'] = "./public/images/accueil.jpg";
        }

        // Inclure la vue
        require_once "vues/partiels/v_entete.php";
        require_once "vues/v_accueil.php";
        require_once "vues/partiels/v_piedPage.php";
    }
}
?>
