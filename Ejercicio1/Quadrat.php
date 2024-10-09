<?php

    class Quadrat extends FiguraGeometrica {
        private $costat;
        
        public function __construct(string $color, float $costat) {
            parent::__construct($color);
            $this->costat = $costat;
        }

        public function __calculaArea(): float {
            return pow($this->costat, 2);
        }

        public function __toString():string {
            return parent::__toString() . " y el lado del cuadrado es de " . $this->costat;
        }
}
?>