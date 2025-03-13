<?php

// ProductList.php - Class ProductList
require_once 'Product.php';
require_once 'Music.php';
require_once 'Movie.php';
require_once 'Game.php';

class ProductList {
    private array $products = [];

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function getProducts(): array {
        return $this->products;
    }
}
?>