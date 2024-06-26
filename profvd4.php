<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Enseignant - ENSET</title>
    <style>
        body {
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

        .search-bar input {
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
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
        .nav-buttons {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .nav-button {
            width: 100%;
            padding: 12px 20px;
            background-color: transparent;
            border: none;
            color: #fff;
            text-align: left;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
        }

        .nav-button:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-button i {
            margin-right: 10px;
            font-size: 18px;
        }

        .nav-button.active {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: bold;
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

        .content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
        }

        .search-bar {
            display: flex;
            margin-bottom: 20px;
        }

        .search-bar input {
            flex-grow: 1;
            margin-right: 10px;
        }

        .btn-primary {
            background-color: #092344;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-icons {
            display: flex;
            justify-content: space-around;
        }

        .add-button {
            background-color: #092344;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 20px;
            border-radius: 4px;
        }
        #emploi-du-temps {
    width: 100%;
    border-collapse: collapse;
}

#emploi-du-temps th, #emploi-du-temps td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

#emploi-du-temps th {
    background-color: #092344;
    color: white;
}

#emploi-du-temps td:first-child {
    font-weight: bold;
    background-color: #f2f2f2;
}
    </style>
</head>
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
        <ul class="nav-buttons">
                    <li><a href="profvd2.php"><button class="nav-button" onclick="navigate('home')"><i class="icon-home"></i> Home</button></a></li>
                    <li><a href="profvd4.php"><button class="nav-button" onclick="navigate('emploi')"><i class="icon-calendar"></i> Emploi du temps</button></a></li>
                    <li><a href="profvd3.php"><button class="nav-button" onclick="navigate('non-disponibilites')"><i class="icon-clock"></i> Non Disponibilités</button></a></li>
                </ul>
        </aside>

        <main>
    <div class="content">
        <h2>Emploi du temps</h2>
        <button class="btn-primary" style="float: right;">Télécharger</button>
        <table id="emploi-du-temps">
            <thead>
                <tr>
                    <th>Jours</th>
                    <th>8h30 - 10h15</th>
                    <th>10h30 - 12h15</th>
                    <th>14h - 15h45</th>
                    <th>16h - 17h45</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Lundi</td>
                    <td>Theorie des graphes (CM): Riane, Amphi</td>
                    <td>Optimisation (TD TD2): Hakim, Class 2 </td>
                    <td>Français</td>
                    <td>Anglais</td>
                </tr>
                <tr>
                    <td>Mardi</td>
                    <td>Optimisation (CM): Hakim, Amphi</td>
                    <td>Systeme dynamique (CM): Hakim, Amphi</td>
                    <td>Theorie des graphes (TD TD2): Riane, Class 5</td>
                    <td>Tarvail en autonomie</td>
                </tr>
                <tr>
                    <td>Mercredi</td>
                    <td>Trvail en autonomie</td>
                    <td>Sys.dynamique (TD2): Moussaoui, Class5</td>
                    <td>Optimisation (TD2): Hakim, Class 3</td>
                    <td>Rheorie des graphes (TD2): Riane, class 6</td>
                </tr>
                <tr>
                    <td>Jeudi</td>
                    <td>Tarvail en autonomie</td>
                    <td>Gestion d'entreprise(CM):Riane, Amphi</td>
                    <td>Tarvail en autonomie</td>
                    <td>Tarvail en autonomie</td>
                </tr>
                <tr>
                    <td>Vendredi</td>
                    <td>ADPL</td>
                    <td>ADPL</td>
                    <td>Tarvail en autonomie</td>
                    <td>Tarvail en autonomie</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
    </div>

</body>
</html>