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
        .table-container {
        overflow-x: auto;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #092344;
        color: white;
    }
    td input {
        width: 100%;
        border: none;
        padding: 5px;
        box-sizing: border-box;
    }
    .controls {
        margin-top: 20px;
    }
    .controls button {
        background-color: #092344;
        color: white;
        border: none;
        padding: 10px 15px;
        margin-right: 10px;
        cursor: pointer;
        border-radius: 4px;
    }
    .controls button:hover {
        background-color: #0a2d5a;
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
    <h2>Groupes TD</h2>
    <div class="table-container">
        <table id="tdGroupsTable">
            <thead>
                <tr id="headerRow">
                    <th>TD1</th>
                    <th>TD2</th>
                    <th>TD3</th>
                    <th>TD4</th>
                    <th>TD5</th>
                    <th>TD6</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <!-- Les lignes seront ajoutées dynamiquement ici -->
            </tbody>
        </table>
    </div>
    <div class="controls">
        <button onclick="addRow()">Ajouter une ligne</button>
        <button onclick="addColumn()">Ajouter un groupe TD</button>
    </div>
</main>
    </div>
    
<script>
    function addRow() {
        const tableBody = document.getElementById('tableBody');
        const newRow = tableBody.insertRow();
        const headerRow = document.getElementById('headerRow');
        
        for (let i = 0; i < headerRow.cells.length; i++) {
            const cell = newRow.insertCell();
            cell.innerHTML = '<input type="text" placeholder="Nom de l\'étudiant">';
        }
    }

    function addColumn() {
        const headerRow = document.getElementById('headerRow');
        const newHeader = headerRow.insertCell();
        const newGroupNumber = headerRow.cells.length;
        newHeader.textContent = `TD${newGroupNumber}`;

        const tableBody = document.getElementById('tableBody');
        for (let i = 0; i < tableBody.rows.length; i++) {
            const cell = tableBody.rows[i].insertCell();
            cell.innerHTML = '<input type="text" placeholder="Nom de l\'étudiant">';
        }
    }

    // Initialiser le tableau avec quelques lignes
    for (let i = 0; i < 10; i++) {
        addRow();
    }
</script>
</body>
</php>