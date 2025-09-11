<?php
    require_once "C_base.php";

    class C_accueil extends C_base
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function action_afficher()
        {
            // Définir l'image avec 5% de chance de changer
            $rand = mt_rand(1, 100);
            $this->data['image_accueil'] =
                ($rand <= 5)
                    ? "./public/images/accueil_alt.jpg"
                    : "./public/images/accueil.jpg";

            // Inclure la vue
            require_once "vues/partiels/v_entete.php";
            require_once "vues/v_accueil.php";
            require_once "vues/partiels/v_piedPage.php";
        }
    }
?>