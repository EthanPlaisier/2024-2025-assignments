<?php
require_once "../vendor/autoload.php";
use Login\classes\User;

//require_once('classes/user.php');
//require_once('config/database.php'); // Zorg ervoor dat je een databaseconfiguratiebestand hebt

session_start();

if(isset($_POST['register-btn'])){
    $user = new User($db);
    $errors = [];

    $user->username = $_POST['username'];
    $user->email = $_POST['email'];
    $user->SetPassword($_POST['password']);
    
    $errors = $user->RegisterUser();
    
    if(count($errors) > 0){
        $message = implode("\n", $errors);
        echo "<script>alert('$message');</script>";
        echo "<script>window.location = 'register_form.php';</script>";
    } else {
        echo "<script>alert('Gebruiker succesvol geregistreerd.');</script>";
        echo "<script>window.location = 'login_form.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <h3>Registratie</h3>
    <hr/>
    <form action="" method="POST">    
        <label>Username</label>
        <input type="text" name="username" required />
        <br>
        <label>Email</label>
        <input type="email" name="email" required />
        <br>
        <label>Password</label>
        <input type="password" name="password" required />
        <br>
        <button type="submit" name="register-btn">Register</button>
        <br>
        <a href="index.php">Home</a>
    </form>
</body>
</html>
