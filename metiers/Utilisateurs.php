<?php
    class Utilisateurs
    {
        private $uti_email;
        private $uti_dateInscription;
        private $uti_role;

        public function __construct($email, $dateInscription, $role)
            {
                $this->uti_email = $email;
                $this->uti_dateInscription = $dateInscription;
                $this->uti_role = $role;
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
                return $uti_role;
            }
    }