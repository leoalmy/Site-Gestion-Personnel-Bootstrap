<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Accès refusé</title>
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
      color: #e67e22;
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
    .btn:hover { background: #2980b9; }
    .illustration {
      max-width: 180px;
      margin: 0 auto 20px;
      opacity: 0;
      animation: fadeIn 1s ease forwards;
      animation-delay: 0.1s;
    }
    /* Animations */
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    /* 🌙 Dark mode */
    @media (prefers-color-scheme: dark) {
      body { background: #1e1e1e; color: #ddd; }
      .error-box { background: #2c2c2c; box-shadow: 0 6px 20px rgba(0,0,0,0.6); }
      p { color: #ccc; }
    }
  </style>
  <script>
    // 🔒 Random access-refused themed illustration
    function pickIllustration() {
      const illustrations = [
        `<!-- Locked Padlock -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="100%" height="100%">
          <rect x="16" y="28" width="32" height="28" rx="4" ry="4" fill="#ccc" stroke="#999"/>
          <path d="M20 28v-8a12 12 0 0 1 24 0v8" fill="none" stroke="#999" stroke-width="3"/>
          <circle cx="32" cy="42" r="4" fill="#e67e22"/>
          <line x1="32" y1="46" x2="32" y2="50" stroke="#e67e22" stroke-width="3"/>
        </svg>`,
        `<!-- Shield -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="100%" height="100%">
          <path d="M32 4 L56 12 V28 C56 44 44 56 32 60 C20 56 8 44 8 28 V12 Z"
                fill="#ccc" stroke="#999" stroke-width="2"/>
          <path d="M20 24 L44 24 M32 24 L32 44"
                stroke="#e67e22" stroke-width="3"/>
        </svg>`,
        `<!-- Hand stop -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="100%" height="100%">
          <path d="M20 16 v16 l-2 12 a10 10 0 0 0 10 10 h8 a10 10 0 0 0 10-10 l-2-12 V16 a4 4 0 0 0-8 0 v12 h-2 V14 a4 4 0 0 0-8 0 v14 h-2 V16 a4 4 0 0 0-8 0z"
                fill="#ccc" stroke="#999" stroke-width="2"/>
        </svg>`
      ];
      const pick = illustrations[Math.floor(Math.random() * illustrations.length)];
      document.getElementById("illustration").innerHTML = pick;
    }
    window.onload = pickIllustration;
  </script>
</head>
<body>
  <div class="error-box">
    <div class="illustration" id="illustration"></div>
    <h1>Accès refusé</h1>
    <p>Vous n’avez pas la permission d’accéder à cette page.<br>
       Veuillez vérifier vos droits ou retourner à l’accueil.</p>
    <a href="index.php?page=accueil" class="btn">Retour à l’accueil</a>
  </div>
</body>
</html>
