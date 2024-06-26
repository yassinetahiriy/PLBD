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
                <h2>Non Disponibilités</h2>
                <table id="non-disponibilites">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Jour</th>
                            <th>Enseignant</th>
                            <th>Période</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table rows will be added here dynamically -->
                    </tbody>
                </table>
                <button class="add-button" onclick="addNewRow()">+</button>
            </div>
        </main>
    </div>

    <script>
        let idCounter = 1;

        function addNewRow() {
            const table = document.getElementById('non-disponibilites').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            
            newRow.innerHTML = `
                <td>${idCounter}</td>
                <td><input type="text" placeholder="Jour"></td>
                <td>AHIDAR ADIL</td>
                <td><input type="text" placeholder="Période"></td>
                <td class="action-icons">
                    <button onclick="saveRow(this)" class="btn-save">Enregistrer</button>
                    <span onclick="deleteRow(this)">🗑️</span>
                </td>
            `;
            
            idCounter++;
        }

        function saveRow(element) {
            const row = element.closest('tr');
            const cells = row.cells;

            const jour = cells[1].querySelector('input').value;
            const periode = cells[3].querySelector('input').value;

            cells[1].innerHTML = jour;
            cells[3].innerHTML = periode;

            cells[4].innerHTML = `
                <span onclick="editRow(this)">✏️</span>
                <span onclick="deleteRow(this)">🗑️</span>
            `;
        }

        function editRow(element) {
            const row = element.closest('tr');
            const cells = row.cells;

            const jour = cells[1].textContent;
            const periode = cells[3].textContent;

            cells[1].innerHTML = `<input type="text" value="${jour}">`;
            cells[3].innerHTML = `<input type="text" value="${periode}">`;

            cells[4].innerHTML = `
                <button onclick="saveRow(this)" class="btn-save">Enregistrer</button>
                <span onclick="deleteRow(this)">🗑️</span>
            `;
        }

        function deleteRow(element) {
            const row = element.closest('tr');
            row.parentNode.removeChild(row);
        }
    </script>
</body>
</html>