<div class="container my-4">
    <h2 class="mb-4">Liste des Services</h2>
    <table class="table table-striped table-bordered" id="serviceTable">
        <thead class="table-dark">
            <tr>
                <th>Code</th>
                <th>Nom</th>
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
</script>
