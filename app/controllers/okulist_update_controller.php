<?php
error_log("Formularz edycji danych dentysty został wysłany."); 


session_start();
require_once '../../config/database.php';
require_once '../models/okuist.php';


if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'administrator') {
    header("location: ../views/okuist_login.php"); 
    exit;
}


$database = new Database();
$db = $database->getConnection();
$okulist = new Okulist($db);


$firstName = $lastName = $email = $specialization = "";
$update_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $okulist_id = isset($_POST['okulist_id']) ? trim($_POST['okulist_id']) : null; 


    if (empty(trim($_POST["first_name"]))) {
        $update_err = "Proszę podać imię.";
    } else {
        $firstName = trim($_POST["first_name"]);
    }


    if (empty(trim($_POST["last_name"]))) {
        $update_err .= "\nProszę podać nazwisko.";
    } else {
        $lastName = trim($_POST["last_name"]);
    }


    if (empty(trim($_POST["email"]))) {
        $update_err .= "\nProszę podać email.";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["specialization"]))) {
        $update_err .= "\nProszę podać specjalizację.";
    } else {
        $specialization = trim($_POST["specialization"]);
    }


    if (empty($update_err)) {

        if (!empty($email) && $okulist->isEmailUsedByAnotherOkulist($okulist_id, $email)) {
            $_SESSION['update_err'] = "Podany adres email jest używany przez innego okulistę.";
            header("location: ../views/admin_panel.php");
            exit;
        }

        if ($okulist->updateProfile($okulist_id, $firstName, $lastName, $email, $specialization)) {
            $_SESSION['update_success'] = "Dane okulisty zostały pomyślnie zaktualizowane.";
            header("location: ../views/admin_panel.php");
            exit;
        } else {
            $_SESSION['update_err'] = "Wystąpił błąd podczas aktualizacji danych.";
            header("location: ../views/admin_panel.php");
            exit;
        }
    } else {

        $_SESSION['update_err'] = $update_err;
        header("location: ../views/okulist_edit.php");
        exit;
    }
}


unset($db);
