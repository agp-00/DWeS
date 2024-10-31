<?php
    require '../../../vendor/autoload.php';
    use models\Inventory;

    if (isset($_GET['action']) && $_GET['action'] == 'view_inventories') {
        try {
            $inventories = Inventory::all();
            echo "<h2>Lista de Inventarios</h2>";
            echo "<a href='../../../index.php'>
            <button type='button'>Inicio</button>
          </a>
          <br><br>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Cantidad</th></tr>";
            foreach ($inventories as $inventory) {
                echo "<tr>";
                echo "<td>{$inventory->inventory_id}</td>";
                echo "<td>{$inventory->inventory_name}</td>";
                echo "<td>{$inventory->quantity}</td>";
                echo "<td><a href='DeleteInventory.php?id={$inventory->inventory_id}'>
                                <button type='button'>Eliminar inventario</button>  
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
