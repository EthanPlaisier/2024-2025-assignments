<?php
class Auto {
    private string $merk;
    private int $bouwjaar;

    public function __construct(string $merk, int $bouwjaar) {
        $this->merk = $merk;
        $this->bouwjaar = $bouwjaar;
    }

    public function toonAuto(): void {
        echo "Merk: {$this->merk}, Bouwjaar: {$this->bouwjaar}<br>";
    }
}

// Test
$auto1 = new Auto("Toyota", 2020);
$auto1->toonAuto();
?>
