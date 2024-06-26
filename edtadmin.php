<!DOCTYPE php>
<php lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENSET Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }
        .container {
            display: flex;
        }
        header nav {
            display: flex;
            align-items: center;
        }

        header input[type="search"] {
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        header {
            background-color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .logo img {
            height: 40px;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .sidebar {
            width: 250px;
            background-color: #092344;
            height: calc(100vh - 60px);
            padding: 20px 0;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .sidebar li {
            padding: 0;
        }
        .nav-button {
            width: 100%;
            background-color: transparent;
            border: none;
            color: white;
            padding: 15px 20px;
            text-align: left;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
        }
        .nav-button:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .nav-button i {
            margin-right: 10px;
            font-size: 18px;
        }
        main {
            flex-grow: 1;
            padding: 20px;
        }
        h1 {
            margin-top: 0;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }
        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .add-button {
            background-color: #092344;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            position: absolute;
            right: 30px;
            margin-top: 10px;
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
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="logolbd.jpg" alt="ENSET Logo">
        </div>
        <div class="user-info">
            <span>Admin</span>
            <button class="logout-btn" onclick="logout()">Déconnexion</button>
        </div>
    </header>
    <div class="container">
        <aside class="sidebar">
            <nav>
                <ul>
                    <li> <a href="admin.php"><button class="nav-button"><i class="fas fa-home"></i> Home</button></a></li>
                    <li><a href="edtadmin.php"><button class="nav-button"><i class="fas fa-calendar"></i> Emploi du temps</button></a></li>
                    <li><a href="clasadmin.php"><button class="nav-button"><i class="fas fa-users"></i> Groupes TD</button></a></li>
                    <li><a href="profadmin.php"><button class="nav-button"><i class="fas fa-chalkboard-teacher"></i> Professeurs</button></a></li>
                    <li><a href="saladmin.php"><button class="nav-button"><i class="fas fa-door-open"></i> Salles</button></a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <h1>Bienvenue Admin</h1>
            <h2>Professeurs</h2>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>CNE</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Spécialité</th>
                        <th>Non disponnibilité</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>PA 12345</td>
                        <td>LOUBNA</td>
                        <td>ABBADI</td>
                        <td>06 49 94 91 59 23</td>
                        <td>ABBADI.LOUBNA@centrale-casablanca.ma</td>
                        <td>Math</td>
                        <td>23/10/1024 au 23/11/2024</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>PA 12346</td>
                        <td>ESSAID</td>
                        <td>ABTAL</td>
                        <td>7 49 94 91 59 23</td>
                        <td>ABTAL.ESSAID@centrale-casablanca.ma</td>
                        <td>Math</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>PA 12347</td>
                        <td>EL HASSAN</td>
                        <td>ACHOUYAB</td>
                        <td>8 49 94 91 59 23</td>
                        <td>ACHOUYAB.EL HASSAN@centrale-casablanca.ma</td>
                        <td>Informatique</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>PA 12348</td>
                        <td>SOUAD</td>
                        <td>AHRIZ</td>
                        <td>9 49 94 91 59 23</td>
                        <td>AHRIZ.SOUAD@centrale-casablanca.ma</td>
                        <td>Informatique</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <button class="add-button">+</button>
        </main>
    </div>
</body>
</php>