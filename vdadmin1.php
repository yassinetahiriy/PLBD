<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard ECC</title>
    <link rel="stylesheet" href="style.css">
    <!-- Intégrez ici une bibliothèque d'icônes comme Font Awesome -->
</head>
<style>
    /* Styles généraux */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f2f5;
}

.container {
    display: flex;
}

/* Header */
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

header nav {
    display: flex;
    align-items: center;
}

header input[type="search"] {
    padding: 5px 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}


/* Sidebar */
aside {
    width: 250px;
    background-color: #092344;
    color: #fff;
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
    transition: background-color 0.3s;
}

aside nav ul li a:hover {
    background-color: #1e3a5f;
}

/* Main content */
main {
    flex: 1;
    padding: 20px;
}

h1 {
    color: #092344;
    margin-bottom: 5px;
}

main > p {
    color: #666;
    margin-top: 0;
}

/* Stats */
.stats {
    display: flex;
    justify-content: space-between;
    margin-bottom: 30px;
}

.stat-item {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    flex: 1;
    margin: 0 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.stat-value {
    font-size: 24px;
    font-weight: bold;
    color: #092344;
    display: block;
}

.stat-label {
    color: #666;
}

/* Quick actions */
.quick-actions {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.action-buttons {
    display: flex;
    justify-content: space-between;
}

.action-btn {
    background-color: #092344;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    font-size: 14px;
}

.action-btn i {
    margin-right: 10px;
}

/* Task status */
.task-status {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.task-status ul {
    list-style-type: none;
    padding: 0;
}

.task-status li {
    color: #ff0000;
    margin-bottom: 10px;
}

.task-status li::before {
    content: "×";
    color: #ff0000;
    font-weight: bold;
    display: inline-block;
    width: 1em;
    margin-left: -1em;
}

/* Responsive design */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }
    
    aside {
        width: 100%;
        height: auto;
    }
    
    .stats, .action-buttons {
        flex-direction: column;
    }
    
    .stat-item, .action-btn {
        margin-bottom: 10px;
    }
}
</style>
<body>
    <header>
        <div class="logo">
        <img  src="logolbd.jpg" alt="Logo">
        </div>
        <nav>
            <div class="notifications">
                <i class="icon-bell"></i>
            </div>
            <div class="user-profile">   
                <span>Admin</span>
                <a href="admin_auth.php"> <button class="logout-btn" onclick="logout()">Déconnexion</button></a>
            </div>
        </nav>
    </header>

    
    <div class="container">
        <aside>
            <nav>
                <ul>
                    <li><a href="#"><i class="icon-home"></i> Home</a></li>
                    <li><a href="#"><i class="icon-calendar"></i> Emploi du temps</a></li>
                    <li><a href="#"><i class="icon-class"></i> Classes</a></li>
                    <li><a href="#"><i class="icon-teacher"></i> Professeurs</a></li>
                    <li><a href="#"><i class="icon-room"></i> Salles</a></li>
                </ul>
            </nav>
        </aside>
        
        <main>
            <h1>Bienvenue Admin</h1>
            
            
            <div class="stats">
                <div class="stat-item">
                    <i class="icon-classes"></i>
                    <span class="stat-value">0</span>
                    <span class="stat-label">Classes</span>
                </div>
                <div class="stat-item">
                    <i class="icon-departments"></i>
                    <span class="stat-value">0</span>
                    <span class="stat-label">Départements</span>
                </div>
                <div class="stat-item">
                    <i class="icon-teachers"></i>
                    <span class="stat-value">0</span>
                    <span class="stat-label">Professeurs</span>
                </div>
            </div>
            
            <section class="quick-actions">
                <h2>Raccourcis de Tâches</h2>
                <div class="action-buttons">
                    <button class="action-btn">
                        <i class="icon-import"></i>
                        Importer les emplois du temps d'un fichier Excel
                    </button>
                    <button class="action-btn">
                        <i class="icon-generate"></i>
                        Générer les emplois du temps
                    </button>
                    <button class="action-btn">
                        <i class="icon-export"></i>
                        Exporter les emplois du temps en PDF
                    </button>
                </div>
            </section>
            
            <section class="task-status">
                <h2>Statut des Tâches et Activités</h2>
                <ul>
                    <li class="task-incomplete">Importation des données</li>
                    <li class="task-incomplete">Génération des emplois du temps</li>
                </ul>
            </section>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Import Excel file
    $('button:contains("Importer")').click(function() {
        var formData = new FormData();
        var fileInput = $('<input type="file" name="file" accept=".xlsx, .xls">');
        fileInput.click();
        fileInput.on('change', function() {
            formData.append('file', fileInput[0].files[0]);
            $.ajax({
                url: '/import',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('Import successful');
                    updateTaskStatus('Importation des données', true);
                },
                error: function() {
                    alert('Import failed');
                }
            });
        });
    });

    // Generate schedules
    $('button:contains("Générer")').click(function() {
        $.ajax({
            url: '/generate',
            type: 'POST',
            success: function(response) {
                alert('Generation successful');
                updateTaskStatus('Génération des emplois du temps', true);
            },
            error: function() {
                alert('Generation failed');
            }
        });
    });

    // Export to Excel
    $('button:contains("Exporter")').click(function() {
        window.location.href = '/export_excel';
    });

    function updateTaskStatus(taskName, completed) {
        var taskItem = $('.task-status li:contains("' + taskName + '")');
        if (completed) {
            taskItem.removeClass('task-incomplete').addClass('task-complete');
            taskItem.css('color', 'green');
            taskItem.html('&#10004; ' + taskName);
        } else {
            taskItem.removeClass('task-complete').addClass('task-incomplete');
            taskItem.css('color', 'red');
            taskItem.html('&#10008; ' + taskName);
        }
    }
});
</script>
</body>
</html>