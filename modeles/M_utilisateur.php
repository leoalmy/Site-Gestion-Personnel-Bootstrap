<?php
require_once "M_generique.php";
require_once "metiers/Utilisateurs.php";

class M_utilisateur extends M_generique
{
    public function AjouterUtilisateur($nom, $prenom, $email, $mdp, $tel)
    {
        try {
            $this->connexion();
            $cnx = $this->GetCnx();

            // Vérifier si l'email existe déjà
            $stmt = $cnx->prepare("SELECT COUNT(*) as cnt FROM user WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $count = (int)$stmt->fetchColumn();

            if ($count > 0) {
                $this->deconnexion();
                return false;
            }

            // Hacher le mot de passe
            $hashedMdp = password_hash($mdp, PASSWORD_BCRYPT);

            // Nettoyer le numéro de téléphone
            $tel = preg_replace('/[\s\-]/', '', $tel);

            // Insérer utilisateur
            $stmt = $cnx->prepare("INSERT INTO user 
                (nom, prenom, email, mdp, telephone, dateInscription, role)
                VALUES (:nom, :prenom, :email, :mdp, :tel, CURDATE(), 'membre')");

            $ok = $stmt->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'mdp' => $hashedMdp,
                'tel' => $tel
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
        $this->connexion();
        $cnx = $this->GetCnx();

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
}
