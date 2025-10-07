<div class="container my-4">
    <!-- Page title -->
    <h2>
        <?php
            // Show label, use code in links
            $currentServiceCode  = "all";
            $currentServiceLabel = "Tous les services";

            if (!empty($this->data['leService'])) {
                // assuming your service entity exposes GetCode() + GetDesignation()
                $currentServiceCode  = $this->data['leService']->GetCode();
                $currentServiceLabel = $this->data['leService']->GetDesignation();
            }

            echo htmlspecialchars(
                $currentServiceLabel === "Tous les services"
                ? $currentServiceLabel
                : "Service: " . $currentServiceLabel
            );
        ?>
    </h2>

    <!-- Search bar -->
    <div class="d-flex mb-3">
        <input type="text" id="searchInput" class="form-control me-2" placeholder="Rechercher un employé...">
        <button id="clearSearch" class="btn btn-secondary d-none">✕</button>
    </div>

    <!-- Employee table -->
    <table class="table table-striped table-bordered" id="employeTable">
        <thead class="table-dark">
            <tr>
                <?php
                    $columns = [
                        'emp_matricule' => 'Matricule',
                        'emp_nom'       => 'Nom',
                        'emp_prenom'    => 'Prénom',
                        'emp_service'   => 'Service'
                    ];
                ?>
                <?php foreach ($columns as $colKey => $colLabel): ?>
                    <th scope="col">
                        <a href="index.php?page=listeEmployes&service=<?= urlencode($currentServiceCode) ?>&orderBy=<?= $colKey ?>&direction=<?= ($orderBy === $colKey && $direction === 'ASC') ? 'DESC' : 'ASC'; ?>&page_num=<?= $this->data['currentPage'] ?>"
                           class="text-light">
                            <?= $colLabel ?>
                            <?php if ($orderBy === $colKey): ?>
                                <i class="bi bi-caret-<?= ($direction === 'ASC') ? 'up' : 'down'; ?>-fill"></i>
                            <?php endif; ?>
                        </a>
                    </th>
                <?php endforeach; ?>
                <?php if ($this->data['isLoggedOn']): ?>
                    <th scope="col">Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->data['lesEmployes'] as $unEmploye): ?>
                <?php
                    // Service button color
                    switch ($unEmploye->GetService()) {
                        case 's01': $btnClass = 'btn-primary'; break;
                        case 's02': $btnClass = 'btn-warning'; break;
                        case 's03': $btnClass = 'btn-success'; break;
                        case 's04': $btnClass = 'btn-danger';  break;
                        default:    $btnClass = 'btn-dark';    break;
                    }
                ?>
                <tr>
                    <td><?= htmlspecialchars($unEmploye->GetMatricule()) ?></td>
                    <td><?= htmlspecialchars($unEmploye->GetNom()) ?></td>
                    <td><?= htmlspecialchars($unEmploye->GetPrenom()) ?></td>
                    <td>
                        <a href="index.php?page=listeEmployes&service=<?= htmlspecialchars($unEmploye->GetService()) ?>" 
                           class="btn btn-sm <?= $btnClass ?>">
                           <?= htmlspecialchars($unEmploye->GetServiceName()) ?>
                        </a>
                        (<?= htmlspecialchars($unEmploye->GetService()) ?>)
                    </td>
                    <?php if ($this->data['isLoggedOn']): ?>
                        <td>
                            <a href="index.php?page=modifierEmploye&matricule=<?= htmlspecialchars($unEmploye->GetMatricule()) ?>" 
                               class="btn btn-info btn-sm me-2" data-bs-title="Modifier cet employé">
                               <i class="bi bi-pencil"></i>
                            </a>
                            <a href="#" 
                               class="btn btn-danger btn-sm" 
                               data-bs-toggle="modal" 
                               data-bs-target="#deleteEmployeeModal" 
                               data-href="index.php?page=supprimerEmploye&matricule=<?= $unEmploye->GetMatricule() ?>" 
                               data-body="Voulez-vous vraiment supprimer l'employé « <?= htmlspecialchars($unEmploye->GetPrenom() . ' ' . $unEmploye->GetNom()); ?> » ?"
                               data-bs-title="Supprimer cet employé">
                               <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="<?= $this->data['isLoggedOn'] ? 5 : 4 ?>" id="totalCount">
                    <?php
                        $totalRows = count($this->data['lesEmployes']);
                        $total     = $this->data['totalEmployes'];
                        echo "Total: $totalRows " . ($totalRows > 1 ? "employés affichés" : "employé affiché") .
                             " sur $total " . ($total > 1 ? "employés" : "employé") . ".";
                    ?>
                </td>
            </tr>
        </tfoot>
    </table>

    <!-- Pagination -->
    <?php if ($this->data['totalPages'] > 1): ?>
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= $this->data['currentPage'] == 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?page=listeEmployes&service=<?= urlencode($currentServiceCode) ?>&orderBy=<?= urlencode($orderBy) ?>&direction=<?= urlencode($direction) ?>&page_num=<?= $this->data['currentPage']-1 ?>">Précédent</a>
            </li>

            <?php for ($i=1; $i<=$this->data['totalPages']; $i++): ?>
                <li class="page-item <?= $i==$this->data['currentPage']?'active':'' ?>">
                    <a class="page-link" 
                       aria-current="<?= $i==$this->data['currentPage']?'page':false ?>"
                       href="index.php?page=listeEmployes&service=<?= urlencode($currentServiceCode) ?>&orderBy=<?= urlencode($orderBy) ?>&direction=<?= urlencode($direction) ?>&page_num=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?= $this->data['currentPage']==$this->data['totalPages']?'disabled':'' ?>">
                <a class="page-link" href="index.php?page=listeEmployes&service=<?= urlencode($currentServiceCode) ?>&orderBy=<?= urlencode($orderBy) ?>&direction=<?= urlencode($direction) ?>&page_num=<?= $this->data['currentPage']+1 ?>">Suivant</a>
            </li>
        </ul>
    </nav>
    <?php endif; ?>
</div>

<?php
// ✅ Generic delete confirmation modal
$modalId     = "deleteEmployeeModal";
$title       = "Confirmer la suppression";
$body        = "Êtes-vous sûr de vouloir supprimer cet employé ?";
$type        = "confirm";
$confirmText = "Supprimer";
$cancelText  = "Annuler";
$showModal   = false;
require "vues/partiels/v_modal.php";
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const clearSearch = document.getElementById("clearSearch");
    const table = document.getElementById("employeTable");
    const rows = table.getElementsByTagName("tr");
    const totalCell = document.getElementById("totalCount");

    function normalize(str) {
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
    }

    // Live search
    searchInput.addEventListener("keyup", function () {
        const filter = normalize(this.value);
        let visibleCount = 0;

        for (let i = 1; i < rows.length - 1; i++) {
            const cells = rows[i].getElementsByTagName("td");
            if (cells.length > 0) {
                const matricule = normalize(cells[0].textContent);
                const nom       = normalize(cells[1].textContent);
                const prenom    = normalize(cells[2].textContent);

                if (matricule.includes(filter) || nom.includes(filter) || prenom.includes(filter)) {
                    rows[i].style.display = "";
                    visibleCount++;
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        totalCell.textContent = "Total: " + visibleCount + (visibleCount > 1 ? " employés affichés" : " employé affiché") +
                                " sur <?= (int)$this->data['totalEmployes'] ?>" +
                                (<?= (int)$this->data['totalEmployes'] ?> > 1 ? " employés" : " employé") + ".";
        clearSearch.classList.toggle("d-none", !filter);
    });

    clearSearch.addEventListener("click", function () {
        searchInput.value = "";
        searchInput.dispatchEvent(new Event('keyup'));
    });

    // Delete confirmation modal
    const deleteModal = document.getElementById('deleteEmployeeModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const href   = button.getAttribute('data-href');

        // define confirm action dynamically
        window.confirmAction = () => {
            window.location.href = href;
        };

        const body = button.getAttribute('data-body');
        if (body) {
            deleteModal.querySelector('.modal-body').textContent = body;
        }
    });

    // Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-title]'));
    tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
});
</script>

<?php if (!empty($this->data['typeMessage']) && $this->data['typeMessage'] === 'success'): ?>
    <?php 
        $modalId    = "successModal";
        $title      = "Succès";
        $body       = $this->data['leMessage'];
        $type       = "success";
        $cancelText = "Fermer";
        $showModal  = true;
        require "vues/partiels/v_modal.php";
    ?>
<?php endif; ?>
