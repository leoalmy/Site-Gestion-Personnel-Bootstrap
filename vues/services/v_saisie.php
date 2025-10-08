<div class="container mt-4">
    <h2 class="mb-4">Ajout d'un service</h2>

    <form action="index.php?page=ajoutService" method="post" id="addForm">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generate_csrf_token()); ?>">
        <div class="mb-3">
            <label for="code" class="form-label">Code :</label>
            <input type="text" class="form-control" id="code"
                value="<?= htmlspecialchars($this->data['nextCode']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label for="designation" class="form-label">Désignation :</label>
            <input type="text" class="form-control" id="designation" name="designation"
                   maxlength="100" required>
        </div>

        <!-- Bouton qui ouvre le modal de confirmation -->
        <button type="button" class="btn btn-primary" id="openAddModal">
            Enregistrer
        </button>
    </form>
</div>

<?php
$modalId     = "confirmAddModal";
$title       = "Confirmer l'ajout";
$body        = "Voulez-vous vraiment ajouter ce service ?";
$type        = "confirm";
$confirmText = "Oui, ajouter";
$cancelText  = "Annuler";
require "vues/partiels/v_modal.php";
?>


<script>
    document.getElementById("openAddModal").addEventListener("click", () => {
        const designation = document.getElementById("designation").value.trim();

        if (!designation) {
            alert("Veuillez remplir tous les champs requis.");
            return;
        }

        window.confirmAction = () => document.getElementById("addForm").submit();

        document.querySelector("#confirmAddModal .modal-body").innerText =
            `Voulez-vous vraiment ajouter le service « ${designation} » ?`;

        const modal = new bootstrap.Modal(document.getElementById("confirmAddModal"));
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

