<?php
        
    abstract class FiguraGeometrica {
            
        protected $color;
            
        public function __construct(string $color) {
            $this->color = $color;
        }

        abstract function __calculaArea(): float;

        public function __toString(): string {
            return "<br>La figura es de color " . $this->color;
        }

    }
?>
