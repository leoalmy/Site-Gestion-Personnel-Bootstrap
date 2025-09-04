<?php
    class M_generique
    {
        private $cnx;
        public function GetCnx() 
        {
            return $this->cnx;
        }
        public function Connexion() 
        {
            $this->cnx=mysqli_connect("127.0.0.1","root","","empsce");
            mysqli_set_charset($this->cnx, "utf8"); 
        }
        public function Deconnexion() 
        {
            mysqli_close($this->cnx);
        }
    }
?>