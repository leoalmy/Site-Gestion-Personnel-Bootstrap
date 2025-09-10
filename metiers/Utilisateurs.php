<?php
    class Utilisateurs
    {
        private $uti_nom;
        private $uti_pnom;
        private $uti_email;
        private $uti_dateInscription;
        private $uti_role;
        private $uti_tel;

        public function __construct($nom, $pnom, $email, $dateInscription, $role, $tel)
        {
            $this->uti_nom = $nom;
            $this->uti_pnom = $pnom;
            $this->uti_email = $email;
            $this->uti_dateInscription = $dateInscription;
            $this->uti_role = $role;
            $this->uti_tel = $tel;
        }

        public function GetNom()
        {
            return $this->uti_nom;
        }

        public function GetPrenom()
        {
            return $this->uti_pnom;
        }

        public function GetEmail()
        {
            return $this->uti_email;
        }

        public function GetDateInscription()
        {
            return $this->uti_dateInscription;
        }

        public function GetRole()
        {
            return $this->uti_role;
        }

        public function GetTel()
        {
            return $this->uti_tel;
        }

        public function GetTelFormate()
        {
            if (empty($this->uti_tel)) return "";

            // Supprimer tout sauf les chiffres
            $tel = preg_replace('/\D/', '', $this->uti_tel);

            // Si le numéro commence par '33', on ajoute le +33
            if (substr($tel, 0, 2) === "33") {
                $tel = '+' . substr($tel, 0, 2) . substr($tel, 2);
            } else if (substr($tel, 0, 1) === "0") {
                // Sinon on garde le 0 initial
                $tel = '0' . substr($tel, 1);
            }

            // Retirer le préfixe pour le formater en blocs de 2 chiffres
            if (substr($tel, 0, 3) === '+33') {
                $bloc = substr($tel, 3); // tout après +33
                $bloc_formate = implode(' ', str_split($bloc, 2));
                return '+33 ' . $bloc_formate;
            } else {
                return implode(' ', str_split($tel, 2));
            }
        }

        public function GetDateInscriptionFormatee()
        {
            $date = new DateTime($this->uti_dateInscription);
            return $date->format('d/m/Y'); // 10/09/2025
        }

    }
?>