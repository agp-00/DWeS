<?php
    require '../../vendor/autoload.php';
    use models\Region;

    if (isset($_GET['action']) && $_GET['action'] == 'view_regions') {
        try {
            $regions = Region::all();
            echo "<h2>Lista de Regiones</h2>";
            echo "<a href='../../index.php'>
            <button type='button'>Inicio</button>
          </a>
          <br><br>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Nombre</th></tr>";
            foreach ($regions as $region) {
                echo "<tr>";
                echo "<td>{$region->region_id}</td>";
                echo "<td>{$region->region_name}</td>";
                echo "<td><a href='DeleteRegion.php?id={$region->region_id}'>
                                <button type='button'>Eliminar región</button>  
                        </a></td>";
                echo "</tr>";
            }
            echo "</table>";
            
            echo "<br><br>";
            echo "<a href='../../index.php'>
            <button type='button'>Inicio</button>
          </a>";
          
        } catch (\Exception $e) {
            echo "Se ha producido el siguiente error:" . "<br>" . $e->getMessage();
        }
    }
?>
