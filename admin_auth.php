<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PLBD</title>
  <style>
    /* Assurez-vous de coller tous les styles CSS que vous avez fournis plus tôt ici */
    /* Reset box-sizing */
    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }

    /* Apply a gradient background */
    body {
      display: flex;
      justify-content:center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      padding: 0 20px;
      background: linear-gradient(135deg, #4a6cd4, #57c4ff);
      font-family: "Euclid Circular A", "Poppins", sans-serif;
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
      width: 80px;
      height: 80px;
      margin: 0 auto 30px;
      border-radius: 50%;
      margin-bottom: 20px;
    }

    /* Style the form */
    .form {
      margin-bottom: 30px;
    }

    .form input,
    .form button {
      width: 100%;
      height: 50px;
      padding: 10px;
      margin-bottom: 15px;
      border: none;
      border-radius: 25px;
      font-size: 16px;
    }

    .form input {
      background: #f0f0f0;
    }

    .form button {
      background: #4a6cd4;
      color: #fff;
      cursor: pointer;
    }

    h2 {
      color: #ffff;
    }

    .form button:hover {
      background: #3753a4;
    }

    /* Style the footer */
    .footer {
      text-align: center;
      color: #999;
    }

    .footer a {
      color: #d5d7de;
    }

    /* Additional styles for sidebar and content */
    .sidebar {
      height: calc(100% - 60px);
      width: 250px;
      position: fixed;
      top: 60px;
      left: 0;
      background-color: #c62222;
      padding-top: 20px;
    }

    .sidebar h2 {
      color: white;
      text-align: center;
    }

    .sidebar ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    .sidebar ul li {
      padding: 10px;
      position: relative; /* Ensure dropdowns are positioned relative to the list item */
    }

    .sidebar ul li .dropdown-content {
      display: none;
      position: absolute;
      background-color: #333;
      min-width: 160px;
      z-index: 1;
    }

    .sidebar ul li .dropdown-content a {
      color: white;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .sidebar ul li:hover .dropdown-content {
      display: block;
    }

    .content {
      margin-left: 250px;
      padding: 20px;
    }
  </style>
</head>
<body>
<?php
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Votre nom d'utilisateur MySQL
$password = ""; // Votre mot de passe MySQL
$database = "etudiant_auth"; // Votre base de données
$conn = new mysqli($servername, $username, $password, $database);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérification des données de connexion lors de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Requête SQL pour vérifier l'authentification de l'utilisateur
    $sql = "SELECT * FROM adminstrateur WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Authentification réussie, redirection vers la page d'administration
        $_SESSION['username'] = $username;
        header("Location: admin.php");
        exit();
    } else {
        // Authentification échouée, redirection vers la page de connexion avec un message d'erreur
        $error = "Invalid username or password.";
    }
}
?>
<div class="container">
    <div class="card">
      <img class="logo" src="logolbd.jpg" alt="Logo">
      <h2>Login</h2>
      <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Sign up</button>
      </form>
      <footer class="footer">
        <p>Don't have an account? <a href="#">Sign up here</a></p>
      </footer>
    </div>
</div>
</body>
</html>
