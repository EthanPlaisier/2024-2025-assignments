<?php
namespace HospitalManagement;

abstract class Person {
    private string $firstName;
    private string $lastName;
    private int $age;
    
    public function __construct(string $firstName, string $lastName, int $age) {
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->age       = $age;
    }
    
    // Setters
    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }
    
    public function setLastName(string $lastName): void {
        $this->lastName = $lastName;
    }
    
    public function setAge(int $age): void {
        $this->age = $age;
    }
    
    // Getters
    public function getFirstName(): string {
        return $this->firstName;
    }
    
    public function getLastName(): string {
        return $this->lastName;
    }
    
    public function getFullName(): string {
        return $this->firstName . ' ' . $this->lastName;
    }
    
    public function getAge(): int {
        return $this->age;
    }
    
    abstract public function getRole(): string;
}

class Patient extends Person {
    private float $balance;
    
    public function __construct(string $firstName, string $lastName, int $age, float $balance) {
        parent::__construct($firstName, $lastName, $age);
        $this->balance = $balance;
    }
    
    public function getRole(): string {
        return "Patient";
    }
    
    
    public function setBalance(float $balance): void {
        $this->balance = $balance;
    }
    
    public function getBalance(): float {
        return $this->balance;
    }
    
    public function pay(float $amount): void {
        $this->balance -= $amount;
    }
}

abstract class Staff extends Person {
    protected float $salary;
    
    public function __construct(string $firstName, string $lastName, int $age, float $salary = 0) {
        parent::__construct($firstName, $lastName, $age);
        $this->salary = $salary;
    }
    
    
    public function getSalary(): float {
        return $this->salary;
    }
    
    
    
    abstract public function setSalary(): void;
}

class Doctor extends Staff {
    private float $hourlyRate;
    private int $appointmentsCount;
    
    public function __construct(string $firstName, string $lastName, int $age, float $hourlyRate) {
        parent::__construct($firstName, $lastName, $age, 0);
        $this->hourlyRate = $hourlyRate;
        $this->appointmentsCount = 0;
    }
    
    public function getRole(): string {
        return "Doctor";
    }
    
    public function addAppointment(): void {
        $this->appointmentsCount++;
    }
    
    
    public function setSalary(): void {
        $this->salary = $this->appointmentsCount * $this->hourlyRate;
    }
    
    public function getHourlyRate(): float {
        return $this->hourlyRate;
    }
    
    public function getAppointmentsCount(): int {
        return $this->appointmentsCount;
    }
}

class Nurse extends Staff {
    private float $fixedSalary;
    private float $bonusPerAppointment;
    private int $appointmentsCount;
    
    public function __construct(string $firstName, string $lastName, int $age, float $fixedSalary, float $bonusPerAppointment) {
        parent::__construct($firstName, $lastName, $age, $fixedSalary);
        $this->fixedSalary = $fixedSalary;
        $this->bonusPerAppointment = $bonusPerAppointment;
        $this->appointmentsCount = 0;
    }
    
    public function getRole(): string {
        return "Nurse";
    }
    
    public function addAppointment(): void {
        $this->appointmentsCount++;
    }
    
    
    public function setSalary(): void {
        $this->salary = $this->fixedSalary + ($this->appointmentsCount * $this->bonusPerAppointment);
    }
    
    public function getBonusPerAppointment(): float {
        return $this->bonusPerAppointment;
    }
    
    public function getAppointmentsCount(): int {
        return $this->appointmentsCount;
    }
}

class Appointment {
    private static array $appointments = [];
    private string $startTime;
    private string $endTime;
    private Patient $patient;
    private Doctor $doctor;
    private ?Nurse $nurse;
    
    public function __construct(string $startTime, string $endTime, Patient $patient, Doctor $doctor, ?Nurse $nurse = null) {
        $this->startTime = $startTime;
        $this->endTime   = $endTime;
        $this->patient   = $patient;
        $this->doctor    = $doctor;
        $this->nurse     = $nurse;
    }
    
    private static function addAppointment(Appointment $appointment): void {
        self::$appointments[] = $appointment;
    }
    
    public static function getAllAppointments(): array {
        return self::$appointments;
    }
    
    public static function getTotalAppointments(): int {
        return count(self::$appointments);
    }
    
    
    public function getDuration(): int {
        return strtotime($this->endTime) - strtotime($this->startTime);
    }
    
    
    public function getPatient(): Patient {
        return $this->patient;
    }
    public function getDoctor(): Doctor {
        return $this->doctor;
    }
    public function getNurse(): ?Nurse {
        return $this->nurse;
    }
}
?>
