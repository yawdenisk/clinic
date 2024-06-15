<?php

class Availability
{
    private $conn; 
    private $table_name = "availability"; 


    public $availability_id;
    public $okulist_id;
    public $start_time;
    public $end_time;
    public $name;
    public $price;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (okulist_id, start_time, end_time, name, price) VALUES (:okulist_id, :start_time, :end_time, :name, :price)";

        $stmt = $this->conn->prepare($query); 


        $this->okulist_id = htmlspecialchars(strip_tags($this->okulist_id));
        $this->start_time = htmlspecialchars(strip_tags($this->start_time));
        $this->end_time = htmlspecialchars(strip_tags($this->end_time));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = strip_tags($this->price);


        $stmt->bindParam(':okulist_id', $this->okulist_id);
        $stmt->bindParam(':start_time', $this->start_time);
        $stmt->bindParam(':end_time', $this->end_time);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);

        if ($stmt->execute()) {
            error_log("Nowa dostępność została dodana: Dentysta ID " . $this->okulist_id . ", Nazwa zabiegu: " . $this->name . ", Czas rozpoczęcia: " . $this->start_time . ", Czas zakończenia: " . $this->end_time . ", Cena: " . $this->price);
            return true;
        }

        return false;
    }


    public function update()
    {
    
        $query = "UPDATE " . $this->table_name . " SET start_time = :start_time, end_time = :end_time WHERE availability_id = :availability_id";

        $stmt = $this->conn->prepare($query);  


        $this->availability_id = htmlspecialchars(strip_tags($this->availability_id));
        $this->start_time = htmlspecialchars(strip_tags($this->start_time));
        $this->end_time = htmlspecialchars(strip_tags($this->end_time));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = strip_tags($this->price);


        $stmt->bindParam(':availability_id', $this->availability_id);
        $stmt->bindParam(':start_time', $this->start_time);
        $stmt->bindParam(':end_time', $this->end_time);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);

    
        if ($stmt->execute()) {
            error_log("Dostępność została zaktualizowana: OkulistaID " . $this->okulist_id . ", Nazwa zabiegu: " . $this->name . ", Czas rozpoczęcia: " . $this->start_time . ", Czas zakończenia: " . $this->end_time . ", Cena: " . $this->price);
            return true;
        }

        return false;
    }

 
    public function getAllAvailability($okulist_id)
    {

        $currentDateTime = date('Y-m-d H:i:s');


        $query = "SELECT * FROM " . $this->table_name . " WHERE okulist_id = :okulist_id AND end_time >= :currentDateTime ORDER BY start_time ASC";

        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':okulist_id', $okulist_id); 
        $stmt->bindParam(':currentDateTime', $currentDateTime);
        $stmt->execute(); 

        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }


    public function getFutureAvailability()
    {

        $currentDate = date('Y-m-d H:i:s');

 
        $query = "SELECT a.availability_id, a.okulist_id, a.name, a.price, a.start_time, a.end_time, d.first_name, d.last_name
          FROM " . $this->table_name . " a 
          JOIN okulists d ON a.okulist_id = d.okulist_id 
          WHERE a.start_time > :currentDate 
          ORDER BY a.start_time ASC";

        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':currentDate', $currentDate); 
        $stmt->execute(); 

        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }


    public function delete()
    {

        $query = "DELETE FROM " . $this->table_name . " WHERE availability_id = :availability_id";

        $stmt = $this->conn->prepare($query); 

  
        $this->availability_id = htmlspecialchars(strip_tags($this->availability_id));
        $stmt->bindParam(':availability_id', $this->availability_id); 

  
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


}
