<?php
    require_once "controleurs\C_base.php";
    require_once "modeles/M_service.php";
    require_once "modeles/M_employe.php";
    
    class C_consulterEmployes extends C_base
    {
        private $modeleEmploye;
        private $modeleService;

        public function __construct()
        {
            parent::__construct();
            $this->modeleService=new M_service();
            $this->modeleEmploye=new M_employe(); 
        }

        public function action_listeEmployes($codeService)
        {
            $msg = $_GET['msg'] ?? null;
            // --- Messages ---
            if (!empty($msg)) {
                $this->data['typeMessage'] = "success";
                switch ($msg) {
                    case 'deleted':
                        $this->data['leMessage'] = "L'employé a été supprimé avec succès.";
                        break;
                    case 'modified':
                        $this->data['leMessage'] = "L'employé a été modifié avec succès.";
                        break;
                    case 'added':
                        $this->data['leMessage'] = "L'employé a été ajouté avec succès.";
                        break;
                }
            }

            // --- Sorting ---
            $validOrderBy = ['emp_matricule', 'emp_nom', 'emp_prenom', 'emp_service']; 
            $orderBy = in_array($_GET['orderBy'] ?? '', $validOrderBy) ? $_GET['orderBy'] : 'emp_matricule';

            $validDirection = ['ASC', 'DESC'];
            $direction = in_array(strtoupper($_GET['direction'] ?? ''), $validDirection) ? strtoupper($_GET['direction']) : 'ASC';

            // --- Pagination setup ---
            $rowsPerPage = 8; // change to how many rows per page
            $pageNum = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
            if ($pageNum < 1) $pageNum = 1;
            $offset = ($pageNum - 1) * $rowsPerPage;

            // --- Fetch employees ---
            if ($codeService == "all") {
                $this->data['leService'] = null;
                $totalRows = $this->modeleEmploye->CountEmployes(); // total rows for all services
                $this->data['lesEmployes'] = $this->modeleEmploye->GetListe($orderBy, $direction, $offset, $rowsPerPage);
            } else {
                $this->data['leService'] = $this->modeleService->GetService($codeService);
                $totalRows = $this->modeleEmploye->CountEmployesService($codeService);
                $this->data['lesEmployes'] = $this->modeleEmploye->GetListeService($codeService, $orderBy, $direction, $offset, $rowsPerPage);
            }

            // --- Pass pagination info to the view ---
            $this->data['currentPage'] = $pageNum;
            $this->data['totalPages'] = ceil($totalRows / $rowsPerPage);

            // --- Render views ---
            require_once "vues/partiels/v_entete.php";
            require_once "vues/employes/v_liste.php";
            require_once "vues/partiels/v_piedPage.php";
        }
    } 