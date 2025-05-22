<?php

class Dobbelsteen {
    const AANTAL_ZIJDEN = 6;
    private $waarde;

    public function werp() {
        $this->waarde = rand(1, self::AANTAL_ZIJDEN);
    }

    public function getWaarde() {
        return $this->waarde;
    }
}
