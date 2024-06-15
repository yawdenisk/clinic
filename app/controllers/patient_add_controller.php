<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../config/database.php';
require_once '../models/patient.php';

$database = new Database();
$db = $database->getConnection();
$patient = new Patient($db);


$first_name = $last_name = $email = $password = "";
$first_name_err = $last_name_err = $email_err = $password_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty(trim($_POST["first_name"]))) {
        $first_name_err = "Proszę podać imię.";
    } else {
        $first_name = trim($_POST["first_name"]);
    }


    if (empty(trim($_POST["last_name"]))) {
        $last_name_err = "Proszę podać nazwisko.";
    } else {
        $last_name = trim($_POST["last_name"]);
    }


    if (empty(trim($_POST["email"]))) {
        $email_err = "Proszę podać adres email.";
    } elseif ($patient->isEmailExists(trim($_POST["email"]))) { 
        $email_err = "Ten adres email jest już zajęty.";
    } elseif ($patient->validateEmail(trim($_POST["email"])) == false) { 
        $email_err = "Ten adres email ma niepoprawną formę.";
    } else $email = trim($_POST["email"]);


    if (empty(trim($_POST["password"]))) {
        $password_err = "Proszę wpisać hasło.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Hasło musi zawierać co najmniej 6 znaków.";
    } else {
        $password = trim($_POST["password"]);
    }


    if (empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($password_err)) {

        if ($patient->addNewPatient($first_name, $last_name, $email, $password)) {
    
            header("Location: ../views/patient_login.php");
            exit();
        } else {
            echo "Coś poszło nie tak. Proszę spróbować później.";
        }
    }
}


$viewData = [
    'first_name' => $first_name,
    'first_name_err' => $first_name_err,
    'last_name' => $last_name,
    'last_name_err' => $last_name_err,
    'email' => $email,
    'email_err' => $email_err,
    'password_err' => $password_err,
];


require_once '../views/patient_register.php';
