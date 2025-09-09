<?php
    class Utilisateurs
    {
        private $uti_email;

        public function __construct($email)
            {
                $this->uti_email = $email;
            }

        public function GetEmail()
            {
                return $this->uti_email;
            }
    }