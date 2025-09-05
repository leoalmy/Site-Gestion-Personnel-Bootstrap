<div class="container mt-4">
    <h2 class="mb-4">Modifier un employé</h2>

    <form action="index.php?page=modifierEmploye" method="post">
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

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</div>
