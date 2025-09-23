<div class="container my-4">
    <!-- Page title -->
    <h2 class="mb-4">Liste des Services</h2>

    <!-- 🔍 Search bar -->
    <div class="d-flex mb-3">
        <input type="text" id="searchInput" class="form-control me-2" placeholder="Rechercher un service...">
        <button id="clearSearch" class="btn btn-secondary" style="display: none;">✕</button>
    </div>

    <?php
    // Base query string for links
    $queryBase = "page=listeServices";
    if (!empty($orderBy)) {
        $queryBase .= "&orderBy=" . urlencode($orderBy) . "&direction=" . urlencode($direction);
    }
    ?>

    <!-- Services table -->
    <table class="table table-striped table-bordered" id="serviceTable">
        <thead class="table-dark">
            <tr>
                <?php
                $columns = [
                    'sce_code' => 'ID',
                    'sce_designation' => 'Désignation',
                    'nb_employes' => 'Nombre d\'employés'
                ];
                ?>
                <?php foreach ($columns as $colKey => $colLabel): ?>
                    <th scope="col">
                        <a href="index.php?page=listeServices&orderBy=<?= $colKey ?>&direction=<?= ($orderBy === $colKey && $direction === 'ASC') ? 'DESC' : 'ASC' ?>&pageNum=<?= $this->data['pageNum'] ?>"
                           class="text-light">
                            <?= $colLabel ?>
                            <?php if ($orderBy === $colKey): ?>
                                <i class="bi bi-caret-<?= ($direction === 'ASC') ? 'down' : 'up' ?>-fill"></i>
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
            <?php foreach ($this->data['lesServices'] as $service): ?>
                <tr>
                    <td><?= htmlspecialchars($service->GetCode()); ?></td>
                    <td><?= htmlspecialchars($service->GetDesignation()); ?></td>
                    <td><?= htmlspecialchars($service->GetNbEmployes()); ?></td>
                    <?php if ($this->data['isLoggedOn']): ?>
                        <td>
                            <a href="index.php?page=modifierService&code=<?= urlencode($service->GetCode()); ?>" 
                               class="btn btn-primary btn-sm" data-bs-title="Modifier ce service">
                               <i class="bi bi-pencil"></i>
                            </a>
                            <a href="#" 
                               class="btn btn-danger btn-sm" 
                               data-bs-toggle="modal" 
                               data-bs-target="#deleteServiceModal" 
                               data-href="index.php?page=supprimerService&code=<?= urlencode($service->GetCode()); ?>" 
                               data-body="Voulez-vous vraiment supprimer le service « <?= htmlspecialchars($service->GetDesignation()); ?> » ?">
                               <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="<?= $this->data['isLoggedOn'] ? 4 : 3 ?>" id="totalCount">
                    Total: <?= count($this->data['lesServices']); ?> services
                </td>
            </tr>
        </tfoot>
    </table>

    <!-- Pagination -->
    <?php if ($this->data['totalPages'] > 1): ?>
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center">
            <!-- Previous button -->
            <li class="page-item <?= $this->data['pageNum'] == 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?<?= $queryBase ?>&pageNum=<?= $this->data['pageNum']-1 ?>">Précédent</a>
            </li>

            <!-- Page numbers -->
            <?php for ($i = 1; $i <= $this->data['totalPages']; $i++): ?>
                <li class="page-item <?= $i == $this->data['pageNum'] ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?<?= $queryBase ?>&pageNum=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <!-- Next button -->
            <li class="page-item <?= $this->data['pageNum'] == $this->data['totalPages'] ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?<?= $queryBase ?>&pageNum=<?= $this->data['pageNum']+1 ?>">Suivant</a>
            </li>
        </ul>
    </nav>
    <?php endif; ?>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteServiceModal" tabindex="-1" aria-labelledby="deleteServiceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteServiceModalLabel">Confirmer la suppression</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer ce service ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <a href="#" id="confirmDeleteServiceBtn" class="btn btn-danger">Supprimer</a>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const clearSearch = document.getElementById("clearSearch");
    const table = document.getElementById("serviceTable");
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
                const id = normalize(cells[0].textContent);
                const designation = normalize(cells[1].textContent);
                const nbEmployes = normalize(cells[2].textContent);

                if (id.includes(filter) || designation.includes(filter) || nbEmployes.includes(filter)) {
                    rows[i].style.display = "";
                    visibleCount++;
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        totalCell.textContent = "Total: " + visibleCount + (visibleCount > 1 ? " services" : " service");
        clearSearch.style.display = filter ? "inline-block" : "none";
    });

    clearSearch.addEventListener("click", function () {
        searchInput.value = "";
        searchInput.dispatchEvent(new Event("keyup"));
    });

    // Delete confirmation modal
    const deleteModal = document.getElementById('deleteServiceModal');
    const confirmBtn = document.getElementById('confirmDeleteServiceBtn');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const href = button.getAttribute('data-href');
        confirmBtn.setAttribute('href', href);

        const body = button.getAttribute('data-body');
        if (body) {
            deleteModal.querySelector('.modal-body').textContent = body;
        }
    });
});
</script>

<?php if (!empty($this->data['typeMessage']) && $this->data['typeMessage'] === 'success'): ?>
    <?php 
        $modalId = "successModal";
        $title = "Succès";
        $body = $this->data['leMessage'];
        $cancelText = "Fermer";
        require "vues/partiels/v_modalSuccess.php";
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var errorModal = new bootstrap.Modal(document.getElementById("<?= $modalId ?>"));
            errorModal.show();
        });
    </script>
<?php endif; ?>