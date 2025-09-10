<?php
    require_once "controleurs/C_menu.php";
    require_once "metiers/Utilisateurs.php";

    class M_utilisateur extends M_generique
    {
        public function AjouterUtilisateur($nom, $prenom, $email, $mdp, $tel)
        {
            try {
                $this->connexion();
                $cnx = $this->GetCnx();

                if (!$cnx) {
                    throw new Exception("Erreur de connexion à la base : " . $cnx->connect_error);
                }

                // Vérifier si l'email existe déjà
                $check = $cnx->prepare("SELECT COUNT(*) as cnt FROM user WHERE email = ?");
                if (!$check) {
                    throw new Exception("Erreur prepare SELECT : " . $cnx->error);
                }
                $check->bind_param("s", $email);
                $check->execute();
                $check->bind_result($count);
                $check->fetch();
                $check->close();

                if ($count > 0) {
                    $this->deconnexion();
                    return false; // Email déjà utilisé
                }

                // Hacher le mot de passe
                $hashedMdp = password_hash($mdp, PASSWORD_BCRYPT);

                // Préparer l'INSERT
                $stmt = $cnx->prepare(
                    "INSERT INTO user (nom, prenom, email, mdp, telephone, dateInscription, role) 
                    VALUES (?, ?, ?, ?, ?, CURDATE(), 'membre')"
                );
                if (!$stmt) {
                    throw new Exception("Erreur prepare INSERT : " . $cnx->error);
                }

                // Si téléphone vide, mettre NULL
                $tel = !empty($tel) ? preg_replace('/[\s\-]/', '', $tel) : NULL;

                $stmt->bind_param("sssss", $nom, $prenom, $email, $hashedMdp, $tel);

                if (!$stmt->execute()) {
                    throw new Exception("Erreur execute INSERT : " . $stmt->error);
                }

                $stmt->close();
                $this->deconnexion();

                return true; // insertion réussie

            } catch (Exception $e) {
                $this->deconnexion();
                // Affiche l'erreur pour debug, tu peux aussi logger
                echo "Erreur : " . $e->getMessage();
                return false;
            }
        }

        public function ConnexionUtilisateur($email, $mdp) {
            $this->connexion();
            $cnx = $this->GetCnx();

            $stmt = $cnx->prepare("SELECT nom, prenom, email, mdp, telephone, dateInscription, role FROM user WHERE email = ?");
            if (!$stmt) {
                die("Erreur prepare SELECT : " . $cnx->error);
            }

            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $row = $result->fetch_assoc()) {
                if (password_verify($mdp, $row['mdp'])) {
                    $utilisateur = new Utilisateurs(
                        $row['nom'], 
                        $row['prenom'], 
                        $row['email'], 
                        $row['dateInscription'], 
                        $row['role'], 
                        $row['telephone']
                    );
                    $stmt->close();
                    $this->deconnexion();
                    return $utilisateur;
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