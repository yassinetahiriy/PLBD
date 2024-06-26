<!DOCTYPE php>
<php lang="fr">
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

.logout-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
            margin-left: 10px;
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
.messaging-panel {
    position: fixed;
    right: -300px;
    top: 70px;
    width: 300px;
    height: calc(100vh - 70px);
    background-color: #fff;
    box-shadow: -2px 0 5px rgba(0,0,0,0.1);
    transition: right 0.3s ease-in-out;
    z-index: 1000;
}

.messaging-panel.open {
    right: 0;
}

.messaging-toggle {
    position: absolute;
    left: -40px;
    top: 10px;
    width: 40px;
    height: 40px;
    background-color: #092344;
    color: #fff;
    border: none;
    cursor: pointer;
    font-size: 20px;
}

.messaging-content {
    padding: 20px;
}

.messaging-content h3 {
    margin-top: 0;
    color: #092344;
}

#message-form input,
#message-form textarea {
    width: 100%;
    margin-bottom: 10px;
    padding: 5px;
}

#message-form textarea {
    height: 150px;
}

.file-upload {
    margin-bottom: 10px;
}

.file-label {
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

#file-input {
    display: none;
}

#message-form button {
    background-color: #092344;
    color: #fff;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
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
                    <li><a href="admin.php"><i class="icon-home"></i> Home</a></li>
                    <li><a href="edtadmin.php"><i class="icon-calendar"></i> Emploi du temps</a></li>
                    <li><a href="clasadmin.php"><i class="icon-class"></i> Classes</a></li>
                    <li><a href="profadmin.php"><i class="icon-teacher"></i> Professeurs</a></li>
                    <li><a href="saladmin.php"><i class="icon-room"></i> Salles</a></li>
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
                    <form id="importForm" enctype="multipart/form-data">
                         <input type="file" id="fileInput" name="file" style="display: none;" accept=".xlsx, .xls">
                            <button type="button" class="action-btn" id="importBtn">
                                 <i class="icon-import"></i>
                                        Importer les données d'un fichier Excel
                             </button>
                    </form>
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
    <div class="messaging-panel">
    <button class="messaging-toggle">📧</button>
    <div class="messaging-content">
        <h3>New Message</h3>
        <form id="message-form">
            <input type="email" placeholder="To:" required>
            <input type="text" placeholder="Subject:" required>
            <textarea placeholder="Message body..." required></textarea>
            <div class="file-upload">
                <label for="file-input" class="file-label">Attach File</label>
                <input type="file" id="file-input">
            </div>
            <button type="submit">Send</button>
        </form>
    </div>
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
            taskItem.php('&#10004; ' + taskName);
        } else {
            taskItem.removeClass('task-complete').addClass('task-incomplete');
            taskItem.css('color', 'red');
            taskItem.php('&#10008; ' + taskName);
        }
    }
});
$(document).ready(function() {
    // Existing code...

    // Messaging panel toggle
    $('.messaging-toggle').click(function() {
        $('.messaging-panel').toggleClass('open');
    });

    // Handle message form submission
    $('#message-form').submit(function(e) {
        e.preventDefault();
        // Here you would typically send the message data to a server
        alert('Message sent!');
        this.reset();
    });

    // Display selected file name
    $('#file-input').change(function() {
        var fileName = $(this).val().split('\\').pop();
        $('.file-label').text(fileName || 'Attach File');
    });
});
$(document).ready(function() {
    $('#importBtn').click(function() {
        $('#fileInput').click();
    });

    $('#fileInput').change(function() {
        var formData = new FormData($('#importForm')[0]);
        $.ajax({
            url: '/import',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Importation réussie : ' + response.message);
            },
            error: function(xhr, status, error) {
                alert('Erreur lors de l\'importation : ' + (xhr.responseJSON ? xhr.responseJSON.error : error));
            }
        });
    });
});
</script>
</body>
</php>