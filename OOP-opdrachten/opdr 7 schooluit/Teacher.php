<?php
namespace SchoolTrip;

class Teacher extends Participant {
    // De Teacher heeft geen aanvullende eigenschappen, de klasnaam staat hier standaard op "Docent"
    public function __construct($name, $className = 'Docent') {
        parent::__construct($name, $className);
    }

    // Een docent betaalt niet mee, dus altijd 0
    public function getPaymentAmount() {
        return 0;
    }
}
?>
