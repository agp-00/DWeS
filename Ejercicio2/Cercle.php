<?php class Cercle implements Coloreador, FiguraGeometrica{
    private $radi;

    public function __construct(
        private ?string $color = null,
        private float $radi = 0) { }

    public function calculaArea(): float{
        return M_PI * pow($this->radi, 2);
    }

    public function  aplicaColor(): string{
        return "El cercle es de color " . $color;
    }
}

?>