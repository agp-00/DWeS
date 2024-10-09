<?php

    class Cercle extends FiguraGeometrica {
        private $radi;
        
        public function __construct(string $color, float $radi) {
            parent::__construct($color);
            $this->radi = $radi;
        }
        
        public function __calculaArea(): float {
            return M_PI * pow($this->radi, 2);
        }

        public function __toString():string {
            return parent::__toString() . " y el radio del círculo es de " . $this->radi;
        }
    }
?>