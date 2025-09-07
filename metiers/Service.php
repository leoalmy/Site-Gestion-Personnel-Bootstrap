<?php
    class Service
    {
        private $sce_code;
        private $sce_designation;
        private $sce_nombreEmployes;

        public function __construct($code, $designation, $nombreEmployes = 0)
            {
                $this->sce_code=$code;
                $this->sce_designation=$designation;
                $this->sce_nombreEmployes=$nombreEmployes;
            }
        public function GetCode()
            {
                return $this->sce_code;
            }
        public function GetDesignation()
            {
                return $this->sce_designation;
            }
        public function GetNbEmployes()
            {
                return $this->sce_nombreEmployes;
            }
    }
?>