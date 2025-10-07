<div class="container mt-4">
    <h2 class="mb-4">Ajout d'un employé</h2>

    <form action="index.php?page=ajoutEmploye" method="post" id="addForm">
        <div class="mb-3">
            <label for="matricule" class="form-label">Matricule :</label>
            <input type="text" class="form-control" id="matricule" 
                   value="<?= $this->data['nextMatricule'] ?>" disabled>
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
                <?php foreach ($this->data['lesServices'] as $unService): ?>
                    <option value="<?= $unService->GetCode(); ?>">
                        <?= $unService->GetDesignation(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Trigger modal instead of direct submit -->
        <button type="button" class="btn btn-primary" id="openAddModal">
            Enregistrer
        </button>
    </form>
</div>

<?php
// ✅ Generic confirm modal (always available)
$modalId     = "confirmAddModal";
$title       = "Confirmer l'ajout";
$body        = "Voulez-vous vraiment ajouter cet employé ?";
$type        = "confirm";
$confirmText = "Oui, ajouter";
$cancelText  = "Annuler";
$showModal   = false;
require "vues/partiels/v_modal.php";
?>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const openAddModalBtn = document.getElementById("openAddModal");
    const addForm = document.getElementById("addForm");

    openAddModalBtn.addEventListener("click", () => {
        const nom = document.getElementById("nom").value.trim();
        const prenom = document.getElementById("prenom").value.trim();

        if (!nom || !prenom) {
            alert("Veuillez remplir tous les champs requis.");
            return;
        }

        // Define confirm action
        window.confirmAction = () => addForm.submit();

        // Update modal body dynamically
        document.querySelector("#confirmAddModal .modal-body").textContent =
            `Voulez-vous vraiment ajouter l'employé ${prenom} ${nom} ?`;

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById("confirmAddModal"));
        modal.show();
    });
});
</script>

<?php if (!empty($this->data['typeMessage']) && $this->data['typeMessage'] === 'error'): ?>
    <?php 
        $modalId    = "errorModal";
        $title      = "Erreur";
        $body       = $this->data['leMessage'];
        $type       = "error";
        $cancelText = "Fermer";
        $showModal  = true;
        require "vues/partiels/v_modal.php";
    ?>
<?php endif; ?>
