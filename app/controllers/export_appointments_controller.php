<?php
session_start();

require_once '../../config/database.php';
require_once '../models/appointment.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'okulist') {
    header("location: ../views/okulist_login.php"); 
    exit;
}

$database = new Database();
$db = $database->getConnection();
$appointments = new Appointment($db);

$data = $appointments->getAppointmentsByOKulist($_SESSION['user_id']);


header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="wizyty.csv"');


$output = fopen('php://output', 'w');


fputcsv($output, array('ID wizyty', 'Data i czas', 'Status', 'Imię', 'Nazwisko'));

array_walk($data, "fput");


fclose($output);
exit; 


function fput($row){

    $output = fopen('php://output', 'w');
    fputcsv($output, $row);
}
