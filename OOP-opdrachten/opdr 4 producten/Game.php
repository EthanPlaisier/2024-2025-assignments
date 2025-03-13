<?php

// Game.php - Class Game
require_once 'Product.php';

class Game extends Product {
    private string $genre;
    private array $requirements;

    public function __construct(string $name, float $purchasePrice, int $tax, float $profit, string $description, string $genre, array $requirements) {
        parent::__construct($name, $purchasePrice, $tax, $profit, $description);
        $this->category = "Game";
        $this->genre = $genre;
        $this->requirements = $requirements;
    }

    public function getInfo(): array {
        return [
            'genre' => $this->genre,
            'requirements' => $this->requirements
        ];
    }
}
?>