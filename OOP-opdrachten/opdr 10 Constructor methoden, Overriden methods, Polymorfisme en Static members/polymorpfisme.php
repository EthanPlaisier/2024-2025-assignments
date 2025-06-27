<?php
// Hergebruik klasse-definities uit opdracht 2

$vervoermiddelen = [
    new Fiets(),
    new Trein(),
    new Vliegtuig()
];

foreach ($vervoermiddelen as $voertuig) {
    $voertuig->geluid();
}
?>
