<div class="container mt-4">
    <h2 class="mb-4">Ajout d'un employé</h2>

    <form action="index.php?page=ajoutEmploye" method="post">
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

        <button type="submit" class="btn btn-primary" onclick="return confirmAjoutEmploye()">
            Enregistrer
        </button>



    </form>
</div>

<script>
function confirmAjoutEmploye() {
    const nom = document.getElementById('nom').value;
    const prenom = document.getElementById('prenom').value;

    return confirm(
        `Voulez-vous vraiment ajouter l'employé ${prenom} ${nom} ?`
    );
}
</script>