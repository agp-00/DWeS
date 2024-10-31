<?php
    require '../../../vendor/autoload.php';
    use models\Country;

    // Comprobamos si se ha recibido el ID del país a eliminar
    if (isset($_GET['id'])) {
        $country_id = $_GET['id'];
        
        try {
            // Buscamos el país por su ID
            $country = new Country();
            $country->country_id = $country_id;

            if ($country) {
                // Si el país existe, lo eliminamos
                $country->destroy();
                
                // Mostramos un alert de éxito con JavaScript
                echo "<script>
                        alert('País eliminado exitosamente');
                        window.location.href = 'ReadCountry.php?action=view_countries';
                      </script>";
            } else {
                // Alert si no se encuentra el país
                echo "<script>
                        alert('El país con ID $country_id no se encontró');
                        window.location.href = 'ReadCountry.php?action=view_countries';
                      </script>";
            }
        } catch (\Exception $e) {
            // En caso de error, mostramos un mensaje de error en un alert
            $errorMessage = $e->getMessage();
            echo "<script>
                    alert('Se ha producido un error al intentar eliminar el país: $errorMessage');
                    window.location.href = 'ReadCountry.php?action=view_countries';
                  </script>";
        }
    } else {
        // Alert si no se proporciona un ID de país válido
        echo "<script>
                alert('No se ha proporcionado un ID de país válido');
                window.location.href = 'ReadCountry.php?action=view_countries';
              </script>";
    }
?>
