<?php
    require '../../../vendor/autoload.php';
    use models\Warehouse;

    if (isset($_GET['action']) && $_GET['action'] == 'view_warehouses') {
        try {
            $warehouses = Warehouse::all();
            echo "<h2>Lista de Almacenes</h2>";
            echo "<a href='../../../index.php'>
            <button type='button'>Inicio</button>
          </a>
          <br><br>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Nombre</th></tr>";
            foreach ($warehouses as $warehouse) {
                echo "<tr>";
                echo "<td>{$warehouse->warehouse_id}</td>";
                echo "<td>{$warehouse->warehouse_name}</td>";
                echo "<td><a href='DeleteWarehouse.php?id={$warehouse->warehouse_id}'>
                                <button type='button'>Eliminar almacén</button>  
                        </a></td>";
                echo "</tr>";
            }
            echo "</table>";
            
            echo "<br><br>";
            echo "<a href='../../../index.php'>
            <button type='button'>Inicio</button>
          </a>";
          
        } catch (\Exception $e) {
            echo "Se ha producido el siguiente error:" . "<br>" . $e->getMessage();
        }
    }
?>
