<?php
class Huis {
    // Properties with proper visibility
    private int $aantalVerdiepingen;
    private int $aantalKamers;
    private float $breedte;
    private float $hoogte;
    private float $diepte;
    private float $volume;
    private const PRIJS_PER_M3 = 1500;

    // Constructor
    public function __construct(int $verdiepingen, int $kamers, float $breedte, float $hoogte, float $diepte) {
        $this->aantalVerdiepingen = $verdiepingen;
        $this->aantalKamers = $kamers;
        $this->breedte = $breedte;
        $this->hoogte = $hoogte;
        $this->diepte = $diepte;
        $this->berekenVolume();
    }

    // Private method to calculate volume
    private function berekenVolume(): void {
        $this->volume = $this->breedte * $this->hoogte * $this->diepte;
    }

    // Method to calculate price
    public function berekenPrijs(): float {
        return $this->volume * self::PRIJS_PER_M3;
    }

    // Method to display house details
    public function toonDetails(): void {
        echo "Huis Details:\n";
        echo "Verdiepingen: {$this->aantalVerdiepingen}\n";
        echo "Kamers: {$this->aantalKamers}\n";
        echo "Breedte: {$this->breedte}m\n";
        echo "Hoogte: {$this->hoogte}m\n";
        echo "Diepte: {$this->diepte}m\n";
        echo "Volume: {$this->volume} m³\n";
        echo "Prijs: €" . number_format($this->berekenPrijs(), 2, ',', '.') . "\n";
        echo "--------------------------\n";
    }
}

// Create 3 house objects
$huis1 = new Huis(2, 5, 8.0, 3.0, 10.0);
$huis2 = new Huis(1, 3, 6.5, 2.8, 8.0);
$huis3 = new Huis(3, 7, 10.0, 3.5, 12.0);

// Print details of each house
$huis1->toonDetails();
echo "<br>";
$huis2->toonDetails();
echo "<br>";
$huis3->toonDetails();
?>
