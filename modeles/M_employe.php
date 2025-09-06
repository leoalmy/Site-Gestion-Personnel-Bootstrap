<?php
    require_once "M_generique.php";
    require_once "metiers/Employe.php";

    class M_employe extends M_generique
    {
        public function GetListe($orderBy = "emp_matricule", $direction = "ASC")
        {
            $resultat = array();
            $this->connexion();

            $allowedColumns = ["emp_matricule", "emp_nom", "emp_prenom", "emp_service"];
            if (!in_array($orderBy, $allowedColumns)) {
                $orderBy = "emp_matricule";
            }

            $direction = strtoupper($direction) === "DESC" ? "DESC" : "ASC";

            $req = "
                SELECT e.emp_matricule, e.emp_nom, e.emp_prenom, e.emp_service, s.sce_designation AS service_name
                FROM employe e
                LEFT JOIN service s ON e.emp_service = s.sce_code
                ORDER BY $orderBy $direction
            ";
            $res = mysqli_query($this->GetCnx(), $req);

            while ($ligne = mysqli_fetch_assoc($res)) {
                $employe = new Employe(
                    $ligne["emp_matricule"],
                    $ligne["emp_nom"],
                    $ligne["emp_prenom"],
                    $ligne["emp_service"],
                    $ligne["service_name"]
                );
                $resultat[] = $employe;
            }

            $this->deconnexion();
            return $resultat;
        }

        public function GetListeService($code, $orderBy = 'emp_matricule', $direction = 'ASC')
        {
            $resultat = array();
            $this->connexion();
            $cnx = $this->GetCnx();

            $code = mysqli_real_escape_string($cnx, $code);

            $allowedColumns = ['emp_matricule', 'emp_nom', 'emp_prenom', 'emp_service'];
            if (!in_array($orderBy, $allowedColumns)) {
                $orderBy = 'emp_matricule';
            }

            $direction = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';

            $req = "
                SELECT e.emp_matricule, e.emp_nom, e.emp_prenom, e.emp_service, s.sce_designation AS service_name
                FROM employe e
                LEFT JOIN service s ON e.emp_service = s.sce_code
                WHERE e.emp_service = '$code'
                ORDER BY $orderBy $direction
            ";
            $res = mysqli_query($cnx, $req);

            while ($ligne = mysqli_fetch_assoc($res)) {
                $employe = new Employe(
                    $ligne["emp_matricule"],
                    $ligne["emp_nom"],
                    $ligne["emp_prenom"],
                    $ligne["emp_service"],
                    $ligne["service_name"]
                );
                $resultat[] = $employe;
            }

            $this->deconnexion();
            return $resultat;
        }

        public function GetEmploye($matricule)
        {
            $this->connexion();
            $cnx = $this->GetCnx();

            $stmt = mysqli_prepare($cnx, "SELECT e.*, s.sce_designation AS service_name
                                          FROM employe e
                                          LEFT JOIN service s ON e.emp_service = s.sce_code
                                          WHERE e.emp_matricule = ?
                                          ");
            mysqli_stmt_bind_param($stmt, "s", $matricule);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);

            $resultat = null;
            if ($ligne = mysqli_fetch_assoc($res)) {
                $resultat = new Employe(
                    $ligne["emp_matricule"],
                    $ligne["emp_nom"],
                    $ligne["emp_prenom"],
                    $ligne["emp_service"],
                    $ligne["service_name"]
                );
            }

            mysqli_stmt_close($stmt);
            $this->deconnexion();
            return $resultat;
        }

        public function Ajouter($nom, $prenom, $service)
        {
            // 1) Generate matricule first (GenererMatricule opens/closes its own cnx)
            $matricule = $this->GenererMatricule();

            // 2) Open a fresh connection for the insert
            $this->connexion();
            $cnx = $this->GetCnx();

            // 3) Escape inputs
            $nom     = mysqli_real_escape_string($cnx, $nom);
            $prenom  = mysqli_real_escape_string($cnx, $prenom);
            $service = mysqli_real_escape_string($cnx, $service);

            // 4) Insert
            $req = "INSERT INTO employe (emp_matricule, emp_nom, emp_prenom, emp_service)
                    VALUES ('$matricule', '$nom', '$prenom', '$service')";
            $ok = mysqli_query($cnx, $req);

            // 5) Return the created object or null
            $employe = $ok ? new Employe($matricule, $nom, $prenom, $service) : null;

            $this->deconnexion();
            return $employe;
        }

        public function GenererMatricule() 
        {
            $this->connexion();

            // Get the last matricule
            $req = "SELECT MAX(emp_matricule) AS maxMat FROM employe";
            $res = mysqli_query($this->GetCnx(), $req);
            $ligne = mysqli_fetch_assoc($res);

            $this->deconnexion();

            // If no employee yet, start at 1
            $last = $ligne && $ligne['maxMat'] ? intval(substr($ligne['maxMat'], 1)) : 0;

            // Next matricule
            $next = $last + 1;

            // Format as e001, e002, etc.
            return "e" . str_pad($next, 3, "0", STR_PAD_LEFT);
        }

        public function Supprimer($matricule)
        {
            $this->connexion();

            // Sécurisation du matricule
            $matricule = mysqli_real_escape_string($this->GetCnx(), $matricule);

            // Requête SQL
            $req = "DELETE FROM employe WHERE emp_matricule = '$matricule'";
            $ok = mysqli_query($this->GetCnx(), $req);

            $this->deconnexion();
            return $ok;
        }

        public function Modifier($matricule, $nom, $prenom, $service)
        {
            $this->connexion();
            $cnx = $this->GetCnx();

            $matricule = mysqli_real_escape_string($cnx, $matricule);
            $nom       = mysqli_real_escape_string($cnx, $nom);
            $prenom    = mysqli_real_escape_string($cnx, $prenom);
            $service   = mysqli_real_escape_string($cnx, $service);

            $req = "UPDATE employe
                    SET emp_nom = '$nom', emp_prenom = '$prenom', emp_service = '$service'
                    WHERE emp_matricule = '$matricule'";

            $ok = mysqli_query($cnx, $req);
            $this->deconnexion();

            return $ok;
        }
    } 
?>