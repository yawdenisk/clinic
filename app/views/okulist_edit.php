<?php
session_start(); 

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'administrator') {
    header("location: okulista_login.php");
    exit;
}

$update_err = "";
if (isset($_SESSION['update_err'])) {
    $update_err = $_SESSION['update_err'];
    unset($_SESSION['update_err']); 
}


if (isset($_GET['okulist_id'])) {
    $okulist_id = $_GET['okulist_id'];


    require_once '../../config/database.php';
    require_once '../models/okulist.php';


    $database = new Database();
    $db = $database->getConnection();

    $okulist = new Okulist($db);


    $okulist_data = $okulist->getOkulistById($okulist_id);


    if ($okulist_data === false) {
        exit('Okulista o podanym ID nie został znaleziony.');
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/styles.css">
    <link rel="stylesheet" href="../../public/css/admin_panel.css">
    <title>Edycja danych okulisty</title>
</head>

<body>
    <div class="container">
        <?php include 'shared_navbar.php'; ?>

        <div class="card mt-4 col-md-6" id="add-okulist">
            <div class="card-header">
                Formularz edycji danych okulisty
                <?php if (!empty($update_err)) : ?>
                    <div class="alert alert-danger">
                        <?php echo $update_err; ?></div>
                <?php endif; ?>

                <?php if (isset($_SESSION['password_err'])) : ?>
                    <div class="alert alert-danger">
                        <?php
                        echo $_SESSION['password_err'];
                        unset($_SESSION['password_err']);
                        ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['update_success'])) : ?>
                    <div class="alert alert-success">
                        <?php
                        echo $_SESSION['update_success'];
                        unset($_SESSION['update_success']);
                        ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <form action="../controllers/okulist_update_controller.php" method="post">
                    <input type="hidden" name="okulist_id" value="<?php echo htmlspecialchars($okulist_id); ?>">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Imię</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required value="<?php echo htmlspecialchars($okulist_data['first_name']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Nazwisko</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required value="<?php echo htmlspecialchars($okulist_data['last_name']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="<?php echo htmlspecialchars($okulist_data['email']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="specialization" class="form-label">Specjalizacja</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" value="<?php echo htmlspecialchars($okulist_data['specialization']); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary m-1">Potwierdź</button>
                    <a href="admin_panel.php" class="btn btn-secondary m-1">Anuluj</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>