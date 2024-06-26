<!DOCTYPE html>
<html lang="fr">
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
    #addProfessorForm {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-top: 20px;
    }
    #addProfessorForm input {
        width: calc(100% - 22px);
        margin: 10px 0;
        padding: 8px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }
    #addProfessorForm button {
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
    #addProfessorForm button:hover {
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
    <table id="professorsTable">
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table body will be populated dynamically -->
        </tbody>
    </table>
    <button id="addProfessor" class="add-button">+</button>
</main>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const professorTable = document.getElementById('professorsTable').getElementsByTagName('tbody')[0];
        const addButton = document.getElementById('addProfessor');

        // Initial professors data
        const professors = [];

        // Function to render the table
        function renderTable() {
            professorTable.innerHTML = '';
            professors.forEach((professor, index) => {
                const row = professorTable.insertRow();
                row.innerHTML = `
                    <td><input type="checkbox"></td>
                    <td>${professor.cne}</td>
                    <td>${professor.firstName}</td>
                    <td>${professor.lastName}</td>
                    <td>${professor.phone}</td>
                    <td>${professor.email}</td>
                    <td>${professor.specialty}</td>
                    <td>${professor.unavailability}</td>
                    <td><button class="delete-btn" onclick="deleteProfessor(${index})">Supprimer</button></td>
                `;
            });
        }

        // Function to delete a professor
        window.deleteProfessor = function(index) {
            professors.splice(index, 1);
            renderTable();
        }

        // Function to add a new professor
        function addProfessor(newProfessor) {
            professors.push(newProfessor);
            renderTable();
        }

        // Add professor form
        addButton.addEventListener('click', function() {
            const form = document.createElement('form');
            form.id = 'addProfessorForm';
            form.innerHTML = `
                <input type="text" placeholder="CNE" required>
                <input type="text" placeholder="Prénom" required>
                <input type="text" placeholder="Nom" required>
                <input type="tel" placeholder="Téléphone" required>
                <input type="email" placeholder="Email" required>
                <input type="text" placeholder="Spécialité" required>
                <input type="text" placeholder="Non disponnibilité">
                <button type="submit">Ajouter</button>
            `;
            addButton.parentNode.insertBefore(form, addButton.nextSibling);

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const inputs = this.getElementsByTagName('input');
                const newProfessor = {
                    cne: inputs[0].value,
                    firstName: inputs[1].value,
                    lastName: inputs[2].value,
                    phone: inputs[3].value,
                    email: inputs[4].value,
                    specialty: inputs[5].value,
                    unavailability: inputs[6].value
                };
                addProfessor(newProfessor);
                this.remove();
            });
        });

        // Initial render
        renderTable();
    });
</script>   
</body>
</html>