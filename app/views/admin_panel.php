<?php

session_start(); // Start sesji

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'administrator') {
    header("location: okulist_login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" integrity="sha256-ZCK10swXv9CN059AmZf9UzWpJS34XvilDMJ79K+WOgc=" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/styles.css">
    <link rel="stylesheet" href="../../public/css/admin_panel.css">
</head>

<body>
    <div class="container mt-4">
        <?php include 'shared_navbar.php'; ?>
        
        <h1 class="text-center">Admin panel</h1>
        
        <button onclick="toggleSection('add-okulist', true);" class="btn btn-primary m-1">Dodaj Nowego Okulistę</button>
        
        <div class="card mt-4 col-md-6" id="add-okulist" style="display:none;">
            <div class="card-header">
                Formularz dodawania okulisty
            </div>
            <div class="card-body">
                <form action="../controllers/okulist_add_controller.php" method="post">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Imię</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Nazwisko</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Hasło</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="specialization" class="form-label">Specjalizacja</label>
                        <input type="text" class="form-control" id="specialization" name="specialization">
                    </div>
                    <button type="submit" class="btn btn-primary">Dodaj Okulistę</button>
                    <button type="button" onclick="toggleSection('add-okulist', false);" class="btn btn-secondary m-1">Anuluj</button>
                </form>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header">
                <h5>Lista Okulistow</h3>
                <?php
                    if (isset($_SESSION['error_message'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                        unset($_SESSION['error_message']);
                    }
                    if (isset($_SESSION['success_message'])) {
                        echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
                        unset($_SESSION['success_message']);
                    }
                    ?>
                    <?php if (isset($_SESSION['update_success'])) : ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['update_success']; ?>
                            <?php unset($_SESSION['update_success']); ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (isset($_SESSION['update_err'])) : ?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['update_err']; ?>
                                <?php unset($_SESSION['update_err']); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <?php
                include 'shared_okulista_list.php';
                ?>
            </div>
        </div>
    </div>
    
    
    <script>
        function toggleSection(sectionId, show) {
            var section = document.getElementById(sectionId);
            if (section) {
                section.style.display = show ? 'block' : 'none';
                
                if (show) {
                    section.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>