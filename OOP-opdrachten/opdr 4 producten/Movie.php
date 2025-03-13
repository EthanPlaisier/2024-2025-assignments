<?php

// Movie.php - Class Movie
require_once 'Product.php';

class Movie extends Product {
    private string $quality;

    public function __construct(string $name, float $purchasePrice, int $tax, float $profit, string $description, string $quality) {
        parent::__construct($name, $purchasePrice, $tax, $profit, $description);
        $this->category = "Movie";
        $this->quality = $quality;
    }

    public function getInfo(): array {
        return [
            'quality' => $this->quality
        ];
    }
}
?>