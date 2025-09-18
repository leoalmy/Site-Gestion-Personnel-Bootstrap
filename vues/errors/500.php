<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Erreur technique</title>
  <style>
    body {
      background: #f4f6f8;
      color: #333;
      font-family: "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      transition: background 0.3s, color 0.3s;
    }
    .error-box {
      background: #fff;
      border-radius: 12px;
      padding: 40px 50px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      text-align: center;
      max-width: 500px;
      transition: background 0.3s, box-shadow 0.3s;
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 0.8s ease forwards;
    }
    h1 {
      font-size: 2em;
      margin-bottom: 10px;
      color: #e74c3c;
      opacity: 0;
      animation: fadeIn 1s ease forwards;
      animation-delay: 0.3s;
    }
    p {
      font-size: 1.1em;
      margin: 0 0 20px;
      opacity: 0;
      animation: fadeIn 1s ease forwards;
      animation-delay: 0.5s;
    }
    .btn {
      display: inline-block;
      padding: 10px 20px;
      background: #3498db;
      color: white;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
      transition: background 0.2s ease-in-out;
      cursor: pointer;
      opacity: 0;
      animation: fadeIn 1s ease forwards;
      animation-delay: 0.7s;
    }
    .btn:hover {
      background: #2980b9;
    }
    .illustration {
      max-width: 200px;
      margin: 0 auto 20px;
      opacity: 0;
      animation: fadeIn 1s ease forwards;
      animation-delay: 0.1s;
    }
    .countdown {
      margin-top: 15px;
      font-size: 0.9em;
      color: #555;
      opacity: 0;
      animation: fadeIn 1s ease forwards;
      animation-delay: 0.9s;
    }
    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    /* 🌙 Dark mode */
    @media (prefers-color-scheme: dark) {
      body { background: #1e1e1e; color: #ddd; }
      .error-box { background: #2c2c2c; box-shadow: 0 6px 20px rgba(0,0,0,0.6); }
      p { color: #ccc; }
      .countdown { color: #aaa; }
    }
  </style>
  <script>
    let seconds = 30;
    function updateCountdown() {
      document.getElementById("countdown").textContent = seconds;
      if (seconds === 0) {
        window.location.reload();
      } else {
        seconds--;
        setTimeout(updateCountdown, 1000);
      }
    }

    // 🎲 Random illustration picker
    function pickIllustration() {
      const illustrations = [
        `<!-- Broken Server -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="100%" height="100%">
          <rect x="8" y="10" width="48" height="14" rx="2" ry="2" fill="#ccc" stroke="#999"/>
          <rect x="8" y="28" width="48" height="14" rx="2" ry="2" fill="#ccc" stroke="#999"/>
          <rect x="8" y="46" width="48" height="14" rx="2" ry="2" fill="#ccc" stroke="#999"/>
          <circle cx="16" cy="17" r="2" fill="#e74c3c"/>
          <circle cx="16" cy="35" r="2" fill="#f1c40f"/>
          <circle cx="16" cy="53" r="2" fill="#2ecc71"/>
          <line x1="28" y1="15" x2="36" y2="21" stroke="#e74c3c" stroke-width="2"/>
          <line x1="36" y1="15" x2="28" y2="21" stroke="#e74c3c" stroke-width="2"/>
        </svg>`,
        `<!-- Sad Robot -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="100%" height="100%">
          <rect x="12" y="20" width="40" height="28" rx="6" ry="6" fill="#ccc" stroke="#999"/>
          <circle cx="24" cy="34" r="4" fill="#333"/>
          <circle cx="40" cy="34" r="4" fill="#333"/>
          <line x1="24" y1="44" x2="40" y2="44" stroke="#e74c3c" stroke-width="3"/>
          <rect x="28" y="10" width="8" height="6" fill="#999"/>
        </svg>`,
        `<!-- Unplugged Cable -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="100%" height="100%">
          <line x1="10" y1="32" x2="28" y2="32" stroke="#3498db" stroke-width="4"/>
          <rect x="28" y="26" width="8" height="12" fill="#ccc" stroke="#999"/>
          <line x1="36" y1="32" x2="54" y2="32" stroke="#e74c3c" stroke-width="4" stroke-dasharray="4"/>
          <rect x="54" y="26" width="8" height="12" fill="#ccc" stroke="#999"/>
        </svg>`,
        `<!-- Sleepy Cloud -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="100%" height="100%">
          <ellipse cx="32" cy="36" rx="20" ry="12" fill="#ccc" stroke="#999"/>
          <ellipse cx="22" cy="32" rx="10" ry="8" fill="#ccc" stroke="#999"/>
          <ellipse cx="42" cy="32" rx="10" ry="8" fill="#ccc" stroke="#999"/>
          <text x="20" y="18" font-size="12" fill="#666">Zzz</text>
        </svg>`
      ];
      const pick = illustrations[Math.floor(Math.random() * illustrations.length)];
      document.getElementById("illustration").innerHTML = pick;
    }

    window.onload = function() {
      updateCountdown();
      pickIllustration();
    }
  </script>
</head>
<body>
  <div class="error-box">
    <div class="illustration" id="illustration"></div>
    <h1>Oups ! Une erreur est survenue</h1>
    <p>Nos serveurs ont un petit souci…<br>Veuillez réessayer plus tard.</p>
    <button class="btn" onclick="window.location.reload();">Réessayer maintenant</button>
    <div class="countdown">
      Nouvelle tentative automatique dans <span id="countdown">30</span> secondes…
    </div>
  </div>
</body>
</html>
