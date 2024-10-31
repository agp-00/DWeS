<?php
    require '../../../vendor/autoload.php';
    use models\Location;

    // Comprobamos si se ha recibido el ID de la ubicación a eliminar
    if (isset($_GET['id'])) {
        $location_id = $_GET['id'];
        
        try {
            // Buscamos la ubicación por su ID
            $location = new Location();
            $location->location_id = $location_id;

            if ($location) {
                // Si la ubicación existe, la eliminamos
                $location->destroy();
                
                // Mostramos un alert de éxito con JavaScript
                echo "<script>
                        alert('Ubicación eliminada exitosamente');
                        window.location.href = 'ReadLocation.php?action=view_locations';
                      </script>";
            } else {
                // Alert si no se encuentra la ubicación
                echo "<script>
                        alert('La ubicación con ID $location_id no se encontró');
                        window.location.href = 'ReadLocation.php?action=view_locations';
                      </script>";
            }
        } catch (\Exception $e) {
            // En caso de error, mostramos un mensaje de error en un alert
            $errorMessage = $e->getMessage();
            echo "<script>
                    alert('Se ha producido un error al intentar eliminar la ubicación: $errorMessage');
                    window.location.href = 'ReadLocation.php?action=view_locations';
                  </script>";
        }
    } else {
        // Alert si no se proporciona un ID de ubicación válido
        echo "<script>
                alert('No se ha proporcionado un ID de ubicación válido');
                window.location.href = 'ReadLocation.php?action=view_locations';
              </script>";
    }
?>
