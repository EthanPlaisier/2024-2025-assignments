<?php
require_once 'Speler.php';

class DobbelSpel {
    private $spelers = [];
    private $huidigeSpelerIndex = 0;
    private $huidigeRonde = 1;

    public function voegSpelerToe($speler) {
        $this->spelers[] = $speler;
    }

    public function werp() {
        if (count($this->spelers) > 0 && $this->huidigeRonde <= 3) {
            $this->spelers[$this->huidigeSpelerIndex]->werpDobbelstenen();

            $this->huidigeSpelerIndex = ($this->huidigeSpelerIndex + 1) % count($this->spelers);

            if ($this->huidigeSpelerIndex == 0) {
                $this->huidigeRonde++;
                if ($this->huidigeRonde > 3) {
                    $this->bepaalWinnaar();
                }
            }
        }
    }

    private function bepaalWinnaar() {
        $winnaarIndex = 0;
        $hoogsteScore = 0;

        foreach ($this->spelers as $index => $speler) {
            $score = $speler->getTotaalScore();
            if ($score > $hoogsteScore) {
                $hoogsteScore = $score;
                $winnaarIndex = $index;
            }
        }

        echo "<h3>🎉 De winnaar is Speler " . ($winnaarIndex + 1) . " met een score van $hoogsteScore! 🎉</h3>";
    }

    public function toonSpelersWorpen() {
        foreach ($this->spelers as $index => $speler) {
            echo "<h4>Speler " . ($index + 1) . " - Ronde: {$speler->getAantalWorpen()}</h4>";
            echo $speler->genereerSvgVoorWorpen();
            echo "<hr>";
        }
    }

    public function toonScores() {
        foreach ($this->spelers as $index => $speler) {
            echo "Score van Speler " . ($index + 1) . ": " . $speler->getTotaalScore() . "<br>";
        }
    }
}
