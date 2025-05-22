<?php
require_once 'Dobbelsteen.php';

class Speler {
    private $dobbelstenen = [];
    private $worpen = [];
    private $aantalWorpen = 0;

    public function __construct() {
        for ($i = 0; $i < 5; $i++) {
            $this->dobbelstenen[] = new Dobbelsteen();
        }
    }

    public function werpDobbelstenen() {
        $huidigeWorp = [];
        foreach ($this->dobbelstenen as $dobbelsteen) {
            $dobbelsteen->werp();
            $huidigeWorp[] = $dobbelsteen->getWaarde();
        }
        $this->worpen[] = $huidigeWorp;
        $this->aantalWorpen++;
    }

    public function getTotaalScore() {
        $score = 0;
        foreach ($this->worpen as $worp) {
            $score += array_sum($worp);
        }
        return $score;
    }

    public function getAantalWorpen() {
        return $this->aantalWorpen;
    }

    public function genereerSvgVoorWorpen() {
        if (empty($this->worpen)) return "Nog niet geworpen.";

        $laatsteWorp = end($this->worpen);
        $kleur = $this->heeftGelijkeOgen($laatsteWorp) ? 'red' : 'black';

        $svg = "<svg width='320' height='60'>";
        foreach ($laatsteWorp as $i => $waarde) {
            $x = 10 + $i * 60;
            $svg .= "<rect x='$x' y='10' width='50' height='50' fill='lightgray' stroke='$kleur' stroke-width='3'/>
                     <text x='".($x + 25)."' y='45' font-size='20' text-anchor='middle' fill='black'>$waarde</text>";
        }
        $svg .= "</svg>";

        if ($this->alleVijfGelijk($laatsteWorp)) {
            $svg .= "<p><strong>🎲 Yahtzee! Alle dobbelstenen tonen {$laatsteWorp[0]}!</strong></p>";
        }

        return $svg;
    }

    private function heeftGelijkeOgen($worp) {
        return count(array_unique($worp)) == 1;
    }

    private function alleVijfGelijk($worp) {
        return $this->heeftGelijkeOgen($worp);
    }
}
