<?php
    require '../../../vendor/autoload.php';
    use Models\Country;
    use Models\Region; 
    use Config\Database;

    function getRegions() {
        $db = new Database();
        $db->connectDB('C:/temp/config.db');
        $regions = [];
        
        $query = "SELECT region_name FROM regions ORDER BY region_name";
        $result = $db->conn->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $regions[] = $row['region_name'];
            }
        }
        $db->closeDB();
        return $regions;
    }

    $regions = getRegions();

    if (isset($_GET['action']) && $_GET['action'] === 'view_countries') {
        try {
            // Obtenemos todos los países
            $countries = Country::all();
            $regions = Region::all();
            
            // Incluimos el CSS de Bootstrap
            echo "<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>";
            
            // Encabezado de la tabla y botón de inicio
            echo "<div class='container mt-5'>";
            echo "<h2 class='mb-4'>Llista de Països</h2>";
            echo "<a href='../../../index.php' class='btn btn-primary mb-3'>Inicio</a>";
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-dark'>
                    <tr>
                        <th>ID</th> <th>Nombre</th> <th>Acciones</th>
                    </tr>
                  </thead>";
            echo "<tbody>";

            // Iteramos sobre cada país y mostramos sus datos en la tabla
            foreach ($countries as $country) {
                echo "<tr>";
                echo "<td>{$country->country_id}</td>";
                echo "<td>{$country->country_name}</td>";
                
                // Botón para eliminar país
                echo "<td><a href='DeleteCountry.php?id={$country->country_id}' class='btn btn-danger'>Eliminar país</a></td>";
                
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

            echo "<a href='../../../index.php' class='btn btn-primary mt-3'>Inicio</a>";
            echo "</div>";
            
        } catch (\Exception $e) {
            echo "<div class='alert alert-danger mt-3'>S'ha produït el següent error:<br>" . $e->getMessage() . "</div>";
        }
    }
