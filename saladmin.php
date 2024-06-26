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
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        text-align: left;
        padding: 12px;
        border-bottom: 1px solid #e0e0e0;
    }
    th {
        background-color: #f8f9fa;
        font-weight: bold;
        color: #495057;
    }
    tr:last-child td {
        border-bottom: none;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    .delete-btn {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 6px 12px;
        cursor: pointer;
        border-radius: 4px;
        font-size: 14px;
    }
    .delete-btn:hover {
        background-color: #c82333;
    }
    #addSalleForm {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-top: 20px;
    }
    #addSalleForm input {
        width: calc(100% - 22px);
        margin: 10px 0;
        padding: 8px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }
    #addSalleForm button {
        width: 100%;
        margin-top: 10px;
        padding: 10px;
        background-color: #092344;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        font-size: 16px;
    }
    #addSalleForm button:hover {
        background-color: #0a2d5a;
    }

    .add-button:hover {
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
    <h2>Professeurs</h2>
    <table id="sallesTable">
        <thead>
            <tr>
                <th></th>
                <th>Salle</th>
                <th>Disponibilite</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table body will be populated dynamically -->
        </tbody>
    </table>
    <button id="addsalle" class="add-button">+</button>
</main>
    </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const salleTable = document.getElementById('sallesTable').getElementsByTagName('tbody')[0];
        const addButton = document.getElementById('addsalle');

        // Initial salles data
        const salles = [];

        // Function to render the table
        function renderTable() {
            salleTable.innerphp = '';
            salles.forEach((salle, index) => {
                const row = salleTable.insertRow();
                row.innerphp = `
                    <td><input type="checkbox"></td>
                    <td>${salle.Salle}</td>
                    <td>${salle.Disponibilte}</td>

                    <td><button class="delete-btn" onclick="deletesalle(${index})">Supprimer</button></td>
                `;
            });
        }

        // Function to delete a salle
        window.deletesalle = function(index) {
            salles.splice(index, 1);
            renderTable();
        }

        // Function to add a new salle
        function addsalle(newsalle) {
            salles.push(newsalle);
            renderTable();
        }

        // Add salle form
        addButton.addEventListener('click', function() {
            const form = document.createElement('form');
            form.id = 'addsalleForm';
            form.innerphp = `
                <input type="text" placeholder="salle" required>
                <input type="text" placeholder="Disponnibilite">
                <button type="submit">Ajouter</button>
            `;
            addButton.parentNode.insertBefore(form, addButton.nextSibling);

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const inputs = this.getElementsByTagName('input');
                const newsalle = {
                    Salle: inputs[0].value,
                    Disponibilite: inputs[1].value,
                };
                addsalle(newsalle);
                this.remove();
            });
        });

        // Initial render
        renderTable();
    });
</script>   
</body>
</php>