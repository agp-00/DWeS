<?php

    require_once ('FiguraGeometrica.php');
    require_once ('Cercle.php');
    require_once ('Quadrat.php');
    
    $cercle = new Cercle("Vermell", 3.8);
    
    $quadrat = new Quadrat("Blau", 8.2);
    
    echo $cercle->__toString() . ", siendo su área de " . round($cercle->__calculaArea(), 2) . "<br>";
    echo $quadrat->__toString() . ", siendo su área de " . $quadrat->__calculaArea() .  "<br>";
?>