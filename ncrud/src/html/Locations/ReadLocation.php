<?php
    require '../../../vendor/autoload.php';
    use models\Location;

    if (isset($_GET['action']) && $_GET['action'] === 'view_locations') {
        try {
            // Obtenemos todas las ubicaciones
            $locations = Location::all();
            
            // Encabezado de la tabla y botón de inicio
            echo "<!DOCTYPE html>
                  <html lang='en'>
                  <head>
                      <meta charset='UTF-8'>
                      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                      <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
                      <title>Llista de Ubicaciones</title>
                  </head>
                  <body>
                  <div class='container mt-5'>
                      <h2 class='mb-4'>Llista de Ubicaciones</h2>
                      <a href='../../../index.php' class='btn btn-primary mb-3'>Inicio</a>
                      <table class='table table-bordered'>
                          <thead class='thead-dark'>
                              <tr>
                                  <th>ID</th>
                                  <th>Dirección</th>
                                  <th>Código Postal</th>
                                  <th>Ciudad</th>
                                  <th>Estado</th>
                                  <th>País</th>
                                  <th>Acciones</th>
                              </tr>
                          </thead>
                          <tbody>";

            // Iteramos sobre cada ubicación y mostramos sus datos en la tabla
            foreach ($locations as $location) {
                echo "<tr>
                          <td>{$location->location_id}</td>
                          <td>{$location->street_address}</td>
                          <td>{$location->postal_code}</td>
                          <td>{$location->city}</td>
                          <td>{$location->state_province}</td>
                          <td>{$location->country_id}</td>
                          <td>
                              <a href='DeleteLocation.php?id={$location->location_id}' class='btn btn-danger'>Eliminar ubicación</a>
                          </td>
                      </tr>";
            }

            echo "          </tbody>
                      </table>
                      <a href='../../../index.php' class='btn btn-primary mt-3'>Inicio</a>
                  </div>
                  <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
                  <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js'></script>
                  <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
                  </body>
                  </html>";
            
        } catch (\Exception $e) {
            echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
        }
    }
?>
