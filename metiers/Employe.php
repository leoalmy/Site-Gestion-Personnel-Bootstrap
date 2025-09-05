<?php
    class Employe
    {
        private $emp_matricule;
        private $emp_nom;
        private $emp_prenom;
        private $emp_service;
        private $service_name;

        public function __construct($matricule, $nom, $prenom, $service, $service_name = null)
        {
            $this->emp_matricule = $matricule;
            $this->emp_nom = $nom;
            $this->emp_prenom = $prenom;
            $this->emp_service = $service;
            $this->service_name = $service_name;
        }

        public function GetMatricule()
        {
            return $this->emp_matricule;
        }

        public function GetNom()
        {
            return $this->emp_nom; 
        }

        public function GetPrenom()
        {
            return $this->emp_prenom;
        }

        public function GetService()
        {
            return $this->emp_service;
        }

        public function GetServiceName()
        {
            return $this->service_name;
        }
    }
?>
