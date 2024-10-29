<?php
    require '../../vendor/autoload.php';
    use models\employee;

    // Comprobamos si se ha recibido el ID del cliente a eliminar
    if (isset($_GET['id'])) {
        $employee_id = $_GET['id'];
        
        try {
            // Buscamos al cliente por su ID
            $employee = new Employee();
            $employee->employee_id = $employee_id;

            if ($employee) {
                // Si el cliente existe, lo eliminamos
                $employee->destroy();
                
                // Mostramos un alert de éxito con JavaScript
                echo "<script>
                        alert('Cliente eliminado exitosamente');
                        window.location.href = 'ReadEmployee.php?action=view_employees';
                      </script>";
            } else {
                // Alert si no se encuentra el cliente
                echo "<script>
                        alert('El cliente con ID $employee_id no se encontró');
                        window.location.href = 'ReadEmployee.php?action=view_employees';
                      </script>";
            }
        } catch (\Exception $e) {
            // En caso de error, mostramos un mensaje de error en un alert
            $errorMessage = $e->getMessage();
            echo "<script>
                    alert('Se ha producido un error al intentar eliminar el cliente: $errorMessage');
                    window.location.href = 'ReadEmployee.php?action=view_employees';
                  </script>";
        }
    } else {
        // Alert si no se proporciona un ID de cliente válido
        echo "<script>
                alert('No se ha proporcionado un ID de cliente válido');
                window.location.href = 'ReadEmployee.php?action=view_employees';
              </script>";
    }
?>
