<?php
namespace SchoolTrip;

abstract class Participant {
    // Beschermde eigenschappen voor naam en klas
    protected $name;
    protected $className;

    public function __construct($name, $className) {
        $this->name = $name;
        $this->className = $className;
    }

    // Getter voor naam
    public function getName() {
        return $this->name;
    }

    // Getter voor klas
    public function getClassName() {
        return $this->className;
    }

    // Abstracte methode waarmee elke deelnemer zijn betalingsbedrag moet kunnen retourneren
    abstract public function getPaymentAmount();
}
?>
