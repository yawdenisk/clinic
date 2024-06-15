<?php
session_start();


if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'administrator') {
    header("location: ../views/okulist_login.php");
    exit;
}


require_once '../../config/database.php';
require_once '../models/okulist.php';


$database = new Database();
$db = $database->getConnection();
$okulist = new Okulist($db);


if (isset($_GET["okulist_id"]) && !empty(trim($_GET["okulist_id"]))) {
    $okulist_id = trim($_GET["okulist_id"]); 


    if ($okulist->isAdministrator($okulist_id)) {

        $_SESSION['error_message'] = "Nie można usunąć okulisty z rolą administratora.";
        header("location: ../views/admin_panel.php");
        exit;
    }


    if ($okulist->delete($okulist_id)) {
        error_log("Usunięto okulistę o ID: $okulist_id");
        $_SESSION['success_message'] = "Pomyślnie usnięto dokulistę.";
        header("location: ../views/admin_panel.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Wystąpił błąd podczas usuwania dentysty.";
        header("location: ../views/admin_panel.php");
        exit;
    }
} else {
    error_log("Nie przekazano ID okulisty");
    header("location: ../views/admin_panel.php");
    exit;
}
