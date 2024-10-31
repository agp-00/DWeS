<?php
    require '../../../vendor/autoload.php';
    use models\Region;

    // Comprobamos si se ha recibido el ID de la región a eliminar
    if (isset($_GET['id'])) {
        $region_id = $_GET['id'];
        
        try {
            // Buscamos la región por su ID
            $region = new Region();
            $region->region_id = $region_id;

            if ($region) {
                // Si la región existe, la eliminamos
                $region->destroy();
                
                // Mostramos un alert de éxito con JavaScript
                echo "<script>
                        alert('Región eliminada exitosamente');
                        window.location.href = 'ReadRegion.php?action=view_regions';
                      </script>";
            } else {
                // Alert si no se encuentra la región
                echo "<script>
                        alert('La región con ID $region_id no se encontró');
                        window.location.href = 'ReadRegion.php?action=view_regions';
                      </script>";
            }
        } catch (\Exception $e) {
            // En caso de error, mostramos un mensaje de error en un alert
            $errorMessage = $e->getMessage();
            echo "<script>
                    alert('Se ha producido un error al intentar eliminar la región: $errorMessage');
                    window.location.href = 'ReadRegion.php?action=view_regions';
                  </script>";
        }
    } else {
        // Alert si no se proporciona un ID de región válido
        echo "<script>
                alert('No se ha proporcionado un ID de región válido');
                window.location.href = 'ReadRegion.php?action=view_regions';
              </script>";
    }
?>
