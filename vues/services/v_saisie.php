<div class="container mt-4">
    <h2 class="mb-4">Ajout d'un service</h2>

    <form action="index.php?page=ajoutService" method="post" id="addForm">
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
    $modalId = "confirmAddModal";
    $title   = "Confirmer l'ajout";
    $body    = "Voulez-vous vraiment ajouter ce service ?";
?>

<script>
    document.getElementById("openAddModal").addEventListener("click", () => {
        const designation = document.getElementById("designation").value.trim();

        if (!designation) {
            alert("Veuillez remplir tous les champs requis.");
            return; 
        }

        showConfirmModal({
            modalId: "confirmAddModal",
            bodyText: `Voulez-vous vraiment ajouter le service « ${designation} » ?`,
            onConfirm: () => document.getElementById("addForm").submit()
        });
    });
</script>

<?php if (!empty($this->data['typeMessage']) && $this->data['typeMessage'] === 'error'): ?>
    <?php 
        $modalId = "errorModal";
        $title = "Erreur";
        $body = $this->data['leMessage'];
        $cancelText = "Fermer";
        require "vues/partiels/v_modalError.php";
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var errorModal = new bootstrap.Modal(document.getElementById("<?= $modalId ?>"));
            errorModal.show();
        });
    </script>
<?php endif; ?>
