<?php


class Appointment
{
    private $conn; 
    private $table_name = "appointments"; 


    public $appointment_id;
    public $patient_id;
    public $okulist_id;
    public $appointment_date;
    public $status;
    public $name;
    public $price;
    public $notes;


    public function __construct($db)
    {
        $this->conn = $db; 
    }


    public function cancelByPatient()
    {

        $query = "UPDATE " . $this->table_name . " SET status = 'cancelled_by_patient' WHERE appointment_id = :appointment_id";

        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(":appointment_id", $this->appointment_id); 

     
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function cancelByDentist()
    {

        $query = "UPDATE " . $this->table_name . " SET status = 'cancelled_by_okulist' WHERE appointment_id = :appointment_id";

        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(":appointment_id", $this->appointment_id); 


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    public function create()
    {

        $query = "INSERT INTO " . $this->table_name . " (patient_id, okulist_id, appointment_date, status, name, price) VALUES (:patient_id, :dentist_id, :appointment_date, :status, :name, :price)";

        $stmt = $this->conn->prepare($query); 

   
        $this->patient_id = htmlspecialchars(strip_tags($this->patient_id));
        $this->okulist_id = htmlspecialchars(strip_tags($this->okulist_id));
        $this->appointment_date = htmlspecialchars(strip_tags($this->appointment_date));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));

        $stmt->bindParam(":patient_id", $this->patient_id);
        $stmt->bindParam(":okulist_id", $this->okulist_id);
        $stmt->bindParam(":appointment_date", $this->appointment_date);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);


        if ($stmt->execute()) {
            error_log("Umówiono wizytę: Pacjent ID " . $this->patient_id . ", Nazwa zabiegu: " . $this->name . ", Dentysta ID " . $this->okulist_id . ", Data: " . $this->appointment_date . ", Cena: " . $this->price);
            return true;
        }

        return false;
    }

    public function getFutureAppointments()
    {
        $currentDate = date('Y-m-d H:i:s'); 


        $query = "SELECT * FROM " . $this->table_name . " WHERE appointment_date >= :currentDate ORDER BY appointment_date ASC";

        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(":currentDate", $currentDate); 

        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

 
    public function getPatientAppointments($patient_id)
    {

        $query = "SELECT a.appointment_id, a.appointment_date, a.status, d.first_name, d.last_name 
          FROM appointments a 
          JOIN okulists d ON a.okulist_id = d.okulist_id 
          WHERE a.patient_id = :patient_id
          ORDER BY a.appointment_date ASC";

        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':patient_id', $patient_id); 
        $stmt->execute(); 

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAppointmentsByDentist($okulistId)
    {

        $query = "SELECT a.appointment_id, a.appointment_date, a.status, p.first_name, p.last_name 
          FROM appointments a 
          JOIN patients p ON a.patient_id = p.patient_id 
          WHERE a.dentist_id = :dentistId
          ORDER BY a.appointment_date ASC";
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':dentistId', $okulistId); 
        $stmt->execute(); 

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function changeStatus($appointmentId, $newStatus)
    {

        $sql = "UPDATE appointments SET status = :newStatus WHERE appointment_id = :appointmentId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':newStatus', $newStatus); 
        $stmt->bindParam(':appointmentId', $appointmentId); 
        $stmt->execute(); 

        return $stmt->rowCount() > 0;
    }

    public function updateStatusToCompleted()
    {

        $currentTime = new DateTime();
        $currentTime->modify('-1 hour');
        $formattedCurrentTime = $currentTime->format('Y-m-d H:i:s');

        $sql = "UPDATE appointments 
            SET status = 'completed' 
            WHERE status = 'scheduled' AND appointment_date <= :currentTime";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':currentTime', $formattedCurrentTime, PDO::PARAM_STR); 
        $stmt->execute(); 

        return $stmt->rowCount(); 
    }
}