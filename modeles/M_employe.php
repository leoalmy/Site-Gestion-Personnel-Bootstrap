<?php
    require_once "M_generique.php";
    require_once "metiers/Employe.php";

    class M_employe extends M_generique
    {
        public function GetListe()
        {
            $resultat = array();
            $this->connexion();

            $req = "SELECT * FROM employe";
            $res = mysqli_query($this->GetCnx(), $req);

            $ligne = mysqli_fetch_assoc($res);
            while ($ligne) {
                $employe = new Employe(
                    $ligne["emp_matricule"],
                    $ligne["emp_nom"],
                    $ligne["emp_prenom"],
                    $ligne["emp_service"]
                );
                $resultat[] = $employe;
                $ligne = mysqli_fetch_assoc($res);
            }

            $this->deconnexion();
            return $resultat;
        }

        public function GetListeService($code)
        {
            $resultat = array();
            $this->connexion();

            // Requête SQL sécurisée
            $req = "SELECT * FROM employe WHERE emp_service = '$code'";
            $res = mysqli_query($this->GetCnx(), $req);

            $ligne = mysqli_fetch_assoc($res);
            while ($ligne) {
                $employe = new Employe(
                    $ligne["emp_matricule"],
                    $ligne["emp_nom"],
                    $ligne["emp_prenom"],
                    $ligne["emp_service"]
                );
                $resultat[] = $employe;
                $ligne = mysqli_fetch_assoc($res);
            }

            $this->deconnexion();
            return $resultat;
        }

        public function GetEmploye($matricule)
        {
            $this->connexion();

            // Sécurisation du matricule
            $matricule = mysqli_real_escape_string($this->GetCnx(), $matricule);

            // Requête SQL
            $req = "SELECT * FROM employe WHERE emp_matricule = '$matricule'";
            $res = mysqli_query($this->GetCnx(), $req);

            $resultat = null;
            if ($ligne = mysqli_fetch_assoc($res)) {
                $resultat = new Employe(
                    $ligne["emp_matricule"],
                    $ligne["emp_nom"],
                    $ligne["emp_prenom"],
                    $ligne["emp_service"]
                );
            }

            $this->deconnexion();
            return $resultat;
        }

        public function Ajouter($matricule, $nom, $prenom, $service)
        {
            $this->connexion();

            // Sécurisation des entrées
            $matricule = mysqli_real_escape_string($this->GetCnx(), $matricule);
            $nom       = mysqli_real_escape_string($this->GetCnx(), $nom);
            $prenom    = mysqli_real_escape_string($this->GetCnx(), $prenom);
            $service   = mysqli_real_escape_string($this->GetCnx(), $service);

            // Création de l'objet Employe
            $employe = new Employe($matricule, $nom, $prenom, $service);

            // Requête SQL
            $req = "INSERT INTO employe (emp_matricule, emp_nom, emp_prenom, emp_service)
                    VALUES ('$matricule', '$nom', '$prenom', '$service')";

            $ok = mysqli_query($this->GetCnx(), $req);

            if (!$ok) {
                $employe = null; // insertion échouée
            }

            $this->deconnexion();
            return $employe;
        }
    } 
?>