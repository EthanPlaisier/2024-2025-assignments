<?php

// index.php - Example usage
require_once 'ProductList.php';

$productList = new ProductList();

$productList->addProduct(new Music("Test1", 5.00, 21, 2.00, "Music album", "Artist 1", ["Number 1", "Number 2"]));
$productList->addProduct(new Movie("Starwars 1", 10.00, 21, 3.00, "Sci-fi movie", "DVD"));
$productList->addProduct(new Game("Call of Duty 1", 6.00, 21, 1.87, "FPS game", "FPS", ["8GB RAM", "970 GTX"]));

// Generate table
echo "<table border='1'>";
echo "<tr><th>Category</th><th>Name</th><th>Price</th><th>Info</th></tr>";
foreach ($productList->getProducts() as $product) {
    echo "<tr>";
    echo "<td>" . $product->getCategory() . "</td>";
    echo "<td>" . $product->getName() . "</td>";
    echo "<td>" . number_format($product->getSellingPrice(), 2) . "</td>";
    echo "<td>";
    foreach ($product->getInfo() as $key => $value) {
        if (is_array($value)) {
            echo "<b>$key:</b><ul>";
            foreach ($value as $item) {
                echo "<li>$item</li>";
            }
            echo "</ul>";
        } else {
            echo "<b>$key:</b> $value<br>";
        }
    }
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
?>