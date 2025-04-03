<?php
// index.php
// Zorg ervoor dat classes.php in dezelfde directory staat
require_once 'classes.php';

use HospitalManagement\Patient;
use HospitalManagement\Doctor;
use HospitalManagement\Nurse;
use HospitalManagement\Appointment;

// Voorbeeldobjecten aanmaken

// Maak een Patient-object aan met een initiële balance
$patient1 = new Patient('John', 'Doe', 30, 500.0);

// Maak een Doctor-object aan met een hourlyRate
$doctor1 = new Doctor('Alice', 'Smith', 45, 100.0);

// Maak een Nurse-object aan met een fixedSalary en bonusPerAppointment
$nurse1 = new Nurse('Mary', 'Johnson', 35, 2000.0, 50.0);

// Maak een Appointment-object aan tussen patient en doctor, en koppel optioneel een nurse
$appointment1 = new Appointment('2025-04-03 09:00:00', '2025-04-03 09:30:00', $patient1, $doctor1, $nurse1);

// Update afspraken tellers bij betrokken medewerkers
$doctor1->addAppointment();
$nurse1->addAppointment();

// Bereken het salaris voor Doctor en Nurse
$doctor1->setSalary();
$nurse1->setSalary();

// Toon gegevens via getters
echo 'Patient: ' . $patient1->getFullName() . ' (Balance: ' . $patient1->getBalance() . ')<br>';
echo 'Doctor: ' . $doctor1->getFullName() . ' (Salary: ' . $doctor1->getSalary() . ')<br>';
echo 'Nurse: ' . $nurse1->getFullName() . ' (Salary: ' . $nurse1->getSalary() . ')<br>';
echo 'Appointment Duration: ' . $appointment1->getDuration() . ' seconds<br>';
echo 'Total Appointments: ' . Appointment::getTotalAppointments() . '<br>';

// Voorbeeld: Toon alle afspraken
echo '<h3>All Appointments:</h3>';
foreach (Appointment::getAllAppointments() as $appointment) {
    echo 'Patient: ' . $appointment->getPatient()->getFullName() . ' - Doctor: ' . $appointment->getDoctor()->getFullName() . '<br>';
}
?>
