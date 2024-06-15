<?php
session_start();


require_once '../../config/database.php';
require_once '../models/appointment.php';

if (!isset($_SESSION['user_id'])) {

    echo json_encode(["error" => "Nie jesteś zalogowany"]);
    exit;
}


$database = new Database();
$db = $database->getConnection();

$appointment = new Appointment($db);


$patientAppointments = $appointment->getPatientAppointments($_SESSION['user_id']);

echo json_encode($patientAppointments);
