<?php
namespace RealEstate;

// Room class
class Room {
    private float $length;
    private float $width;
    private float $height;

    // Constructor
    public function __construct(float $length, float $width, float $height) {
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
    }

    // Method to calculate volume of the room
    public function getVolume(): float {
        return $this->length * $this->width * $this->height;
    }

    // Method to get room details
    public function getDetails(): string {
        return "Room Dimensions: {$this->length}m x {$this->width}m x {$this->height}m | Volume: " . $this->getVolume() . " m³";
    }
}

// House class
class House {
    private int $floors;
    private array $rooms = []; // Array to store Room objects
    private const PRICE_PER_M3 = 1500;

    // Constructor
    public function __construct(int $floors) {
        $this->floors = $floors;
    }

    // Method to add a room to the house
    public function addRoom(Room $room): void {
        $this->rooms[] = $room;
    }

    // Method to calculate the total house volume
    public function getTotalVolume(): float {
        $totalVolume = 0;
        foreach ($this->rooms as $room) {
            $totalVolume += $room->getVolume();
        }
        return $totalVolume;
    }

    // Method to calculate price based on total volume
    public function calculatePrice(): float {
        return $this->getTotalVolume() * self::PRICE_PER_M3;
    }

    // Method to display house details
    public function showDetails(): void {
        echo "House Details:\n";
        echo "Floors: {$this->floors}\n";
        echo "Total Volume: " . $this->getTotalVolume() . " m³\n";
        echo "Price: €" . number_format($this->calculatePrice(), 2, ',', '.') . "\n";
        echo "Rooms:\n";
        foreach ($this->rooms as $room) {
            echo "- " . $room->getDetails() . "\n";
        }
        echo "--------------------------\n";
    }
}

// Creating House objects
$house1 = new House(2);
$house1->addRoom(new Room(5, 4, 2.5));
$house1->addRoom(new Room(6, 5, 3));
$house1->addRoom(new Room(4, 3, 2.8));

$house2 = new House(1);
$house2->addRoom(new Room(6, 4, 2.6));
$house2->addRoom(new Room(5, 3, 2.5));

$house3 = new House(3);
$house3->addRoom(new Room(7, 6, 3));
$house3->addRoom(new Room(5, 5, 2.7));
$house3->addRoom(new Room(6, 4, 2.8));
$house3->addRoom(new Room(4, 3, 2.5));

// Display house details
$house1->showDetails();
echo "<br>";
$house2->showDetails();
echo "<br>";
$house3->showDetails();
?>
