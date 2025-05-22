<?php

session_start();

require_once 'DobbelSpel.php';

if (!isset($_SESSION['spel'])) {
    $_SESSION['spel'] = serialize(new DobbelSpel());
}

if (is_string($_SESSION['spel'])) {
    $spel = unserialize($_SESSION['spel']);
} else {
    $spel = new DobbelSpel();
    $_SESSION['spel'] = serialize($spel);
}

// Controleer of er een POST-verzoek is gedaan (door het formulier).
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Controleer of de gebruiker een nieuw spel wil starten.
    if (isset($_POST['nieuwSpel'])) {
        // Haal het aantal spelers op uit het formulier (standaard 1 speler).
        $aantalSpelers = $_POST['aantalSpelers'] ?? 1;

        // Maak een nieuw DobbelSpel-object aan.
        $spel = new DobbelSpel();

        // Voeg het opgegeven aantal spelers toe aan het spel.
        for ($i = 0; $i < $aantalSpelers; $i++) {
            $spel->voegSpelerToe(new Speler());
        }

        // Sla het nieuwe spelobject op in de sessie.
        $_SESSION['spel'] = serialize($spel);
    }
    // Controleer of de gebruiker de dobbelstenen wil werpen.
    elseif (isset($_POST['werp'])) {
        // Roep de werp-methode aan om de dobbelstenen te gooien.
        $spel->werp();

        // Sla het bijgewerkte spelobject op in de sessie.
        $_SESSION['spel'] = serialize($spel);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DobbelSpel</title>
</head>
<body>

<!-- Formulier om een nieuw spel te starten -->
<form method="post">
    <!-- Selecteer het aantal spelers voor het nieuwe spel -->
    <select name="aantalSpelers">
        <option value="1">1 Speler</option>
        <option value="2">2 Spelers</option>
    </select>
    <!-- Knop om een nieuw spel te starten -->
    <button type="submit" name="nieuwSpel">Nieuw Spel</button>
</form>

<!-- Formulier om de dobbelstenen te werpen -->
<form method="post">
    <!-- Knop om de dobbelstenen te werpen -->
    <button type="submit" name="werp">Werp</button>
</form>

<?php
// Toon de worpen van de spelers.
$spel->toonSpelersWorpen();

// Toon de scores van de spelers.
$spel->toonScores();
?>

</body>
</html>