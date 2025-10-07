<div class="container mt-4">
    <h2 class="mb-4">Modifier un service</h2>

    <form id="editForm" action="index.php?page=modifierService" method="post">
        <div class="mb-3">
            <label for="code" class="form-label">Code :</label>
            <input type="text" class="form-control" id="code" name="code"
                   value="<?= htmlspecialchars($this->data['leService']->GetCode()); ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="designation" class="form-label">Désignation :</label>
            <input type="text" class="form-control" id="designation" name="designation"
                   value="<?= htmlspecialchars($this->data['leService']->GetDesignation()); ?>" required>
        </div>

        <!-- Trigger confirm modal -->
        <button type="button" class="btn btn-primary" id="openSaveModal">
            Enregistrer les modifications
        </button>
    </form>
</div>

<?php
// Confirm modal (always available, never auto-show)
$modalId     = "confirmSaveModal";
$title       = "Confirmer la modification";
$body        = "Voulez-vous vraiment enregistrer les modifications ?";
$type        = "confirm";
$confirmText = "Oui, enregistrer";
$cancelText  = "Annuler";
$showModal   = false;
require "vues/partiels/v_modal.php";
?>

<script>
document.getElementById("openSaveModal").addEventListener("click", () => {
    const designation = document.getElementById("designation").value.trim();

    if (!designation) {
        alert("Veuillez remplir tous les champs requis.");
        return;
    }

    // Define confirm callback
    window.confirmAction = () => document.getElementById("editForm").submit();

    // Update modal body dynamically
    document.querySelector("#confirmSaveModal .modal-body").innerText =
        `Voulez-vous vraiment enregistrer les modifications pour le service « ${designation} » ?`;

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById("confirmSaveModal"));
    modal.show();
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
