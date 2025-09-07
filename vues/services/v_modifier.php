<div class="container mt-4">
    <h2 class="mb-4">Modifier un service</h2>

    <form id="editForm" action="index.php?page=modifierService" method="post">
        <div class="mb-3">
            <label for="code" class="form-label">Code :</label>
            <input type="text" class="form-control" id="code" name="code"
                   value="<?php echo htmlspecialchars($this->data['leService']->GetCode()); ?>"
                   readonly>
        </div>

        <div class="mb-3">
            <label for="designation" class="form-label">Désignation :</label>
            <input type="text" class="form-control" id="designation" name="designation"
                   value="<?php echo htmlspecialchars($this->data['leService']->GetDesignation()); ?>" required>
        </div>

        <!-- Trigger button (opens modal instead of submitting directly) -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmSaveModal">
            Enregistrer les modifications
        </button>
    </form>
</div>

<?php
    // Reusable modal
    $modalId = "confirmSaveModal";
    $title   = "Confirmer la modification";
    $body    = "Voulez-vous vraiment enregistrer les modifications ?";
?>

<script>
    document.querySelector('button[data-bs-target="#confirmSaveModal"]').addEventListener('click', () => {
        const designation = document.getElementById("designation").value.trim();

        if (!designation) {
            alert("Veuillez remplir tous les champs requis.");
            return; 
        }

        showConfirmModal({
            modalId: "confirmSaveModal",
            bodyText: `Voulez-vous vraiment enregistrer les modifications pour le service ${designation} ?`,
            onConfirm: () => document.getElementById("editForm").submit()
        });
    });
</script>