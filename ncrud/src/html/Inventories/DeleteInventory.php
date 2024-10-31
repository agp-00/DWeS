<?php
    require '../../../vendor/autoload.php';
    use models\Inventory;

    // Comprobamos si se ha recibido el ID del inventario a eliminar
    if (isset($_GET['id'])) {
        $inventory_id = $_GET['id'];
        
        try {
            // Buscamos el inventario por su ID
            $inventory = new Inventory();
            $inventory->inventory_id = $inventory_id;

            if ($inventory) {
                // Si el inventario existe, lo eliminamos
                $inventory->destroy();
                
                // Mostramos un alert de éxito con JavaScript
                echo "<script>
                        alert('Inventario eliminado exitosamente');
                        window.location.href = 'ReadInventory.php?action=view_inventories';
                      </script>";
            } else {
                // Alert si no se encuentra el inventario
                echo "<script>
                        alert('El inventario con ID $inventory_id no se encontró');
                        window.location.href = 'ReadInventory.php?action=view_inventories';
                      </script>";
            }
        } catch (\Exception $e) {
            // En caso de error, mostramos un mensaje de error en un alert
            $errorMessage = $e->getMessage();
            echo "<script>
                    alert('Se ha producido un error al intentar eliminar el inventario: $errorMessage');
                    window.location.href = 'ReadInventory.php?action=view_inventories';
                  </script>";
        }
    } else {
        // Alert si no se proporciona un ID de inventario válido
        echo "<script>
                alert('No se ha proporcionado un ID de inventario válido');
                window.location.href = 'ReadInventory.php?action=view_inventories';
              </script>";
    }
?>
