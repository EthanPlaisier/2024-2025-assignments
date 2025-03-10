<?php
// Functie: classdefinitie User 
// Auteur: Wigmans

class User{
    // Eigenschappen 
    public $username;
    public $email;
    public $role;
    private $password;
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    function SetPassword($password){
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }
    
    function GetPassword(){
        return $this->password;
    }
    
    public function ShowUser() {
        echo "<br>Username: $this->username<br>";
        echo "<br>Email: $this->email<br>";
        echo "<br>Role: $this->role<br>";
    }
    
    public function RegisterUser(){
        $errors = [];
        if(empty($this->username) || empty($this->password)){
            array_push($errors, "Username en wachtwoord zijn verplicht.");
            return $errors;
        }

        // Check of gebruiker al bestaat
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$this->username]);
        if($stmt->rowCount() > 0){
            array_push($errors, "Username bestaat al.");
            return $errors;
        }
        
        // Gebruiker opslaan in database
        $stmt = $this->db->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->username, $this->password, $this->email, 'user']);
        
        return $errors;
    }
    
    public function ValidateUser(){
        $errors = [];
        if(empty($this->username)){
            array_push($errors, "Invalid username");
        }
        if(empty($this->password)){
            array_push($errors, "Invalid password");
        }
        return $errors;
    }
    
    public function LoginUser(){
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$this->username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($user && password_verify($_POST['password'], $user['password'])){
            session_start();
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }
    
    public function IsLoggedin() {
        session_start();
        return isset($_SESSION['user']);
    }
    
    public function GetUser(){
        if (!isset($_SESSION['user']['username'])) {
            return false; // Stop als er geen ingelogde gebruiker is
        }
    
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$_SESSION['user']['username']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            $this->username = $user['username'];
            $this->email = $user['email'];
            $this->role = $user['role'];
        }
    }
    
    public function Logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Verwijder alle sessievariabelen
        $_SESSION = array();
    
        // Vernietig de sessie
        session_destroy();
    
        // Redirect naar de index
        header('Location: index.php');
        exit();
    }
    
}
?>
