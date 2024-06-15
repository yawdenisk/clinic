<?php
require_once 'user.php';
require_once 'OkulistInterface.php';
require_once 'OkulistTrait.php';

class Okulist extends User implements Okulistinterface
{
    use OkulistTrait;
    private $db; 
    private $table_name = "okulists"; 


    public $okulist_id;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $specialization;
    public $role;


    public function __construct($db)
    {
        $this->db = $db;
    }
    
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
              SET first_name=:first_name, last_name=:last_name, email=:email, password=:password, specialization=:specialization";

 
        $stmt = $this->db->prepare($query);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->specialization = htmlspecialchars(strip_tags($this->specialization));


        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":specialization", $this->specialization);


        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    public function login($email, $password)
    {

        $query = "SELECT okulist_id, first_name, last_name, email, password, role FROM " . $this->table_name . " WHERE email = :email";

        $stmt = $this->db->prepare($query); 
        $email = htmlspecialchars(strip_tags($email));
        $stmt->bindParam(':email', $email); 

        $stmt->execute(); 

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);


            $okulist_id = $row['okulist_id'];
            $hashed_password = $row['password'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $role = $row['role'];


            if (password_verify($password, $hashed_password)) {

                $_SESSION["loggedin"] = true;
                $_SESSION["user_id"] = $okulist_id;
                $_SESSION["email"] = $email;
                $_SESSION["first_name"] = $first_name;
                $_SESSION["last_name"] = $last_name;
                $_SESSION["role"] = $role;

                return true;
            } else {
                return false; 
            }
        } else {
            return false; 
        }
    }


    public function getOkulistById($okulist_id)
    {

        $query = "SELECT * FROM okulists WHERE okulist_id = :okulist_id";

        $stmt = $this->db->prepare($query); 
        $stmt->bindParam(':okulist_id', $okulist_id); 
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        } else {
            return false; 
        }
    }


    public function readAll()
    {

        $query = "SELECT okulist_id, first_name, last_name, email, role, specialization FROM " . $this->table_name . " ORDER BY last_name, first_name";

        $stmt = $this->db->prepare($query);

        $stmt->execute();

        return $stmt;
    }


    public function updateProfile($okulistId, $firstName, $lastName, $email, $specialization)
    {

        if ($this->isEmailUsedByAnotherOkulist($okulistId, $email)) {
            return false; 
        }

        $query = "UPDATE " . $this->table_name . " 
          SET first_name = :first_name, 
              last_name = :last_name, 
              email = :email,
              specialization = :specialization
          WHERE okulis_id = :okulist_id";


        $stmt = $this->db->prepare($query);

        $firstName = htmlspecialchars(strip_tags($firstName));
        $lastName = htmlspecialchars(strip_tags($lastName));
        $email = htmlspecialchars(strip_tags($email));

        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':specialization', $specialization);
        $stmt->bindParam(':okulist_id', $okulistId);


        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }



    // Funkcja, która usuwa dentystę z bazy danych
    public function delete($okulistId)
    {
        // Zapytanie SQL do usunięcia dentysty
        $query = "DELETE FROM " . $this->table_name . " WHERE okulist_id = :okulist_id";

        // Przygotowanie zapytania
        $stmt = $this->db->prepare($query);

        // Oczyszczenie i bindowanie danych
        $this->okulist_id = htmlspecialchars(strip_tags($okulistId));
        $stmt->bindParam(
            ':okulist_id',
            $this->okulist_id
        );

        // Wykonanie zapytania
        if ($stmt->execute()) {
            return true; // Powodzenie aktualizacji
        }
        return false; // Niepowodzenie aktualizacji
    }

    // Funkcja sprawdzająca czy dany dentysta ma rolę administrator
    public function isAdministrator($okulist_id)
    {
        $query = "SELECT role FROM " . $this->table_name . " WHERE okulist_id = :okulist_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':okulist_id', $okulist_id);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['role'] === 'administrator') {
                return true;
            }
        }
        return false;
    }

    // Funkcja sprawdzająca czy podany email istnieje w bazie danych
    public function isEmailExists($email)
    {
        // Zapytanie SQL do sprawdzenia, czy email istnieje
        $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE email = :email";
        // Przygotowanie zapytania
        $stmt = $this->db->prepare($query);

        // Oczyszczenie i bindowanie danych
        $stmt->bindParam(":email", $email);
        $stmt->execute(); // Wykonanie zapytania

        // Pobranie liczby wierszy
        if ($stmt->fetchColumn() > 0) {
            return true; // Email już istnieje
        } else {
            return false; // Email nie istnieje
        }
    }

    // Funkcja sprawdzająca czy podany email jest używany przez innego dentystę
    public function isEmailUsedByAnotherOkulist($okulistId, $email)
    {
        // Zapytanie SQL do sprawdzenia, czy email jest używany przez innego dentystę
        $query = "SELECT COUNT(*) FROM " . $this->table_name . " 
                  WHERE email = :email AND okulist_id != :okulist_id";

        // Przygotowanie zapytania
        $stmt = $this->db->prepare($query);
        // Oczyszczenie i bindowanie danych
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':okulist_id', $okulistId);

        // Wykonanie zapytania
        $stmt->execute();
        // Pobranie liczby wierszy
        $count = $stmt->fetchColumn();

        // Jeśli liczba wierszy jest większa od 0, to znaczy, że email jest używany przez innego dentystę
        return $count > 0;
    }

    // Add the method to send a message
    public function sendMessage($conversationId, $message)
    {
        $query = "INSERT INTO messages (conversation_id, sender_id, sender_role, message_text) VALUES (:conversation_id, :sender_id, 'doctor', :message_text)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':conversation_id', $conversationId);
        $stmt->bindParam(':sender_id', $_SESSION['user_id']);
        $stmt->bindParam(':message_text', $message);
        return $stmt->execute();
    }

    // Add the method to get messages
    public function getMessages($conversationId) {
        $query = "SELECT * FROM messages WHERE conversation_id = :conversationId ORDER BY created_at ASC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':conversationId', $conversationId);
        $stmt->execute();
    
        $messages = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $messages[] = $row;
        }
        return $messages;
    }
    
    
}
