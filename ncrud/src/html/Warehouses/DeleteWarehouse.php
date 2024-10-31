<?php
    require '../../../vendor/autoload.php';
    use models\Warehouse;

    // Comprobamos si se ha recibido el ID del almacén a eliminar
    if (isset($_GET['id'])) {
        $warehouse_id = $_GET['id'];
        
        try {
            // Buscamos el almacén por su ID
            $warehouse = new Warehouse();
            $warehouse->warehouse_id = $warehouse_id;

            if ($warehouse) {
                // Si el almacén existe, lo eliminamos
                $warehouse->destroy();
                
                // Mostramos un alert de éxito con JavaScript
                echo "<script>
                        alert('Almacén eliminado exitosamente');
                        window.location.href = 'ReadWarehouse.php?action=view_warehouses';
                      </script>";
            } else {
                // Alert si no se encuentra el almacén
                echo "<script>
                        alert('El almacén con ID $warehouse_id no se encontró');
                        window.location.href = 'ReadWarehouse.php?action=view_warehouses';
                      </script>";
            }
        } catch (\Exception $e) {
            // En caso de error, mostramos un mensaje de error en un alert
            $errorMessage = $e->getMessage();
            echo "<script>
                    alert('Se ha producido un error al intentar eliminar el almacén: $errorMessage');
                    window.location.href = 'ReadWarehouse.php?action=view_warehouses';
                  </script>";
        }
    } else {
        // Alert si no se proporciona un ID de almacén válido
        echo "<script>
                alert('No se ha proporcionado un ID de almacén válido');
                window.location.href = 'ReadWarehouse.php?action=view_warehouses';
              </script>";
    }
?>
