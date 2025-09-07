<div class="container my-4">
    <!-- Page title -->
    <h2>
        <?php
            $services = [
                'all' => 'Tous les services',
                's01' => 'Fabrication',
                's02' => 'Emballage',
                's03' => 'Commercial',
                's04' => 'Administration'
            ];

            // Get the current service code if object exists
            $currentService = 'all';
            if (!empty($this->data['leService'])) {
                $currentService = $this->data['leService']->GetCode();
            }

            echo $currentService === 'all'
                ? 'Tous les services'
                : 'Service ' . ($services[$currentService] ?? 'Inconnu');
        ?>
    </h2>

    <!-- 🔍 Search bar -->
    <div class="d-flex mb-3">
        <input type="text" id="searchInput" class="form-control me-2" placeholder="Rechercher un employé...">
        <button id="clearSearch" class="btn btn-secondary" style="display: none;">✕</button>
    </div>


    <!-- Employee table -->
    <table class="table table-striped table-bordered" id="employeTable">
        <thead class="table-dark">
            <tr>
                <th>
                    <a href="index.php?page=listeEmployes&service=<?php echo urlencode($currentService); ?>&orderBy=emp_matricule&direction=<?php echo ($orderBy === 'emp_matricule' && $direction === 'ASC') ? 'DESC' : 'ASC'; ?>"
                    class="text-light">
                        Matricule
                        <?php if ($orderBy === 'emp_matricule'): ?>
                            <i class="bi bi-caret-<?php echo ($direction === 'ASC') ? 'up' : 'down'; ?>-fill"></i>
                        <?php endif; ?>
                    </a>
                </th>
                <th>
                    <a href="index.php?page=listeEmployes&service=<?php echo urlencode($currentService); ?>&orderBy=emp_nom&direction=<?php echo ($orderBy === 'emp_nom' && $direction === 'ASC') ? 'DESC' : 'ASC'; ?>"
                    class="text-light">
                        Nom
                        <?php if ($orderBy === 'emp_nom'): ?>
                            <i class="bi bi-caret-<?php echo ($direction === 'ASC') ? 'up' : 'down'; ?>-fill"></i>
                        <?php endif; ?>
                    </a>
                </th>
                <th>
                    <a href="index.php?page=listeEmployes&service=<?php echo urlencode($currentService); ?>&orderBy=emp_prenom&direction=<?php echo ($orderBy === 'emp_prenom' && $direction === 'ASC') ? 'DESC' : 'ASC'; ?>"
                    class="text-light">
                        Prénom
                        <?php if ($orderBy === 'emp_prenom'): ?>
                            <i class="bi bi-caret-<?php echo ($direction === 'ASC') ? 'up' : 'down'; ?>-fill"></i>
                        <?php endif; ?>
                    </a>
                </th>
                <th>
                    <a href="index.php?page=listeEmployes&service=<?php echo urlencode($currentService); ?>&orderBy=emp_service&direction=<?php echo ($orderBy === 'emp_service' && $direction === 'ASC') ? 'DESC' : 'ASC'; ?>"
                    class="text-light">
                        Service
                        <?php if ($orderBy === 'emp_service'): ?>
                            <i class="bi bi-caret-<?php echo ($direction === 'ASC') ? 'up' : 'down'; ?>-fill"></i>
                        <?php endif; ?>
                    </a>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($this->data['lesEmployes'] as $unEmploye) 
                {
                    // Map service code to Bootstrap color
                    switch ($unEmploye->GetService()) {
                        case 's01': // Fabrication
                            $btnClass = 'btn-primary'; // blue
                            break;
                        case 's02': // Emballage
                            $btnClass = 'btn-warning'; // orange
                            break;
                        case 's03': // Commercial
                            $btnClass = 'btn-success'; // green
                            break;
                        case 's04': // Administration
                            $btnClass = 'btn-danger'; // red
                            break;
                        default:
                            $btnClass = 'btn-dark'; // fallback
                            break;
                    }

                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($unEmploye->GetMatricule()) . '</td>';
                    echo '<td>' . htmlspecialchars($unEmploye->GetNom()) . '</td>';
                    echo '<td>' . htmlspecialchars($unEmploye->GetPrenom()) . '</td>';

                    // Service button with custom color
                    echo '<td>';
                    echo '<a href="index.php?service=' . htmlspecialchars($unEmploye->GetService()) . '&page=listeEmployes" ';
                    echo 'class="btn btn-sm ' . $btnClass . '">';
                    echo htmlspecialchars($unEmploye->GetServiceName());
                    echo '</a> (' . htmlspecialchars($unEmploye->GetService()) . ')';
                    echo '</td>';
                    echo '<td>';
                    echo "<a href=\"index.php?page=modifierEmploye&matricule=" . htmlspecialchars($unEmploye->GetMatricule()) . "\" 
                            class=\"btn btn-info btn-sm me-2\" 
                            data-bs-title=\"Modifier cet employé\">
                            <i class=\"bi bi-pencil\"></i></a>";
                    echo "<a href=\"#\" 
                            class=\"btn btn-danger btn-sm\" 
                            data-bs-toggle=\"modal\" 
                            data-bs-target=\"#deleteEmployeeModal\" 
                            data-href=\"index.php?page=supprimerEmploye&matricule=" . $unEmploye->GetMatricule() . "\" 
                            data-bs-title=\"Supprimer cet employé\">
                            <i class=\"bi bi-trash\"></i></a>";
                    echo '</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" id="totalCount">Total: <?php echo count($this->data['lesEmployes']); ?> employés</td>
            </tr>
        </tfoot>
    </table>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteEmployeeModal" tabindex="-1" aria-labelledby="deleteEmployeeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteEmployeeModalLabel">Confirmer la suppression</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer cet employé ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Supprimer</a>
      </div>
    </div>
  </div>
</div>

<!-- JS for live search -->
<script>
    // Live search functionality
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchInput");
        const table = document.getElementById("employeTable");
        const rows = table.getElementsByTagName("tr");
        const totalCell = document.getElementById("totalCount");

        function normalize(str) {
            return str
                .normalize("NFD") // split letters and accents
                .replace(/[\u0300-\u036f]/g, "") // remove accents
                .toLowerCase();
        }

        searchInput.addEventListener("keyup", function () {
            const filter = normalize(searchInput.value);
            let visibleCount = 0;

            for (let i = 1; i < rows.length - 1; i++) { // skip header/footer
                const cells = rows[i].getElementsByTagName("td");
                if (cells.length > 0) {
                    const matricule = normalize(cells[0].textContent);
                    const nom = normalize(cells[1].textContent);
                    const prenom = normalize(cells[2].textContent);

                    if (
                        matricule.includes(filter) ||
                        nom.includes(filter) ||
                        prenom.includes(filter)
                    ) {
                        rows[i].style.display = "";
                        visibleCount++;
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            }

            totalCell.textContent = "Total: " + visibleCount + " employés";

            document.getElementById("clearSearch").style.display = filter ? 'inline-block' : 'none';
        });
    });
    
    // Clear search button functionality
    document.getElementById("clearSearch").addEventListener("click", function () {
        document.getElementById("searchInput").value = "";
        document.getElementById("searchInput").dispatchEvent(new Event('keyup'));
        this.style.display = 'none';
    });

    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-title]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });


    // JS for delete confirmation modal
    document.addEventListener("DOMContentLoaded", function() {
        const deleteModal = document.getElementById('deleteEmployeeModal');
        const confirmBtn = document.getElementById('confirmDeleteBtn');

        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const href = button.getAttribute('data-href'); // Get deletion URL
            confirmBtn.setAttribute('href', href); // Set the modal's "Supprimer" button URL
        });
    });
</script>