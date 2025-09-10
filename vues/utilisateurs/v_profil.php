<div class="container my-5 px-3">
    <div class="card mx-auto w-100" style="max-width: 400px;">
        <div class="card-body text-center">
            <img src="public/photos/default_pdp.png" alt="Photo de profil de Nom Prénom" class="rounded-circle border mb-3 img-fluid" style="max-width: 120px;">
            <h2 class="card-title mb-3"><?php echo $_SESSION['user']->GetNom() . " " . $_SESSION['user']->GetPrenom(); ?></h2>
            <ul class="list-group list-group-flush text-start mb-3">
                <li class="list-group-item"><i class="bi bi-envelope me-2"></i><strong>Email :</strong> <?php echo $_SESSION['user']->GetEmail()?></li>
                <li class="list-group-item"><i class="bi bi-telephone me-2"></i><strong>Téléphone :</strong> <?php echo $_SESSION['user']->GetTelFormate()?></li>
                <li class="list-group-item"><i class="bi bi-calendar me-2"></i><strong>Date d'inscription :</strong> <?php echo $_SESSION['user']->GetDateInscriptionFormatee()?></li>
            </ul>
            <div class="d-flex justify-content-center gap-2">
                <a href="modifier_profil.php" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Modifier le profil
                </a>
                <a href="changer_mdp.php" class="btn btn-secondary">
                    <i class="bi bi-key"></i> Changer le mot de passe
                </a>
            </div>
        </div>
    </div>
</div>
