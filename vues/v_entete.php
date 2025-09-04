<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title>Gestion du personnel</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="fr" />

    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    
    <?php if(isset($css_file)) echo '<link rel="stylesheet" href="'.$css_file.'">'; ?>
    <?php if(isset($css_footer)) echo '<link rel="stylesheet" href="'.$css_footer.'">'; ?>

    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u3@0Kp6M/tr1iBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
    crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU®Gzau9q]J11fW4pNL1hNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN95405Q"
    crossorigin="anonymous"></script>

</head>
<body>
  <div class="container">
    <h1>Gestion du personnel</h1>

    <div class="d-grid gap-2 d-md-block mb-2">
      <a class="btn btn-primary" href="index.php?page=accueil" role="button">Accueil</a>
    
    <div class="btn-group">
        <a class="btn btn-primary dropdown-toggle" href="#" role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
           Liste des employés
        </a>
        <ul class="dropdown-menu">
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
</div>

  </div> 