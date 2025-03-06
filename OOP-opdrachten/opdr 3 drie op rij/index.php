<?php
require_once "shapes.php";

use Shapes\Square;
use Shapes\Circle;
use Shapes\Rectangle;
use Shapes\Triangle;

// Positioning parameters
$spacing = 80;
$startX = 10;
$startY = 10;

$shapes = [
    // First row: Squares
    new Square("cyan", $startX, $startY, 60),
    new Square("blue", $startX + $spacing, $startY, 60),
    new Square("green", $startX + 2 * $spacing, $startY, 60),

    // Second row: Circles
    new Circle("cyan", $startX, $startY + $spacing, 30),
    new Circle("blue", $startX + $spacing, $startY + $spacing, 30),
    new Circle("green", $startX + 2 * $spacing, $startY + $spacing, 30),

    // Third row: Rectangles
    new Rectangle("cyan", $startX, $startY + 2 * $spacing, 80, 40),
    new Rectangle("blue", $startX + $spacing, $startY + 2 * $spacing, 80, 40),
    new Rectangle("green", $startX + 2 * $spacing, $startY + 2 * $spacing, 80, 40),

    // Fourth row: Triangles
    new Triangle("cyan", $startX, $startY + 3 * $spacing, 60, 50),
    new Triangle("blue", $startX + $spacing, $startY + 3 * $spacing, 60, 50),
    new Triangle("green", $startX + 2 * $spacing, $startY + 3 * $spacing, 60, 50),
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic-Tac-Toe Shapes</title>
</head>
<body>
    <h1>SVG Tic-Tac-Toe Shapes</h1>
    <svg width="300" height="300">
        <?php
        foreach ($shapes as $shape) {
            echo $shape->draw();
        }
        ?>
    </svg>
</body>
</html>
