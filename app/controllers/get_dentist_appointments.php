<?php
session_start();


require_once '../../config/database.php';
require_once '../models/appointment.php';


if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'okulist_id') {
    echo json_encode(["error" => "Nie masz uprawnień"]);
    exit;
}


$database = new Database();
$db = $database->getConnection();

$appointment = new Appointment($db);


$okulistAppointments = $appointment->getAppointmentsByOkulist($_SESSION['user_id']);

echo json_encode($okulistAppointments);
