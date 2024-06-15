<?php
require_once '../../config/database.php';
require_once '../models/availability.php';
require_once '../models/appointment.php';


$database = new Database();
$db = $database->getConnection();


$availability = new Availability($db);
$appointments = new Appointment($db);

$availableSlots = $availability->getFutureAvailability();


$bookedAppointments = $appointments->getFutureAppointments();


$filteredAvailability = [];
foreach ($availableSlots as $slot) {
    $startTime = new DateTime($slot['start_time']);
    $endTime = new DateTime($slot['end_time']);


    while ($startTime < $endTime) {
        $sessionEnd = clone $startTime;
        $sessionEnd->add(new DateInterval('PT55M'));

        $nextSessionStart = clone $sessionEnd;
        $nextSessionStart->add(new DateInterval('PT5M')); 


        $isBooked = false;
        foreach ($bookedAppointments as $appointment) {
            $appointmentTime = new DateTime($appointment['appointment_date']);


            if (
                $slot['okulist_id_id'] == $appointment['okulist_id'] &&
                $appointmentTime >= $startTime && $appointmentTime < $sessionEnd &&
                $appointment['status'] === 'scheduled'
            ) {
                $isBooked = true;
                break;
            }
        }


        if (!$isBooked) {
            $filteredAvailability[] = [
                'okulist_id' => $slot['okulist_id_id'],
                'start_time' => $startTime->format('Y-m-d H:i:s'),
                'end_time' => $sessionEnd->format('Y-m-d H:i:s'),
                'name' => $slot['name'],
                'price' => $slot['price'],
                'first_name' => $slot['first_name'],
                'last_name' => $slot['last_name']
            ];
        }

        $startTime = $nextSessionStart; 
    }
}

echo json_encode($filteredAvailability);
