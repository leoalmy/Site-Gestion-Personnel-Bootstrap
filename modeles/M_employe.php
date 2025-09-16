<?php
require_once "M_generique.php";
require_once "metiers/Employe.php";

class M_employe extends M_generique
{
    public function GetListe($orderBy = "emp_matricule", $direction = "ASC", $offset = 0, $rowsPerPage = 10)
    {
        $this->connexion();
        $cnx = $this->GetCnx();

        $allowedColumns = ["emp_matricule", "emp_nom", "emp_prenom", "emp_service"];
        if (!in_array($orderBy, $allowedColumns)) {
            $orderBy = "emp_matricule";
        }
        $direction = strtoupper($direction) === "DESC" ? "DESC" : "ASC";

        $sql = "SELECT e.emp_matricule, e.emp_nom, e.emp_prenom, e.emp_service, 
                       s.sce_designation AS service_name
                FROM employe e
                LEFT JOIN service s ON e.emp_service = s.sce_code
                ORDER BY $orderBy $direction
                LIMIT :offset, :rows";

        $stmt = $cnx->prepare($sql);
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->bindValue(':rows', (int)$rowsPerPage, \PDO::PARAM_INT);
        $stmt->execute();

        $resultat = [];
        while ($ligne = $stmt->fetch()) {
            $resultat[] = new Employe(
                $ligne["emp_matricule"],
                $ligne["emp_nom"],
                $ligne["emp_prenom"],
                $ligne["emp_service"],
                $ligne["service_name"]
            );
        }

        $this->deconnexion();
        return $resultat;
    }

    public function GetListeService($code, $orderBy = 'emp_matricule', $direction = 'ASC', $offset = 0, $rowsPerPage = 10)
    {
        $this->connexion();
        $cnx = $this->GetCnx();

        $allowedColumns = ["emp_matricule", "emp_nom", "emp_prenom", "emp_service"];
        if (!in_array($orderBy, $allowedColumns)) {
            $orderBy = "emp_matricule";
        }
        $direction = strtoupper($direction) === "DESC" ? "DESC" : "ASC";

        $sql = "SELECT e.emp_matricule, e.emp_nom, e.emp_prenom, e.emp_service, 
                       s.sce_designation AS service_name
                FROM employe e
                LEFT JOIN service s ON e.emp_service = s.sce_code
                WHERE e.emp_service = :code
                ORDER BY $orderBy $direction
                LIMIT :offset, :rows";

        $stmt = $cnx->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->bindValue(':rows', (int)$rowsPerPage, \PDO::PARAM_INT);
        $stmt->execute();

        $resultat = [];
        while ($ligne = $stmt->fetch()) {
            $resultat[] = new Employe(
                $ligne["emp_matricule"],
                $ligne["emp_nom"],
                $ligne["emp_prenom"],
                $ligne["emp_service"],
                $ligne["service_name"]
            );
        }

        $this->deconnexion();
        return $resultat;
    }

    public function GetEmploye($matricule)
    {
        $this->connexion();
        $cnx = $this->GetCnx();

        $sql = "SELECT e.*, s.sce_designation AS service_name
                FROM employe e
                LEFT JOIN service s ON e.emp_service = s.sce_code
                WHERE e.emp_matricule = :matricule";

        $stmt = $cnx->prepare($sql);
        $stmt->execute(['matricule' => $matricule]);
        $ligne = $stmt->fetch();

        $this->deconnexion();
        return $ligne ? new Employe(
            $ligne["emp_matricule"],
            $ligne["emp_nom"],
            $ligne["emp_prenom"],
            $ligne["emp_service"],
            $ligne["service_name"]
        ) : null;
    }

    public function Ajouter($nom, $prenom, $service)
    {
        $matricule = $this->GenererMatricule();
        $this->connexion();
        $cnx = $this->GetCnx();

        $sql = "INSERT INTO employe (emp_matricule, emp_nom, emp_prenom, emp_service)
                VALUES (:matricule, :nom, :prenom, :service)";
        $stmt = $cnx->prepare($sql);
        $ok = $stmt->execute([
            'matricule' => $matricule,
            'nom' => $nom,
            'prenom' => $prenom,
            'service' => $service
        ]);

        $this->deconnexion();
        return $ok ? new Employe($matricule, $nom, $prenom, $service) : null;
    }

    public function GenererMatricule()
    {
        $this->connexion();
        $cnx = $this->GetCnx();

        $res = $cnx->query("SELECT MAX(emp_matricule) AS maxMat FROM employe");
        $ligne = $res->fetch();

        $this->deconnexion();

        $last = $ligne && $ligne['maxMat'] ? intval(substr($ligne['maxMat'], 1)) : 0;
        $next = $last + 1;
        return "e" . str_pad($next, 3, "0", STR_PAD_LEFT);
    }

    public function Supprimer($matricule)
    {
        $this->connexion();
        $cnx = $this->GetCnx();

        $stmt = $cnx->prepare("DELETE FROM employe WHERE emp_matricule = :matricule");
        $ok = $stmt->execute(['matricule' => $matricule]);

        $this->deconnexion();
        return $ok;
    }

    public function Modifier($matricule, $nom, $prenom, $service)
    {
        $this->connexion();
        $cnx = $this->GetCnx();

        $stmt = $cnx->prepare("UPDATE employe 
                               SET emp_nom = :nom, emp_prenom = :prenom, emp_service = :service
                               WHERE emp_matricule = :matricule");
        $ok = $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'service' => $service,
            'matricule' => $matricule
        ]);

        $this->deconnexion();
        return $ok;
    }

    public function CountEmployes()
    {
        $this->connexion();
        $cnx = $this->GetCnx();

        $res = $cnx->query("SELECT COUNT(*) AS total FROM employe");
        $ligne = $res->fetch();

        $this->deconnexion();
        return $ligne ? (int)$ligne['total'] : 0;
    }

    public function CountEmployesService($codeService)
    {
        $this->connexion();
        $cnx = $this->GetCnx();

        $stmt = $cnx->prepare("SELECT COUNT(*) AS total FROM employe WHERE emp_service = :service");
        $stmt->execute(['service' => $codeService]);
        $ligne = $stmt->fetch();

        $this->deconnexion();
        return $ligne ? (int)$ligne['total'] : 0;
    }
}
