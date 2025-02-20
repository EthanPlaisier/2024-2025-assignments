<?php
// Functie: Programma webshop Fruit 
// Auteur: Ethan 

// Initialisatie
include_once "Fruit.php";

// Main

// maak object banaan van classdefinitie Fruit
$banaan = new Fruit();
$banaan->naam = "Banaan";
$banaan->setPrijs(2.0);
// maak tweede object appel van classdefinitie Fruit
$appel = new Fruit();
$appel->naam = "Elstar";
$appel->setPrijs(3.5);

var_dump($banaan);
echo "<br>";
var_dump($appel);

?>