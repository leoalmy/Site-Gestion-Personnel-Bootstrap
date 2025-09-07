<div class="container mt-4">
    <h2 class="mb-4">Ajout d'un employé</h2>

    <form action="index.php?page=ajoutEmploye" method="post" id="addForm">
        <div class="mb-3">
            <label for="matricule" class="form-label">Matricule :</label>
            <input type="text" class="form-control" id="matricule" 
                value="<?= $this->data['nextMatricule'] ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" maxlength="50" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" maxlength="50" required>
        </div>

        <div class="mb-3">
            <label for="service" class="form-label">Service :</label>
            <select class="form-select" id="service" name="service" required>
                <?php
                foreach ($this->data['lesServices'] as $unService) {
                    echo '<option value="' . $unService->GetCode() . '">' 
                        . $unService->GetDesignation() . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- Trigger modal instead of direct submit -->
        <button type="button" class="btn btn-primary" id="openAddModal">
            Enregistrer
        </button>
    </form>
</div>

<!-- ✅ Modal confirmation -->
<div class="modal fade" id="confirmAddModal" tabindex="-1" aria-labelledby="confirmAddLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmAddLabel">Confirmer l'ajout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment ajouter cet employé ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-success" id="confirmAddBtn">Oui, ajouter</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const openAddModalBtn = document.getElementById("openAddModal");
    const confirmAddBtn = document.getElementById("confirmAddBtn");
    const addForm = document.getElementById("addForm");
    const modalBody = document.querySelector("#confirmAddModal .modal-body");

    // Open modal with dynamic name
    openAddModalBtn.addEventListener("click", () => {
        const nom = document.getElementById("nom").value.trim();
        const prenom = document.getElementById("prenom").value.trim();

        if (!nom || !prenom) {
            alert("Veuillez remplir tous les champs requis.");
            return;
        }

        modalBody.textContent = `Voulez-vous vraiment ajouter l'employé ${prenom} ${nom} ?`;
        const modal = new bootstrap.Modal(document.getElementById("confirmAddModal"));
        modal.show();
    });

    // Confirm = submit form
    confirmAddBtn.addEventListener("click", () => {
        addForm.submit();
    });
});
</script>
