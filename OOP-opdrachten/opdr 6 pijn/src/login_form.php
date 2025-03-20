<?php
require_once "../vendor/autoload.php";
use Login\classes\User;

//require_once('classes/user.php');
//require_once('config/database.php'); // Zorg voor een correcte databaseverbinding

session_start();

if(isset($_POST['login-btn'])){
    $user = new User($db);
    $errors = [];
    
    $user->username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validatie
    if(empty($user->username) || empty($password)){
        array_push($errors, "Gebruikersnaam en wachtwoord zijn verplicht.");
    }
    
    if(count($errors) == 0){
        if ($user->LoginUser()){
            header("Location: index.php");
            exit();
        } else {
            array_push($errors, "Ongeldige inloggegevens.");
        }
    }
    
    if(count($errors) > 0){
        $message = implode("\n", $errors);
        echo "<script>alert('$message');</script>";
        echo "<script>window.location = 'login_form.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <h3>Login</h3>
    <hr/>
    <form action="" method="POST">
        <label>Username</label>
        <input type="text" name="username" required />
        <br>
        <label>Password</label>
        <input type="password" name="password" required />
        <br>
        <button type="submit" name="login-btn">Login</button>
        <br>
        <a href="register_form.php">Registreren</a>
    </form>
</body>
</html>
