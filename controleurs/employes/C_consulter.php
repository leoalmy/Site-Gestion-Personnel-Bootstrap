<?php
    require_once "controleurs\C_menu.php";
    require_once "modeles/M_service.php";
    require_once "modeles/M_employe.php";
    class C_consulterEmployes
    {
        private $data;
        private $modele_employe;

        public function __construct()
        {
            $this->data=array();
            $this->controleurMenu=new C_menu();
            $this->modeleService=new M_service();
            $this->modeleEmploye=new M_employe(); 
        }

        public function action_listeEmployes($codeService)
        {
            if (!empty($_GET['msg']) && $_GET['msg'] == 'deleted') {
                $this->data['typeMessage'] = "success";
                $this->data['leMessage'] = "L'employé a été supprimé avec succès.";
            }
            elseif (!empty($_GET['msg']) && $_GET['msg'] == 'modified') {
                $this->data['typeMessage'] = "success";
                $this->data['leMessage'] = "L'employé a été modifié avec succès.";
            }
            elseif (!empty($_GET['msg']) && $_GET['msg'] == 'added') {
                $this->data['typeMessage'] = "success";
                $this->data['leMessage'] = "L'employé a été ajouté avec succès.";
            }

            $this->controleurMenu->FillData($this->data) ;
            $orderBy = $_GET['orderBy'] ?? 'emp_matricule';
            $direction = $_GET['direction'] ?? 'ASC';
            if ($codeService=="all")
            {
                $this->data['leService']=null;
                $this->data['lesEmployes']=$this->modeleEmploye->GetListe($orderBy, $direction);
            }
            else
            {
                $this->data['leService']=$this->modeleService->GetService($codeService);
                $this->data['lesEmployes' ]=$this->modeleEmploye
                    ->GetListeService($codeService, $orderBy, $direction);
            }

            require_once "vues/partiels/v_entete.php";
            if (isset($_GET['msg'])) {
                require_once "vues/partiels/v_message.php";
            }
            require_once "vues/employes/v_liste.php";
            require_once "vues/partiels/v_piedPage.php";
        }
    } 