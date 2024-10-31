<?php
    require '../../../vendor/autoload.php';
    use models\Location;

    if (isset($_GET['action']) && $_GET['action'] === 'view_locations') {
        try {
            // Obtenemos todas las ubicaciones
            $locations = Location::all();
            
            // Encabezado de la tabla y botón de inicio
            echo "<h2>Llista de Ubicaciones</h2>";
            echo "<a href='../../../index.php'>
                    <button type='button'>Inicio</button>
                  </a>
                  <br><br>";
            echo "<table border='1'>";
            echo "<tr>
                    <th>ID</th> <th>Dirección</th> <th>Código Postal</th> <th>Ciudad</th>
                    <th>Estado</th> <th>País</th> <th>Acciones</th>
                  </tr>";

            // Iteramos sobre cada ubicación y mostramos sus datos en la tabla
            foreach ($locations as $location) {
                echo "<tr>";
                echo "<td>{$location->location_id}</td>";
                echo "<td>{$location->street_address}</td>";
                echo "<td>{$location->postal_code}</td>";
                echo "<td>{$location->city}</td>";
                echo "<td>{$location->state_province}</td>";
                echo "<td>{$location->country_id}</td>";
                
                // Botón para eliminar ubicación
                echo "<td><a href='DeleteLocation.php?id={$location->location_id}'>
                            <button type='button'>Eliminar ubicación</button>
                      </a></td>";
                echo "</tr>";
            }
            echo "</table>";

            echo "<br><br>";
            echo "<a href='../../../index.php'>
            <button type='button'>Inicio</button>
          </a>";
            
        } catch (\Exception $e) {
            echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
        }
    }
?>
