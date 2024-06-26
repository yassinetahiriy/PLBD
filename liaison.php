<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PLBD</title>
  <style>
    /* Reset box-sizing */
    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }

    /* Apply a gradient background */
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      padding: 0 20px;
      
      font-family: "Euclid Circular A", "Poppins", sans-serif;
      background-image: url('eccc.jpg'); /* Définir l'image de fond */
      background-size: cover; /* Redimensionner l'image pour couvrir tout l'arrière-plan */
      background-position: center; /* Centrer l'image de fond */
    }

    /* Style the card container */
    .card {
      position: relative;
      max-width: 400px;
      width: 100%;
      padding: 40px;
      border-radius: 40px;
      background: rgba(52, 50, 50, 0.9); /* Transparent white background */
      backdrop-filter: blur(5px); /* Apply a blur effect */
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      align-items: center; 
    }

    /* Style the logo */
    .card .logo {
      width: 150px; /* Définir la largeur */
      height: 150px; /* Définir la hauteur */
      margin: 0 auto 30px;
      border-radius: 10px; /* Ajouter des coins arrondis */
    }

    /* Style the form */
    .form {
      margin-bottom: 30px;
    }

    .form a {
      display: block;
      width: 100%;
      height: 50px;
      padding: 15px; /* Augmenter l'espacement interne */
      margin-bottom: 15px;
      border: none;
      border-radius: 25px;
      font-size: 16px;
      text-align: center;
      text-decoration: none;
      background: #4a6cd4;
      color: #fff;
      cursor: pointer;
    }

    .form a:hover {
      background: #3753a4;
    }

    h2 {
      color: #ffff;
    }

    .footer {
      text-align: center;
      color: #999;
    }

    .footer a {
      color: #d5d7de;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <img class="logo" src="logolbd.jpg" alt="Logo">
      <h2>Choisissez votre utilisateur</h2>
      <div class="form">
        <a href="etudiant_authen.php">Étudiant</a>
        <a href="professor_auth.php">Professeur</a>
        <a href="admin_auth.php">Admin</a>
      </div>
    </div>
  </div>
</body>
</html>
