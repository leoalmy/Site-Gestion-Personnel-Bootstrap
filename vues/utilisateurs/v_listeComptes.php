<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

<style>
body {
  overflow-x: hidden; /* interdit le scroll horizontal */
}
/* Conteneur Swiper */
.mySwiper {
  padding: 60px 0;       /* espace haut/bas */
  overflow: visible;     /* pour ne pas couper les cartes sur les côtés */
}

.swiper-slide {
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Cacher proprement un slide (sans casser la mise en page) */
.hidden-slide {
  visibility: hidden !important;
  pointer-events: none !important;
}

/* Flèches */
.swiper-button-next,
.swiper-button-prev {
  color: #0d6efd;
  font-size: 2rem;
  transition: transform 0.2s;
  top: 50%;
  transform: translateY(-50%);
  z-index: 10;
}

.swiper-button-prev {
  left: -40px;  /* placer en dehors */
}
.swiper-button-next {
  right: -40px;
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
  transform: translateY(-50%) scale(1.2);
  color: #0a58ca;
}

/* Pagination stylée */
.swiper-pagination {
  bottom: -30px !important;
}
.swiper-pagination-bullet {
  width: 16px;
  height: 6px;
  border-radius: 3px;
  background: #ccc;
  opacity: 1;
  transition: all 0.3s ease;
}
.swiper-pagination-bullet-active {
  width: 32px;
  background: #0d6efd;
}
</style>

<div class="container my-5">
  <h1 class="mb-4 text-center">Liste des comptes</h1>

  <!-- Barre de recherche -->
  <div class="mb-4 text-center d-flex justify-content-center gap-2">
    <select id="searchField" class="form-select w-auto">
        <option value="all">Tous</option>
        <option value="name">Nom / Prénom</option>
        <option value="email">Email</option>
        <option value="phone">Téléphone</option>
        <option value="date">Date d'inscription</option>
        <option value="role">Rôle</option>
    </select>
    <input type="text" id="searchInput" class="form-control w-50" placeholder="Rechercher...">
    </div>

  <!-- Swiper -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <?php foreach ($users as $u): ?>
        <div class="swiper-slide">
          <div class="card-container">
            <div class="card">
              <div class="card-face card-front text-center p-3">
                <img src="public/photos/default_pdp.png" 
                     alt="Photo de <?= $u->GetNom().' '.$u->GetPrenom(); ?>"
                     class="rounded-circle border mb-3 img-fluid"
                     style="max-width: 120px;">
                <h2 class="mb-3"><?= $u->GetNom()." ".$u->GetPrenom(); ?></h2>
              </div>
              <div class="card-face card-back text-start p-3">
                <ul class="list-unstyled mb-3">
                  <li><strong>Email :</strong> <?= $u->GetEmail(); ?></li>
                  <li><strong>Téléphone :</strong> <?= $u->GetTelFormate(); ?></li>
                  <li><strong>Date :</strong> <?= $u->GetDateInscriptionFormatee(); ?></li>
                  <li><strong>Rôle :</strong> <?= ucfirst($u->GetRole()); ?></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Contrôles -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
let originalSlides = Array.from(document.querySelectorAll(".swiper-slide"));
const swiperWrapper = document.querySelector(".mySwiper .swiper-wrapper");

let swiper = initSwiper(); // fonction qui crée le Swiper

function initSwiper() {
  return new Swiper(".mySwiper", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
      rotate: 20,
      stretch: 0,
      depth: 250,
      modifier: 1,
      slideShadows: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      0: { slidesPerView: 1 },
      768: { slidesPerView: 2 },
      1200: { slidesPerView: 3 }
    }
  });
}

// Recherche : rebuild Swiper avec les bons slides
document.getElementById("searchInput").addEventListener("input", applyFilter);
document.getElementById("searchField").addEventListener("change", applyFilter);

function applyFilter() {
  const filter = document.getElementById("searchInput").value.toLowerCase();
  const field = document.getElementById("searchField").value;

  swiperWrapper.innerHTML = "";

  originalSlides.forEach(slide => {
    let match = false;

    if (field === "all") {
      const text = slide.innerText.toLowerCase();
      match = text.includes(filter);
    }
    else if (field === "name") {
      const name = slide.querySelector("h2")?.innerText.toLowerCase() || "";
      match = name.includes(filter);
    }
    else if (field === "email") {
      const email = slide.querySelector("li:nth-child(1)")?.innerText.toLowerCase() || "";
      match = email.includes(filter);
    }
    else if (field === "phone") {
      const phone = slide.querySelector("li:nth-child(2)")?.innerText.toLowerCase() || "";
      match = phone.includes(filter);
    }
    else if (field === "date") {
      const date = slide.querySelector("li:nth-child(3)")?.innerText.toLowerCase() || "";
      match = date.includes(filter);
    }
    else if (field === "role") {
      const role = slide.querySelector("li:nth-child(4)")?.innerText.toLowerCase() || "";
      match = role.includes(filter);
    }

    if (match) {
      swiperWrapper.appendChild(slide.cloneNode(true));
    }
  });

  swiper.destroy(true, true);
  swiper = initSwiper();
}

// Scroll horizontal avec molette
swiper.el.addEventListener("wheel", (e) => {
  e.preventDefault();
  if (e.deltaY > 0) {
    swiper.slideNext();
  } else {
    swiper.slidePrev();
  }
});

</script>
