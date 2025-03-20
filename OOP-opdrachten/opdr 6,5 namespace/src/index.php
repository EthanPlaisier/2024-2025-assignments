<?php
    // Functie: programma login OOP 
    // Auteur: Ethan

    // Initialisatie
?>

<!DOCTYPE html>

<html lang="en">

<body>

	<h3>PDO Login and Registration</h3>
	<hr/>

	<h3>Welcome op de HOME-pagina!</h3>
	<br />
	<?php

	require_once "../vendor/autoload.php";
	use Login\classes\User;
	use Login\classes\Database;

	//include 'classes/user.php'; 
	//include 'config/database.php'; 
	$database = new Database();
	$db = $database->getConnection();

    $user = new User($db);

	// Activeer de session
	//session_start();

	// Indien Logout geklikt
	if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
		$user->Logout();
	}

	// Check login session: staat de user in de session?
	if(!$user->IsLoggedin()){
		// Alert not login
		echo "U bent niet ingelogd. Login in om verder te gaan.<br><br>";
		// Toon login button
		echo '<a href = "login_form.php">Login</a>';
	} else {
		
		// select userdata from database
		$user->GetUser();

		
		// Print userdata
		echo "<h2>Het spel kan beginnen</h2>";
		echo "Je bent ingelogd met:<br/>";
		$user->ShowUser();
		echo "<br><br>";
		echo '<a href = "?logout=true">Logout</a>';
	}
	
	?>

</body>
</html>