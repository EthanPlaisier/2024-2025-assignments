<?php
namespace Shapes;

// Parent class Figure
abstract class Figure {
    protected string $color;
    protected int $x;
    protected int $y;

    public function __construct(string $color, int $x, int $y) {
        $this->color = $color;
        $this->x = $x;
        $this->y = $y;
    }

    public function getColor(): string {
        return $this->color;
    }

    abstract public function draw(): string;
}

// Square class
class Square extends Figure {
    private int $size;

    public function __construct(string $color, int $x, int $y, int $size) {
        parent::__construct($color, $x, $y);
        $this->size = $size;
    }

    public function draw(): string {
        return "<rect x='{$this->x}' y='{$this->y}' width='{$this->size}' height='{$this->size}' fill='{$this->color}' stroke='black' stroke-width='3'/>";
    }
}

// Circle class
class Circle extends Figure {
    private int $radius;

    public function __construct(string $color, int $x, int $y, int $radius) {
        parent::__construct($color, $x, $y);
        $this->radius = $radius;
    }

    public function draw(): string {
        $cx = $this->x + $this->radius;
        $cy = $this->y + $this->radius;
        return "<circle cx='{$cx}' cy='{$cy}' r='{$this->radius}' fill='{$this->color}' stroke='black' stroke-width='3'/>";
    }
}

// Rectangle class
class Rectangle extends Figure {
    private int $width;
    private int $height;

    public function __construct(string $color, int $x, int $y, int $width, int $height) {
        parent::__construct($color, $x, $y);
        $this->width = $width;
        $this->height = $height;
    }

    public function draw(): string {
        return "<rect x='{$this->x}' y='{$this->y}' width='{$this->width}' height='{$this->height}' fill='{$this->color}' stroke='black' stroke-width='3'/>";
    }
}

// Triangle class
class Triangle extends Figure {
    private int $base;
    private int $height;

    public function __construct(string $color, int $x, int $y, int $base, int $height) {
        parent::__construct($color, $x, $y);
        $this->base = $base;
        $this->height = $height;
    }

    public function draw(): string {
        $x1 = $this->x;
        $y1 = $this->y + $this->height;
        $x2 = $this->x + ($this->base / 2);
        $y2 = $this->y;
        $x3 = $this->x + $this->base;
        $y3 = $this->y + $this->height;
        
        return "<polygon points='{$x1},{$y1} {$x2},{$y2} {$x3},{$y3}' fill='{$this->color}' stroke='black' stroke-width='3'/>";
    }
}
?>
