<div class="container my-4">
    <h2>Inscription</h2>
    <form action="" method="post">
        <div>
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" name="nom" id="nom" class="form-control" required /><br/>

            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" name="prenom" id="prenom" class="form-control" required /><br/>

            <label for="email" class="form-label">Email :</label>
            <input type="text" name="email" id="email" class="form-control" required /><br/>

            <label for="mdp" class="form-label">Mot de passe :</label>
            <div class="input-group mb-3">
                <input type="password" name="mdp" id="mdp" class="form-control" required />
                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('mdp', this)">
                    <i class="bi bi-eye"></i>
                </button>
            </div>

            <label for="mdpConf" class="form-label">Confirmer Mot de passe :</label>
            <div class="input-group mb-3">
                <input type="password" name="mdpConf" id="mdpConf" class="form-control" required />
                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('mdpConf', this)">
                    <i class="bi bi-eye"></i>
                </button>
            </div>

            <label for="tel" class="form-label">Téléphone :</label>
            <input type="tel" name="tel" id="tel" class="form-control"
                pattern="^\+?[0-9\s\-]{6,20}$"
                placeholder="+33 6 12 34 56 78" required /><br/>

            <input type="submit" value="Envoyer" class="btn btn-primary"/>
        </div>
    </form>
</div>

<?php if (!empty($this->data['typeMessage']) && $this->data['typeMessage'] === 'error'): ?>
    <?php 
        $modalId = "errorModal";
        $title = "Erreur d'inscription";
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
