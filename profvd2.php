<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Enseignant - ENSET</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f2f5;
}

header {
    background-color: #fff;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.logo img {
    height: 40px;
}
.logout-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
            margin-left: 10px;
        }


.search-bar input {
    padding: 5px 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.user-controls {
    display: flex;
    align-items: center;
}

.user-profile {
    display: flex;
    align-items: center;
}

.user-profile img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
}

.container {
    display: flex;
}

aside {
    width: 250px;
    background-color: #092344;
    height: calc(100vh - 60px);
    padding-top: 20px;
}

aside nav ul {
    list-style-type: none;
    padding: 0;
}

aside nav ul li a {
    color: #fff;
    text-decoration: none;
    padding: 10px 20px;
    display: block;
}

main {
    flex: 1;
    padding: 20px;
}

.profile-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.profile-picture {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
}

.profile-info h1 {
    margin: 0;
    font-size: 24px;
}

.profile-actions {
    margin-bottom: 20px;
}

.btn-primary, .btn-secondary {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    margin-right: 10px;
    cursor: pointer;
}

.btn-primary {
    background-color: #092344;
    color: #fff;
}

.btn-secondary {
    background-color: #f0f2f5;
    color: #333;
}

.personal-info {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.personal-info h2 {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.edit-link {
    font-size: 14px;
    color: #092344;
    text-decoration: none;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.info-item label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

.info-item p {
    margin: 0;
}</style>
<body>
    <header>
        <div class="logo">
            <img src="logolbd.jpg">
        </div>
        <div class="user-controls">
            <div class="notifications">
                <i class="icon-bell"></i>
            </div>
            <div class="user-profile">
                <span>AHIDAR ADIL</span>
            </div>
            <button class="logout-btn" onclick="logout()">Déconnexion</button>
        </div>
    </header>

    <div class="container">
        <aside>
            <nav>
                <ul>
                    <li><a href="profvd2.php"><i class="icon-home"></i> Home</a></li>
                    <li><a href="profvd4.php"><i class="icon-calendar"></i> Emploi du temps</a></li>
                    <li><a href="profvd3.php"><i class="icon-clock"></i> Non Disponibilités</a></li>
                </ul>
            </nav>
        </aside>

        <main>
            <section class="profile-header">
                
                <div class="profile-info">
                    <h1>Professeur AHIDAR ADIL</h1>
                    <p>STATISTIAQUE</p>
                    <p><i class="icon-email"></i> ahidar.adil@centrale-casablanca.ma</p>
                </div>
            </section>

            <section class="profile-actions">
                <button class="btn-primary">À propos</button>
                <button class="btn-secondary">Mot de passe</button>
            </section>

            <section class="personal-info">
                <h2>Informations personnelles <a href="#" class="edit-link">Modifier</a></h2>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Nom</label>
                        <p>AHIDAR</p>
                    </div>
                    <div class="info-item">
                        <label>Prénom</label>
                        <p>ADIL</p>
                    </div>
                    <div class="info-item">
                        <label>Adresse e-mail</label>
                        <p>ahidar.adil@centrale-casablanca.ma</p>
                    </div>
                    <div class="info-item">
                        <label>Mobile</label>
                        <p>07 49 00 91 59</p>
                    </div>
                    <div class="info-item">
                        <label>CIN</label>
                        <p>PA 812348</p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>