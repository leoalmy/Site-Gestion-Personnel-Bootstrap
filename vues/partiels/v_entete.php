<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title>Gestion du personnel</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="fr" />

    <meta name="viewport" content="width=device-width, initial-scale=1"> 

    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u3@0Kp6M/tr1iBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
    crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

    <link rel="stylesheet" 
      href="public/css/custom.css?v=<?= filemtime('public/css/custom.css') ?>" 
      type="text/css"/>

    <script src="public/js/main.js?v=<?= filemtime('public/js/main.js') ?>"></script>

</head>
<header class="bg-dark text-light py-3 shadow">
  <div class="container">
    <h1>Gestion du personnel</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <a class="btn btn-primary" href="index.php?page=accueil" role="button">Accueil</a>

    <div class="btn-group">
        <a class="btn btn-primary dropdown-toggle" role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
           Employés
        </a>
        <ul class="dropdown-menu">
            <?php if($this->data['isLoggedOn']) { ?>
            <li><a class="dropdown-item" href="index.php?page=saisieEmploye">Ajouter un employé</a></li>
            <li><hr class="dropdown-divider"></li>
            <?php } ?>
            <?php
            foreach ($this->data["lesServices"] as $unService) {
                echo '<li><a class="dropdown-item" href="index.php?service='
                     . $unService->GetCode()
                     . '&page=listeEmployes">'
                     . $unService->GetDesignation()
                     . '</a></li>';
            }
            ?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="index.php?service=all&page=listeEmployes">
                Tous les services
            </a></li>
        </ul>
    </div>   
    <div class="btn-group">
        <a class="btn btn-primary dropdown-toggle" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">            Services
        </a>
        <ul class="dropdown-menu">
          <?php if($this->data['isLoggedOn']) { ?>
            <li><a class="dropdown-item" href="index.php?page=saisieService">Ajouter un service</a></li>
            <li><hr class="dropdown-divider"></li>
            <?php } ?>
            <li><a class="dropdown-item" href="index.php?page=listeServices">Liste des services</a></li>
          </ul>
    </div>
    <?php if($this->data['isLoggedOn'] && $this->getCurrentUserRole() == 'ROLE_ADMIN') { ?>
    <div class="btn-group">
      <a class="btn btn-primary" role="button" href="index.php?page=consulterComptes"> Comptes </a>
    </div>
    <?php } ?>

    </div>
      <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <?php if(!$this->data['isLoggedOn']) { ?>
              Compte <i class="bi bi-person me-1"></i>
          <?php } else { ?>
              <?= htmlspecialchars($this->data['user']->GetPrenom() ?? 'Utilisateur') ?>
          <?php } ?>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <?php if(!$this->data['isLoggedOn']) { ?>
              <li><a class="dropdown-item" href="index.php?page=connexion">Connexion</a></li>
              <li><a class="dropdown-item" href="index.php?page=inscription">Inscription</a></li>
          <?php } else { ?>
              <li><a class="dropdown-item" href="index.php?page=profil">Profil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="index.php?page=deconnexion">Déconnexion</a></li>
          <?php } ?>
        </ul>
      </div>
  </div>
</header>
<body>