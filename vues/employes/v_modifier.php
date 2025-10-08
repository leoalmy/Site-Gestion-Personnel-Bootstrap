<div class="container mt-4">
    <h2 class="mb-4">Modifier un employé</h2>

    <form id="editForm" action="index.php?page=modifierEmploye" method="post">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generate_csrf_token()); ?>">
        <div class="mb-3">
            <label for="matricule" class="form-label">Matricule :</label>
            <input type="text" class="form-control" id="matricule" name="matricule"
                   value="<?= htmlspecialchars($this->data['unEmploye']->GetMatricule()); ?>"
                   readonly>
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom"
                   value="<?= htmlspecialchars($this->data['unEmploye']->GetNom()); ?>" maxlength="50" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom"
                   value="<?= htmlspecialchars($this->data['unEmploye']->GetPrenom()); ?>" maxlength="50" required>
        </div>

        <div class="mb-3">
            <label for="service" class="form-label">Service :</label>
            <select class="form-select" id="service" name="service" required>
                <?php foreach ($this->data['lesServices'] as $unService): ?>
                    <option value="<?= $unService->GetCode(); ?>"
                        <?= $unService->GetCode() === $this->data['unEmploye']->GetService() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($unService->GetDesignation()); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Trigger confirm modal -->
        <button type="button" class="btn btn-primary" id="openSaveModal">
            Enregistrer les modifications
        </button>
    </form>
</div>

<?php
// ✅ Generic confirm modal
$modalId     = "confirmSaveModal";
$title       = "Confirmer la sauvegarde";
$body        = "Voulez-vous vraiment sauvegarder les informations de cet employé ?";
$type        = "confirm";
$confirmText = "Oui, sauvegarder";
$cancelText  = "Annuler";
$showModal   = false;
require "vues/partiels/v_modal.php";
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const openSaveModal = document.getElementById("openSaveModal");
    const editForm = document.getElementById("editForm");

    openSaveModal.addEventListener("click", () => {
        const nom = document.getElementById("nom").value.trim();
        const prenom = document.getElementById("prenom").value.trim();

        if (!nom || !prenom) {
            alert("Veuillez remplir tous les champs requis.");
            return;
        }

        // Define confirm action
        window.confirmAction = () => editForm.submit();

        // Update modal body dynamically (optional)
        document.querySelector("#confirmSaveModal .modal-body").textContent =
            `Voulez-vous vraiment sauvegarder les informations de l'employé ${prenom} ${nom} ?`;

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById("confirmSaveModal"));
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
