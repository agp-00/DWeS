<?php public class Quadrat implements FiguraGeometrica, Coloreador {
    private $costat;

    public function __construct(string $color, float $costat) {
        parent::_parent($color);
        $this->costat = $costat;
    }
}