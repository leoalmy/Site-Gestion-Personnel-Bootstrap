<?php
    require_once "M_generique.php";
    require_once "metiers/Service.php";

    class M_service extends M_generique
    {
        public function GetListe()
        {
            $resultat=array();
            $this->Connexion();
            $req="select * from service";
            $res=mysqli_query($this->GetCnx(), $req) ;
            $ligne=mysqli_fetch_assoc($res);
            while ($ligne)
            {
                $sce=new Service($ligne["sce_code"],$ligne["sce_designation"]);
                $resultat[]=$sce;
                $ligne=mysqli_fetch_assoc($res);
            }
            $this->Deconnexion();
            return $resultat; 
        }

        public function GetService($code)
        {
            $resultat = null;

            // Connexion à la base
            $this->connexion();

            // Requête SQL sécurisée
            $req = "SELECT * FROM service WHERE sce_code = '$code'";
            $res = mysqli_query($this->GetCnx(), $req);

            // Récupération de la ligne
            $ligne = mysqli_fetch_assoc($res);
            if ($ligne) {
                $service = new Service($ligne["sce_code"], $ligne["sce_designation"]);
                $resultat = $service;
            }

            // Déconnexion
            $this->deconnexion();

            return $resultat;
        }
    }
?>