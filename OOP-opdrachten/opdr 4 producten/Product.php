<?php

// Product.php - Abstract class Product
abstract class Product {
    protected string $name;
    protected float $purchasePrice;
    protected int $tax;
    protected string $description;
    protected float $profit;
    protected string $category;

    public function __construct(string $name, float $purchasePrice, int $tax, float $profit, string $description) {
        $this->name = $name;
        $this->purchasePrice = $purchasePrice;
        $this->tax = $tax;
        $this->profit = $profit;
        $this->description = $description;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getCategory(): string {
        return $this->category;
    }

    public function getSellingPrice(): float {
        return $this->purchasePrice + $this->profit + ($this->purchasePrice * $this->tax / 100);
    }

    abstract public function getInfo(): array;
}
?>