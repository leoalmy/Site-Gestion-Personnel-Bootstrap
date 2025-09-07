<div class="container mt-4">
    <h2 class="mb-4">Modifier un employé</h2>

    <form id="editForm" action="index.php?page=modifierEmploye" method="post">
        <div class="mb-3">
            <label for="matricule" class="form-label">Matricule :</label>
            <input type="text" class="form-control" id="matricule" name="matricule"
                   value="<?php echo $employe->GetMatricule(); ?>"
                   readonly>
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom"
                   value="<?php echo htmlspecialchars($employe->GetNom()); ?>" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom"
                   value="<?php echo htmlspecialchars($employe->GetPrenom()); ?>" required>
        </div>

        <div class="mb-3">
            <label for="service" class="form-label">Service :</label>
            <select class="form-select" id="service" name="service" required>
                <?php
                foreach ($this->data['lesServices'] as $unService) {
                    $selected = ($unService->GetCode() === $employe->GetService()) ? 'selected' : '';
                    echo '<option value="' . $unService->GetCode() . '" ' . $selected . '>'
                         . htmlspecialchars($unService->GetDesignation()) . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- Trigger button (opens modal instead of submitting directly) -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmSaveModal">
            Enregistrer les modifications
        </button>
    </form>
</div>

<!-- Save Confirmation Modal -->
<div class="modal fade" id="confirmSaveModal" tabindex="-1" aria-labelledby="confirmSaveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmSaveModalLabel">Confirmer la sauvegarde</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment sauvegarder les informations de cet employé ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <!-- This button actually submits the form -->
        <button type="button" class="btn btn-primary" id="confirmSaveBtn">Oui, sauvegarder</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const confirmSaveBtn = document.getElementById('confirmSaveBtn');
    const editForm = document.getElementById('editForm');

    confirmSaveBtn.addEventListener('click', function() {
        editForm.submit(); // submit the form when confirmed
    });
});
</script>