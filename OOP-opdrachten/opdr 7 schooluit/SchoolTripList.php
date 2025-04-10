<?php
namespace SchoolTrip;

class SchoolTripList {
    // Array waarin de studenten die mee willen, worden opgeslagen
    private $students = [];
    // Array om de totale aantallen leerlingen per klas (voor deelnamepercentage) bij te houden
    private $classTotals = [];

    // Registreer het totale aantal leerlingen in een klas
    public function addClassTotal($className, $totalStudents) {
        $this->classTotals[$className] = $totalStudents;
    }

    // Voeg een student toe aan de lijst
    public function addStudent(Student $student) {
        $this->students[] = $student;
    }

    // Retourneer de lijst met studenten
    public function getStudents() {
        return $this->students;
    }

    // Berekent het totaal ingezamelde bedrag over alle studenten
    public function getTotalCollected() {
        $total = 0;
        foreach ($this->students as $student) {
            $total += $student->getPaymentAmount();
        }
        return $total;
    }

    // Berekent het ingezamelde bedrag per klas
    public function getCollectedPerClass() {
        $collected = [];
        foreach ($this->students as $student) {
            $class = $student->getClassName();
            if (!isset($collected[$class])) {
                $collected[$class] = 0;
            }
            $collected[$class] += $student->getPaymentAmount();
        }
        return $collected;
    }

    // Berekent per klas het percentage van leerlingen dat mee wil (aangezien niet alle leerlingen meegaan)
    public function getParticipationPercentage() {
        $participation = [];
        $counts = [];
        // Tellen hoeveel leerlingen er per klas aangemeld zijn
        foreach ($this->students as $student) {
            $class = $student->getClassName();
            if (!isset($counts[$class])) {
                $counts[$class] = 0;
            }
            $counts[$class]++;
        }
        // Vergelijk met de totale klasgrootte
        foreach ($counts as $class => $count) {
            if (isset($this->classTotals[$class]) && $this->classTotals[$class] > 0) {
                $participation[$class] = ($count / $this->classTotals[$class]) * 100;
            } else {
                $participation[$class] = 0;
            }
        }
        return $participation;
    }

    // Genereert de finale lijst: na elke 5 betalende studenten komt er een docent.
    public function generateFinalList() {
        $finalList = [];
        $payingStudents = [];
        // Filter alleen de studenten die betaald hebben (docenten tellen niet mee voor percentages)
        foreach ($this->students as $student) {
            if ($student->getHasPaid()) {
                $payingStudents[] = $student;
            }
        }
        $counter = 0;
        foreach ($payingStudents as $student) {
            $finalList[] = $student;
            $counter++;
            // Na elke vijfde betalende student voegen we een docent toe.
            if ($counter % 5 == 0) {
                $teacher = new Teacher("Docent " . ($counter / 5));
                $finalList[] = $teacher;
            }
        }
        return $finalList;
    }
}
?>
