<div class="card-container my-5">
    <div class="card">
        <!-- Front face -->
        <div class="card-face card-front text-center p-3">
            <img src="public/photos/default_pdp.png" 
                 alt="Photo de profil de <?php echo $_SESSION['user']->GetNom() . ' ' . $_SESSION['user']->GetPrenom(); ?>" 
                 class="rounded-circle border mb-3 img-fluid" 
                 style="max-width: 120px;">
            <h2 class="mb-3">
                <?php echo $_SESSION['user']->GetNom() . " " . $_SESSION['user']->GetPrenom(); ?>
            </h2>
            <p class="card-hint">
                <span class="hint-desktop">Passez la souris pour plus d’infos</span>
                <span class="hint-mobile">Touchez la carte pour plus d’infos</span>
            </p>
        </div>

        <!-- Back face -->
        <div class="card-face card-back text-start p-3">
            <ul class="list-unstyled mb-3">
                <li class="d-flex align-items-center mb-2">
                    <i class="bi bi-envelope me-2"></i>
                    <span><strong>Email :</strong> <?php echo $_SESSION['user']->GetEmail()?></span>
                </li>
                <li class="d-flex align-items-center mb-2">
                    <i class="bi bi-telephone me-2"></i>
                    <span><strong>Téléphone :</strong> <?php echo $_SESSION['user']->GetTelFormate()?></span>
                </li>
                <li class="d-flex align-items-center mb-2">
                    <i class="bi bi-calendar me-2"></i>
                    <span><strong>Date d'inscription :</strong> <?php echo $_SESSION['user']->GetDateInscriptionFormatee()?></span>
                </li>
            </ul>
            <div class="d-flex justify-content-center gap-3">
                <a href="" class="btn btn-primary btn-sm">
                    <i class="bi bi-pencil"></i> Modifier
                </a>
                <a href="" class="btn btn-secondary btn-sm">
                    <i class="bi bi-key"></i> Mot de passe
                </a>
            </div>
            <div class="text-center mt-3">
                <a href="index.php?page=deconnexion" class="btn btn-danger btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const card = document.querySelector(".card");

    // Toggle "is-flipped" when tapping on mobile
    card.addEventListener("click", () => {
        card.classList.toggle("is-flipped");
    });
});
</script>
