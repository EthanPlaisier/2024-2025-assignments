<?php
class Vervoermiddel {
    public function geluid(): void {
        echo "Algemeen vervoermiddel geluid<br>";
    }
}

class Fiets extends Vervoermiddel {
    public function geluid(): void {
        echo "Tring Tring<br>";
    }
}

class Trein extends Vervoermiddel {
    public function geluid(): void {
        echo "Tjoek Tjoek<br>";
    }
}

class Vliegtuig extends Vervoermiddel {
    public function geluid(): void {
        echo "Whooosh<br>";
    }
}
?>
