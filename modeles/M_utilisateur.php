<?php
    require_once "controleurs/C_menu.php";
    require_once "metiers/Utilisateurs.php";

    class M_utilisateur extends M_generique
    {
        public function AjouterUtilisateur($email, $mdp)
        {
            $this->connexion();
            $cnx = $this->GetCnx();

            // Vérifier si l'email existe déjà
            $check = $cnx->prepare("SELECT email FROM user WHERE email = ?");
            if (!$check) {
                die("Erreur prepare SELECT : " . $cnx->error);
            }
            $check->bind_param("s", $email);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                $check->close();
                $this->deconnexion();
                return false; // Email déjà utilisé
            }
            $check->close();

            // Hacher le mot de passe avec bcrypt
            $hashedMdp = password_hash($mdp, PASSWORD_BCRYPT);

            // Préparer la requête d'insertion
            $stmt = $cnx->prepare("INSERT INTO user (email, mdp) VALUES (?, ?)");
            if (!$stmt) {
                die("Erreur prepare INSERT : " . $cnx->error);
            }
            $stmt->bind_param("ss", $email, $hashedMdp);

            $res = $stmt->execute();

            $stmt->close();
            $this->deconnexion();

            return $res; // true si insertion OK, false sinon
        }

        public function ConnexionUtilisateur($email, $mdp) {
            $this->connexion();
            $cnx = $this->GetCnx();

            // Préparer la requête pour chercher l'utilisateur
            $stmt = $cnx->prepare("SELECT email, mdp FROM user WHERE email = ?");
            if (!$stmt) {
                die("Erreur prepare SELECT : " . $cnx->error);
            }

            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $row = $result->fetch_assoc()) {
                // Vérifier le mot de passe hashé
                if (password_verify($mdp, $row['mdp'])) {
                    $utilisateur = new Utilisateurs($row['email']);
                    $stmt->close();
                    $this->deconnexion();
                    return $utilisateur; // Succès
                } else {
                    $stmt->close();
                    $this->deconnexion();
                    return false; // Mot de passe incorrect
                }
            } else {
                $stmt->close();
                $this->deconnexion();
                return false; // Email non trouvé
            }
        }

    }
?>