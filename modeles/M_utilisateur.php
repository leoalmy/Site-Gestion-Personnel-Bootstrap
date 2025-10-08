<?php
require_once "M_generique.php";
require_once "metiers/Utilisateurs.php";

class M_utilisateur extends M_generique
{
    public function AjouterUtilisateur($nom, $prenom, $email, $hashedMdp, $tel)
    {
        try {
            $this->connexion('auth');
            $cnx = $this->getCnx('auth');

            // Vérifier si l'email existe déjà
            $stmt = $cnx->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
            $stmt->execute(['email' => $email]);
            if ($stmt->fetchColumn() > 0) {
                $this->deconnexion();
                return false;
            }

            // Nettoyer le numéro de téléphone
            $tel = preg_replace('/[\s\-]/', '', $tel);

            // Insérer utilisateur (mot de passe déjà haché dans le controller)
            $stmt = $cnx->prepare("INSERT INTO user 
                (nom, prenom, email, mdp, telephone, dateInscription, role)
                VALUES (:nom, :prenom, :email, :mdp, :tel, CURDATE(), 'membre')");

            $ok = $stmt->execute([
                'nom'    => $nom,
                'prenom' => $prenom,
                'email'  => $email,
                'mdp'    => $hashedMdp,
                'tel'    => $tel
            ]);

            $this->deconnexion();
            return $ok;

        } catch (\Exception $e) {
            $this->deconnexion();
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function ConnexionUtilisateur($email, $mdp)
    {
        $this->connexion('auth');
        $cnx = $this->getCnx('auth');

        $stmt = $cnx->prepare("SELECT nom, prenom, email, mdp, telephone, dateInscription, role 
                            FROM user WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();

        $this->deconnexion();

        if ($row && password_verify($mdp, $row['mdp'])) {
            return new Utilisateurs(
                $row['nom'],
                $row['prenom'],
                $row['email'],
                $row['dateInscription'],
                $row['role'],
                $row['telephone']
            );
        }
        return false;
    }

    public function GetAllUtilisateurs()
    {
        try {
            $this->connexion('auth');
            $cnx = $this->getCnx('auth');

            $stmt = $cnx->prepare("SELECT nom, prenom, email, telephone, dateInscription, role 
                                FROM user ORDER BY role ASC");
            $stmt->execute();

            $users = [];
            while ($row = $stmt->fetch()) {
                $users[] = new Utilisateurs(
                    $row['nom'],
                    $row['prenom'],
                    $row['email'],
                    $row['dateInscription'],
                    $row['role'],
                    $row['telephone']
                );
            }

            $this->deconnexion();
            return $users;

        } catch (\Exception $e) {
            $this->deconnexion();
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }
}
