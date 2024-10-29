<?php
    require '../../vendor/autoload.php';
    use models\Customer;

    // Comprobamos si se ha recibido el ID del cliente a eliminar
    if (isset($_GET['id'])) {
        $customer_id = $_GET['id'];
        
        try {
            // Buscamos al cliente por su ID
            $customer = new Customer();
            $customer->customer_id = $customer_id;

            if ($customer) {
                // Si el cliente existe, lo eliminamos
                $customer->destroy();
                
                // Mostramos un alert de éxito con JavaScript
                echo "<script>
                        alert('Cliente eliminado exitosamente');
                        window.location.href = 'ReadCustomer.php?action=view_customers';
                      </script>";
            } else {
                // Alert si no se encuentra el cliente
                echo "<script>
                        alert('El cliente con ID $customer_id no se encontró');
                        window.location.href = 'ReadCustomer.php?action=view_customers';
                      </script>";
            }
        } catch (\Exception $e) {
            // En caso de error, mostramos un mensaje de error en un alert
            $errorMessage = $e->getMessage();
            echo "<script>
                    alert('Se ha producido un error al intentar eliminar el cliente: $errorMessage');
                    window.location.href = 'ReadCustomer.php?action=view_customers';
                  </script>";
        }
    } else {
        // Alert si no se proporciona un ID de cliente válido
        echo "<script>
                alert('No se ha proporcionado un ID de cliente válido');
                window.location.href = 'ReadCustomer.php?action=view_customers';
              </script>";
    }
?>
