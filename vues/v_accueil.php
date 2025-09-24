<?php if (basename($this->data['image_accueil']) === 'accueil.jpg'): ?>
    <!-- HERO BANNER -->
    <div class="hero-banner position-relative text-center text-light">
        <img src="<?= $this->data['image_accueil'] ?>" class="img-fluid w-100" alt="Image d'accueil">
        <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
            <h1 class="display-5 fw-bold">Pour toutes questions ou soucis, nos étudiants du SIO sont là pour vous aider ! </h1>
        </div>
    </div>
<?php else: ?>
    <!-- CARD -->
    <div class="container my-4 d-flex justify-content-center">
        <div class="card text-center shadow" style="max-width: 600px;">
            <img src="<?= $this->data['image_accueil'] ?>" class="card-img-top img-fluid" alt="Image d'accueil alternative">
            <hr class="my-0">
            <div class="card-body">
                <p class="fs-4 fw-semibold mb-0">Pour toutes questions ou soucis, nos étudiants du SIO sont là pour vous aider ! </p>
            </div>
        </div>
    </div>
<?php endif; ?>

<link rel="stylesheet" href="public/css/accueil.css" type="text/css" />