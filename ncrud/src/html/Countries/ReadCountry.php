<?php
    require '../../../vendor/autoload.php';
    use models\Country;

    if (isset($_GET['action']) && $_GET['action'] === 'view_countries') {
        try {
            // Obtenemos todos los países
            $countries = Country::all();
            
            // Encabezado de la tabla y botón de inicio
            echo "<h2>Llista de Països</h2>";
            echo "<a href='../../../index.php'>
                    <button type='button'>Inicio</button>
                  </a>
                  <br><br>";
            echo "<table border='1'>";
            echo "<tr>
                    <th>ID</th> <th>Nombre</th> <th>Región</th> <th>Acciones</th>
                  </tr>";

            // Iteramos sobre cada país y mostramos sus datos en la tabla
            foreach ($countries as $country) {
                echo "<tr>";
                echo "<td>{$country->country_id}</td>";
                echo "<td>{$country->country_name}</td>";
                echo "<td>{$country->region_id}</td>";
                
                // Botón para eliminar país
                echo "<td><a href='DeleteCountry.php?id={$country->country_id}'>
                            <button type='button'>Eliminar país</button>
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
