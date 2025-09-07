<div class="container mt-4">
    <h2 class="mb-4">Ajout d'un service</h2>

    <form action="index.php?page=ajoutService" method="post" id="addForm">
        <div class="mb-3">
            <label for="code" class="form-label">Code :</label>
            <input type="text" class="form-control" id="code" name="code"
                value="<?= $this->data['nextCode'] ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="designation" class="form-label">Désignation :</label>
            <input type="text" class="form-control" id="designation" name="designation" maxlength="50" required>
        </div>

        <!-- Trigger modal instead of direct submit -->
        <button type="button" class="btn btn-primary" id="openAddModal">
            Enregistrer
        </button>
    </form>
</div>

<?php
    // Reusable modal
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
            bodyText: `Voulez-vous vraiment ajouter le service ${designation} ?`,
            onConfirm: () => document.getElementById("addForm").submit()
        });
    });
</script>
