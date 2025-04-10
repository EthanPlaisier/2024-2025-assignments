<?php
require_once 'Participant.php';
require_once 'Student.php';
require_once 'Teacher.php';
require_once 'SchoolTripList.php';

use SchoolTrip\Student;
use SchoolTrip\Teacher;
use SchoolTrip\SchoolTripList;

// Maak een instantie van SchoolTripList
$schoolTrip = new SchoolTripList();

// Stel de totale klasgroottes in (om percentages te berekenen)
$schoolTrip->addClassTotal("Klas A", 30);
$schoolTrip->addClassTotal("Klas B", 25);

// Voeg studenten toe aan de lijst voor "Klas A"
$schoolTrip->addStudent(new Student("Alice", "Klas A", true, 10));
$schoolTrip->addStudent(new Student("Bob", "Klas A", false, 0));
$schoolTrip->addStudent(new Student("Charlie", "Klas A", true, 10));
$schoolTrip->addStudent(new Student("David", "Klas A", true, 10));
$schoolTrip->addStudent(new Student("Eva", "Klas A", true, 10));
$schoolTrip->addStudent(new Student("Frank", "Klas A", true, 10));
$schoolTrip->addStudent(new Student("Grace", "Klas A", false, 0));

// Voeg studenten toe aan de lijst voor "Klas B"
$schoolTrip->addStudent(new Student("Hugo", "Klas B", true, 10));
$schoolTrip->addStudent(new Student("Irene", "Klas B", true, 10));
$schoolTrip->addStudent(new Student("Jack", "Klas B", false, 0));

// Toon het totale ingezamelde bedrag
echo "Totale bedrag ingezameld: " . $schoolTrip->getTotalCollected() . " euro.\n";

// Toon per klas het ingezamelde bedrag
$collectedPerClass = $schoolTrip->getCollectedPerClass();
foreach ($collectedPerClass as $class => $amount) {
    echo "Klas {$class}: ingezameld bedrag: {$amount} euro.\n";
}

// Toon per klas het deelnamepercentage (aantal aangemelde studenten ten op zichte van de totale klasgrootte)
$participation = $schoolTrip->getParticipationPercentage();
foreach ($participation as $class => $percentage) {
    echo "Klas {$class}: deelname: " . round($percentage, 2) . "%.\n";
}

echo "\nFinale lijst (per 5 betalende leerlingen komt een docent):\n";
// Genereer de finale lijst
$finalList = $schoolTrip->generateFinalList();
foreach ($finalList as $participant) {
    if ($participant instanceof Teacher) {
        echo $participant->getName() . " (Docent)\n";
    } else {
        echo $participant->getName() . " - " . $participant->getClassName() . " - " . ($participant->getHasPaid() ? "Betaald" : "Niet betaald") . "\n";
    }
}
?>
