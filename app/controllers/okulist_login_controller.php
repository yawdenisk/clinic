<?php
error_log("Formularz logowania został wysłany."); 
error_log("Email: " . $_POST['email']); 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


require_once '../../config/database.php';
require_once '../models/okulist.php';


$database = new Database();
$db = $database->getConnection();


$email = $password = "";
$email_err = $password_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["email"]))) {
        $email_err = "Proszę podać email.";
    } else {
        $email = trim($_POST["email"]);
    }


    if (empty(trim($_POST["password"]))) {
        $password_err = "Proszę podać hasło.";
    } else {
        $password = trim($_POST["password"]);
    }


    if (empty($email_err) && empty($password_err)) {
        $user = new Okulist($db);

        if ($user->login($email, $password)) {

            if ($_SESSION["role"] == 'okulist') {
                header("location: ../views/okulist_panel.php");
                exit;
            } elseif ($_SESSION["role"] == 'administrator') {
                header("location: ../views/admin_panel.php");
                exit;
            } else {

            }
        } else {
            $_SESSION['login_err'] = "Niepoprawny email lub hasło.";
            header("location: ../views/okulist_login.php");
            exit;
        }
    } else {

        $_SESSION['email_err'] = $email_err;
        $_SESSION['password_err'] = $password_err;
        header("location: ../views/okulist_login.php");
        exit;
    }
    unset($db);
}
