<?php
namespace SchoolTrip;

class Student extends Participant {
    // Private eigenschappen: of de student betaald heeft en het bedrag dat hij/zij heeft betaald.
    private $hasPaid;
    private $amount;

    public function __construct($name, $className, $hasPaid = false, $amount = 0) {
        parent::__construct($name, $className);
        $this->hasPaid = $hasPaid;
        $this->amount = $amount;
    }

    // Getter en setter voor betaald hebben
    public function getHasPaid() {
        return $this->hasPaid;
    }
    public function setHasPaid($hasPaid) {
        $this->hasPaid = $hasPaid;
    }

    // Getter en setter voor het bedrag
    public function getAmount() {
        return $this->amount;
    }
    public function setAmount($amount) {
        $this->amount = $amount;
    }

    // Retourneer het bedrag als er betaald is, anders 0
    public function getPaymentAmount() {
        return $this->hasPaid ? $this->amount : 0;
    }
}
?>
