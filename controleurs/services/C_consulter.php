<?php
require_once "controleurs/C_base.php";
require_once "modeles/M_service.php";

class C_consulterServices extends C_base
{
    private $modeleService;

    public function __construct()
    {
        parent::__construct();
        $this->modeleService = new M_service();
    }

    public function action_listeServices()
    {
        // Gestion des messages flash
        if (!empty($_GET['msg'])) {
            switch ($_GET['msg']) {
                case 'deleted':
                    $this->data['typeMessage'] = "success";
                    $this->data['leMessage']   = "Le service a été supprimé avec succès.";
                    break;
                case 'modified':
                    $this->data['typeMessage'] = "success";
                    $this->data['leMessage']   = "Le service a été modifié avec succès.";
                    break;
                case 'added':
                    $this->data['typeMessage'] = "success";
                    $this->data['leMessage']   = "Le service a été ajouté avec succès.";
                    break;
            }
        }

        // 🔹 Pagination
        $pageNum     = isset($_GET['pageNum']) ? max(1, (int)$_GET['pageNum']) : 1;
        $rowsPerPage = 8;
        $offset      = ($pageNum - 1) * $rowsPerPage;

        // 🔹 Tri par colonne
        $validColumns = ["sce_code", "sce_designation", "nb_employes"];
        $orderBy      = $_GET['orderBy'] ?? "sce_code";
        $direction    = strtoupper($_GET['direction'] ?? "ASC");

        if (!in_array($orderBy, $validColumns)) {
            $orderBy = "sce_code";
        }
        if (!in_array($direction, ["ASC", "DESC"])) {
            $direction = "ASC";
        }

        // 🔹 Récupération des données
        $totalServices = $this->modeleService->CountServices();
        $lesServices   = $this->modeleService->GetListe($offset, $rowsPerPage, $orderBy, $direction);

        // 🔹 Passage à la vue
        $this->data['lesServices']   = $lesServices;
        $this->data['totalServices'] = $totalServices;
        $this->data['pageNum']       = $pageNum;
        $this->data['rowsPerPage']   = $rowsPerPage;
        $this->data['totalPages']    = ceil($totalServices / $rowsPerPage);
        $this->data['orderBy']       = $orderBy;
        $this->data['direction']     = $direction;

        require_once "vues/partiels/v_entete.php";
        require_once "vues/services/v_liste.php";
        require_once "vues/partiels/v_modalConfirm.php";
        require_once "vues/partiels/v_piedPage.php";
    }
}
