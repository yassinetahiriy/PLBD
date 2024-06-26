<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emploi du temps</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    .logo img {
        width: 50px; /* Adjust the width as needed */
        height: auto; /* This will maintain the aspect ratio */
    }
    .MESSAGE {
        position: fixed;
        bottom: 20px;
        right: 20px;
    }
    .schedule-table {
        display: none;
    }

    /* Color classes */
    .yellow-cell {
        background-color: yellow !important;
    }

    .blue-cell {
        background-color: blue !important;
    }

    .red-cell {
        background-color: red !important;
    }
</style>

<body class="p-3 m-0 border-0 bd-example m-0 border-0">
<!-- Example Code -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="logo">
        <img src="logolbd.jpg" alt="Logo">
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="btn btn-outline-secondary" data-bs-toggle="offcanvas" href="#offcanvasExample"
                   role="button" aria-controls="offcanvasExample">Menu</a>
            </li>
        </ul>
        <div class="topnav">
            <?php if(isset($db_username)) { ?>
                <a><?php echo $db_username; ?></a>
            <?php } ?>
             <a href="etudiant_authen.php"><button class="btn btn-danger" type="button" >Se déconnecter</button></a> 
        </div>
    </div>
</nav>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images,
            lists, etc.
        </div>
        <div>
            <button type="button" class="btn btn-secondary" onclick="showSchedule()">Emploi du temps</button>
        </div>
        <div class="dropdown mt-3">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-expanded="false">
                Select Professor
            </button>
            <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton" style="min-width: 300px;">
                <input type="text" class="form-control mb-2" id="professorSearch" placeholder="Search Professors...">
                <ul id="professorsList" class="list-unstyled">
                    <!-- Example professors -->
                    <li><a class="dropdown-item" href="#" data-available="true">Professor 1 (Available)</a></li>
                    <li><a class="dropdown-item" href="#" data-available="false">Professor 2 (Not Available)</a></li>
                    <li><a class="dropdown-item" href="#" data-available="true">Professor 3 (Available)</a></li>
                    <!-- Add more professors here -->
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="MESSAGE">
    <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
        Messagerie
    </button>
    <ul class="dropdown-menu p-4" style="min-width: 300px;">
        <!-- Message Box Form -->
        <form id="emailForm" action="/path-to-your-server-endpoint" method="POST">
            <div class="mb-3">
                <label for="recipientEmail" class="form-label">To:</label>
                <input type="email" class="form-control" id="recipientEmail" name="recipientEmail"
                       placeholder="professor@example.com">
            </div>
            <div class="mb-3">
                <label for="emailSubject" class="form-label">Subject:</label>
                <input type="text" class="form-control" id="emailSubject" name="subject"
                       placeholder="Enter subject here">
            </div>
            <div class="mb-3">
                <label for="emailMessage" class="form-label">Message:</label>
                <textarea class="form-control" id="emailMessage" rows="4" name="message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Email</button>
        </form>
    </ul>
</div>
<div class="container mt-3 schedule-table">
    <h2>Emploi du temps</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Heure</th>
            <th scope="col">LUNDI</th>
            <th scope="col">MARDI</th>
            <th scope="col">MERCREDI</th>
            <th scope="col">JEUDI</th>
            <th scope="col">VENDREDI</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">8h - 10h</th>
            <td>Travail en autonomie</td>
            <td>Travail en autonomie</td>
            <td>Travail en autonomie</td>
            <td>Travail en autonomie</td>
            <td>TD3 Statistique / Adil Ahidar / B002</td>
        </tr>

        <tr>
            <th scope="row">10h - 12h</th>
            <td>Travail en autonomie</td>
            <td>Travail en autonomie</td>
            <td>Travail en autonomie</td>
            <td class="yellow-cell">CM3 Probabilite / Adil Ahidar / Amphi1</td>
            <td>TD4 Probablite / Adil Ahidar / B102</td>
        </tr>
        <tr>
            <th scope="row">12h - 14h</th>
            <td colspan="5" class="red-cell">Pause déjeuner</td>
        </tr>
        <tr>
            <th scope="row">14h - 16h</th>
            <td>Travail en autonomie</td>
            <td class="blue-cell">Conférence</td>
            <td>Travail en autonomie</td>
            <td>Travail en autonomie</td>
            <td>Travail en autonomie</td>
        </tr>
        <tr>
            <th scope="row">16h - 18h</th>
            <td >Travail en autonomie</td>
            <td class="blue-cell">Conférence</td>
            <td>Travail en autonomie</td>
            <td>Travail en autonomie</td>
            <td>Travail en autonomie</td>
        </tr>
        </tbody>
    </table>
</div>
<script>
    function showSchedule() {
        var scheduleTable = document.querySelector('.schedule-table');
        scheduleTable.style.display = 'block';
    }
</script>
</body>
</html>
