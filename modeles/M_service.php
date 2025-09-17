<?php
require_once "M_generique.php";
require_once "metiers/Service.php";

class M_service extends M_generique
{
    public function GetListe($offset = 0, $rowsPerPage = 10, $orderBy = 'sce_code', $direction = 'ASC')
    {
        $this->connexion('data');
        $cnx = $this->getCnx('data');

        $allowedColumns = ['sce_code', 'sce_designation', 'nb_employes'];
        if (!in_array($orderBy, $allowedColumns)) {
            $orderBy = 'sce_code';
        }
        $direction = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';

        $sql = "SELECT s.sce_code, s.sce_designation, COUNT(e.emp_matricule) AS nb_employes
                FROM service s
                LEFT JOIN employe e ON s.sce_code = e.emp_service
                GROUP BY s.sce_code, s.sce_designation
                ORDER BY $orderBy $direction
                LIMIT :offset, :rows";

        $stmt = $cnx->prepare($sql);
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->bindValue(':rows', (int)$rowsPerPage, \PDO::PARAM_INT);
        $stmt->execute();

        $resultat = [];
        while ($ligne = $stmt->fetch()) {
            $resultat[] = new Service($ligne["sce_code"], $ligne["sce_designation"], $ligne["nb_employes"]);
        }

        $this->deconnexion();
        return $resultat;
    }

    public function GetService($code)
    {
        $this->connexion('data');
        $cnx = $this->getCnx('data');

        $stmt = $cnx->prepare("SELECT * FROM service WHERE sce_code = :code");
        $stmt->execute(['code' => $code]);
        $ligne = $stmt->fetch();

        $this->deconnexion();
        return $ligne ? new Service($ligne["sce_code"], $ligne["sce_designation"]) : null;
    }

    public function Ajouter($designation)
    {
        $code = $this->GenererCode();
        $this->connexion('data');
        $cnx = $this->getCnx('data');

        $stmt = $cnx->prepare("INSERT INTO service (sce_code, sce_designation) VALUES (:code, :designation)");
        $ok = $stmt->execute(['code' => $code, 'designation' => $designation]);

        $this->deconnexion();
        return $ok ? new Service($code, $designation) : null;
    }

    public function Modifier($code, $designation)
    {
        $this->connexion('data');
        $cnx = $this->getCnx('data');

        $stmt = $cnx->prepare("UPDATE service SET sce_designation = :designation WHERE sce_code = :code");
        $ok = $stmt->execute(['designation' => $designation, 'code' => $code]);

        $this->deconnexion();
        return $ok;
    }

    public function Supprimer($code)
    {
        $this->connexion('data');
        $cnx = $this->getCnx('data');

        $stmt = $cnx->prepare("DELETE FROM service WHERE sce_code = :code");
        $ok = $stmt->execute(['code' => $code]);

        $this->deconnexion();
        return $ok;
    }

    public function GenererCode()
    {
        $this->connexion('data');
        $cnx = $this->getCnx('data');

        $res = $cnx->query("SELECT MAX(sce_code) AS max_code FROM service");
        $ligne = $res->fetch();

        $this->deconnexion();

        if ($ligne && $ligne['max_code']) {
            $num = intval(substr($ligne['max_code'], 1)) + 1;
            return 's' . str_pad($num, 2, '0', STR_PAD_LEFT);
        } else {
            return 's01';
        }
    }

    public function CountServices()
    {
        $this->connexion('data');
        $cnx = $this->getCnx('data');

        $res = $cnx->query("SELECT COUNT(*) AS total FROM service");
        $ligne = $res->fetch();

        $this->deconnexion();
        return $ligne ? (int)$ligne['total'] : 0;
    }
}
