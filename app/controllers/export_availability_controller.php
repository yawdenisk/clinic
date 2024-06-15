<?php
session_start();


require_once '../../config/database.php';
require_once '../models/availability.php';


if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'okulist') {
    header("location: ../views/okulist_login.php"); 
    exit;
}


$database = new Database();
$db = $database->getConnection();
$availability = new Availability($db);


$data = $availability->getAllAvailability($_SESSION['user_id']);


header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="dostepnosc.csv"');

$output = fopen('php://output', 'w');

fputcsv($output, array('ID Dostępności', 'Okulista ID', 'Czas Rozpoczęcia', 'Czas Zakończenia', 'Cena', 'Nazwa'));


array_walk($data, "fput");


fclose($output);
exit; 

function fput($row){

    $output = fopen('php://output', 'w');
    fputcsv($output, $row); 
}