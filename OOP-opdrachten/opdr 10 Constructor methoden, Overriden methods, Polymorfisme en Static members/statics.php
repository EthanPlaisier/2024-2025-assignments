<?php
class Converter {
    public static function kmNaarMiles(float $km): float {
        return $km * 0.621371;
    }
}

// Test zonder object
$km = 10;
$miles = Converter::kmNaarMiles($km);
echo "{$km} km is gelijk aan {$miles} miles.<br>";
?>
