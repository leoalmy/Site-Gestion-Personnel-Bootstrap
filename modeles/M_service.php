<?php
require_once "M_generique.php";
require_once "metiers/Service.php";

class M_service extends M_generique
{
    public function GetListe($offset = 0, $rowsPerPage = 10, $orderBy = 'sce_code', $direction = 'ASC')
    {
        $resultat = [];
        $this->connexion();
        $cnx = $this->GetCnx();

        $offset = (int)$offset;
        $rowsPerPage = (int)$rowsPerPage;

        // Whitelist columns to prevent SQL injection
        $allowedColumns = ['sce_code', 'sce_designation', 'nb_employes'];
        if (!in_array($orderBy, $allowedColumns)) {
            $orderBy = 'sce_code';
        }

        $direction = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';

        $req = "SELECT s.sce_code, s.sce_designation, COUNT(e.emp_matricule) AS nb_employes
                FROM service s
                LEFT JOIN employe e ON s.sce_code = e.emp_service
                GROUP BY s.sce_code, s.sce_designation
                ORDER BY $orderBy $direction
                LIMIT $offset, $rowsPerPage";

        $res = mysqli_query($cnx, $req);

        while ($ligne = mysqli_fetch_assoc($res)) {
            $sce = new Service(
                $ligne["sce_code"],
                $ligne["sce_designation"],
                $ligne["nb_employes"]
            );
            $resultat[] = $sce;
        }

        $this->deconnexion();
        return $resultat;
    }

    public function GetService($code)
    {
        $resultat = null;
        $this->connexion();
        $cnx = $this->GetCnx();

        $stmt = mysqli_prepare($cnx, "SELECT * FROM service WHERE sce_code = ?");
        mysqli_stmt_bind_param($stmt, "s", $code);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        if ($ligne = mysqli_fetch_assoc($res)) {
            $resultat = new Service($ligne["sce_code"], $ligne["sce_designation"]);
        }

        mysqli_stmt_close($stmt);
        $this->deconnexion();
        return $resultat;
    }

    public function Ajouter($designation)
    {
        // 1) Generate new code first
        $code = $this->GenererCode();

        // 2) Open connection
        $this->connexion();
        $cnx = $this->GetCnx();

        // 3) Use prepared statement to insert
        $stmt = mysqli_prepare($cnx, "INSERT INTO service (sce_code, sce_designation) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $code, $designation);
        $ok = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        $this->deconnexion();

        // 4) Return the created object or null
        return $ok ? new Service($code, $designation) : null;
    }


    public function Modifier($code, $designation)
    {
        $this->connexion();
        $cnx = $this->GetCnx();

        $stmt = mysqli_prepare($cnx, "UPDATE service SET sce_designation = ? WHERE sce_code = ?");
        mysqli_stmt_bind_param($stmt, "ss", $designation, $code);
        $ok = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        $this->deconnexion();
        return $ok;
    }

    public function Supprimer($code)
    {
        $this->connexion();
        $cnx = $this->GetCnx();

        $stmt = mysqli_prepare($cnx, "DELETE FROM service WHERE sce_code = ?");
        mysqli_stmt_bind_param($stmt, "s", $code);
        $ok = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        $this->deconnexion();
        return $ok;
    }

    public function GenererCode()
    {
        $this->connexion();
        $cnx = $this->GetCnx();

        $req = "SELECT MAX(sce_code) AS max_code FROM service";
        $res = mysqli_query($cnx, $req);
        $ligne = mysqli_fetch_assoc($res);

        $this->deconnexion();

        if ($ligne && $ligne['max_code']) {
            $maxCode = $ligne['max_code'];
            $num = intval(substr($maxCode, 1)) + 1;
            return 's' . str_pad($num, 2, '0', STR_PAD_LEFT);
        } else {
            return 's01';
        }
    }

    public function CountServices()
    {
        $this->connexion();
        $cnx = $this->GetCnx();

        $res = mysqli_query($cnx, "SELECT COUNT(*) AS total FROM service");
        $count = 0;
        if ($ligne = mysqli_fetch_assoc($res)) {
            $count = (int)$ligne['total'];
        }

        $this->deconnexion();
        return $count;
    }
}
?>
