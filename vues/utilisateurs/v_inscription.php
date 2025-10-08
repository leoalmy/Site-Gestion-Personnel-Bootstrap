<div class="container my-4">
    <h2>Inscription</h2>
    <form action="index.php?page=inscription&action=inscrire" method="post">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generate_csrf_token()); ?>">
        <div>
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" name="nom" id="nom" class="form-control" required /><br/>

            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" name="prenom" id="prenom" class="form-control" required /><br/>

            <label for="email" class="form-label">Email :</label>
            <input type="email" name="email" id="email" class="form-control" required /><br/>

            <label for="mdp" class="form-label">Mot de passe :</label>
            <div class="input-group mb-1">
                <input type="password" name="mdp" id="mdp" class="form-control" required />
                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('mdp', this)">
                    <i class="bi bi-eye"></i>
                </button>
            </div>

            <!-- Bootstrap password strength bar -->
            <small id="strengthText" class="form-text text-muted"></small>
            <div class="progress mb-2">
                <div id="passwordStrength" class="progress-bar" role="progressbar" style="width: 0%">
                </div>
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

<?php 
if (!empty($this->data['typeMessage']) && $this->data['typeMessage'] === 'error')
    {
        $modalId = "errorModal";
        $title = "Erreur d'inscription";
        $body = $this->data['leMessage'];
        $type       = "error";
        $cancelText = "Fermer";
        $showModal  = true;
        require "vues/partiels/v_modal.php";
    }
?>

<script>
document.getElementById("mdp").addEventListener("input", function () {
    const password = this.value;
    const bar = document.getElementById("passwordStrength");
    const text = document.getElementById("strengthText");

    let score = 0;

    if (password.length >= 12) score += 30;
    if (/[a-z]/.test(password)) score += 20;
    if (/[A-Z]/.test(password)) score += 20;
    if (/[0-9]/.test(password)) score += 15;
    if (/[^A-Za-z0-9]/.test(password)) score += 15;

    // update bar width
    bar.style.width = score + "%";

    if (score < 50) {
        bar.className = "progress-bar bg-danger";
        text.textContent = "Faible";
        text.style.color = "red";
    } else if (score < 75) {
        bar.className = "progress-bar bg-warning";
        text.textContent = "Moyen";
        text.style.color = "orange";
    } else {
        bar.className = "progress-bar bg-success";
        text.textContent = "Fort";
        text.style.color = "green";
    }
});
</script>
