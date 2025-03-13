<?php

// Music.php - Class Music
require_once 'Product.php';

class Music extends Product {
    private string $artist;
    private array $numbers;

    public function __construct(string $name, float $purchasePrice, int $tax, float $profit, string $description, string $artist, array $numbers) {
        parent::__construct($name, $purchasePrice, $tax, $profit, $description);
        $this->category = "Music";
        $this->artist = $artist;
        $this->numbers = $numbers;
    }

    public function getInfo(): array {
        return [
            'artist' => $this->artist,
            'numbers' => $this->numbers
        ];
    }
}
?>