<?php
require_once "controleurs/C_base.php";
require_once "modeles/M_utilisateur.php";

class C_inscription extends C_base
{
    private $modeleUtilisateur;

    public function __construct()
    {
        parent::__construct();
        $this->modeleUtilisateur = new M_utilisateur();
    }

    public function action_afficher()
    {
        require_once "vues/partiels/v_entete.php";
        require_once "vues/utilisateurs/v_inscription.php";
        require_once "vues/partiels/v_piedPage.php";
    }

    public function action_inscrire()
    {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['mdp'];
        $confirmpassword = $_POST['mdpConf'];
        $tel = htmlspecialchars($_POST['tel']);

        // Vérifier la correspondance des mots de passe
        if ($password !== $confirmpassword) {
            $this->afficherErreur("❌ Les mots de passe ne correspondent pas.");
            return;
        }

        // Vérifier la force du mot de passe
        $errors = $this->validatePassword($password);
        if (!empty($errors)) {
            $this->afficherErreur($errors);
            return;
        }

        // Hacher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);

        // Insérer utilisateur
        $success = $this->modeleUtilisateur->AjouterUtilisateur(
            $nom, $prenom, $email, $hashedPassword, $tel
        );

        if ($success) {
            header("Location: index.php?page=connexion");
            exit();
        } else {
            $this->afficherErreur("❌ L'email est déjà utilisé.");
        }
    }

    private function validatePassword(string $password): array
    {
        $errors = [];
        if (strlen($password) < 12) {
            $errors[] = "Le mot de passe doit contenir au moins 12 caractères.";
        }
        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = "Le mot de passe doit contenir au moins une lettre minuscule.";
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "Le mot de passe doit contenir au moins une lettre majuscule.";
        }
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = "Le mot de passe doit contenir au moins un chiffre.";
        }
        if (!preg_match('/[^A-Za-z0-9]/', $password)) {
            $errors[] = "Le mot de passe doit contenir au moins un caractère spécial.";
        }
        return $errors;
    }
}
