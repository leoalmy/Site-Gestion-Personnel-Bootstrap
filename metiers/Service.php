<?php
    class Service
    {
        private $sce_code;
        private $sce_designation;
        public function __construct($code, $designation)
            {
                $this->sce_code=$code;
                $this->sce_designation=$designation;
            }
        public function GetCode()
            {
                return $this->sce_code;
            }
        public function GetDesignation()
            {
                return $this->sce_designation;
            }
    }
?>