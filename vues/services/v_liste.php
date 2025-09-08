<div class="container my-4">
    <!--- Titre de la page --->
    <h2 class="mb-4">Liste des Services</h2>

    <!-- 🔍 Search bar -->
    <div class="d-flex mb-3">
        <input type="text" id="searchInput" class="form-control me-2" placeholder="Rechercher un service...">
        <button id="clearSearch" class="btn btn-secondary" style="display: none;">✕</button>
    </div>

    <!--- Tableau des services --->
    <table class="table table-striped table-bordered" id="serviceTable">
        <thead class="table-dark">
            <tr>
                <th>Code</th>
                <th>Désignation</th>
                <th>Nombre d'employés</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->data['lesServices'] as $service): ?>
                <tr>
                    <td><?php echo htmlspecialchars($service->GetCode()); ?></td>
                    <td><?php echo htmlspecialchars($service->GetDesignation()); ?></td>
                    <td><?php echo htmlspecialchars($service->GetNbEmployes()); ?></td>
                    <td>
                        <a href="index.php?page=modifierService&code=<?php echo urlencode($service->GetCode()); ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a>
                        <a href="#" 
                            class="btn btn-danger btn-sm delete-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#confirmModal" 
                            data-href="index.php?page=supprimerService&code=<?php echo urlencode($service->GetCode()); ?>" 
                            data-bs-title="Supprimer ce service" 
                            data-body="Voulez-vous vraiment supprimer le service <?php echo htmlspecialchars($service->GetDesignation()); ?> ?">
                            <i class="bi bi-trash"></i>
                        </a>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" id="totalCount">Total: <?php echo count($this->data['lesServices']); ?> services</td>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const confirmModal = document.getElementById('confirmModal');
        const confirmBtn   = document.getElementById('confirmBtn');

        // Handle opening modal for each delete button
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const href = btn.getAttribute('data-href');
                const title = btn.getAttribute('data-bs-title') || 'Confirmer';
                const body = btn.getAttribute('data-body') || 'Voulez-vous continuer ?';

                // Update modal content dynamically
                confirmModal.querySelector('.modal-title').textContent = title;
                confirmModal.querySelector('.modal-body').textContent  = body;

                // Update confirm button click
                confirmBtn.onclick = function () {
                    window.location.href = href;
                };
            });
        });
    });

    // Live search functionality
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchInput");
        const table = document.getElementById("serviceTable");
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
                    const designation = normalize(cells[1].textContent);

                    if (
                        matricule.includes(filter) ||
                        designation.includes(filter)
                    ) {
                        rows[i].style.display = "";
                        visibleCount++;
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            }

            if (visibleCount == 1) {
                totalCell.textContent = "Total: 1 service";
            } else {
            totalCell.textContent = "Total: " + visibleCount + " services";
            }

            document.getElementById("clearSearch").style.display = filter ? 'inline-block' : 'none';
        });
    });
</script>
