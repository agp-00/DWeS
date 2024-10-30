<?php
    require '../../vendor/autoload.php';
    use models\department;

    // Comprobamos si se ha recibido el ID del departamento a eliminar
    if (isset($_GET['id'])) {
        $department_id = $_GET['id'];
        
        try {
            // Buscamos el departamento por su ID
            $department = new department();
            $department->department_id = $department_id;

            if ($department) {
                // Si el departamento existe, lo eliminamos
                $department->destroy();
                
                // Mostramos un alert de éxito con JavaScript
                echo "<script>
                        alert('Departamento eliminado exitosamente');
                        window.location.href = 'ReadDepartment.php?action=view_departments';
                      </script>";
            } else {
                // Alert si no se encuentra el departamento
                echo "<script>
                        alert('El departamento con ID $department_id no se encontró');
                        window.location.href = 'ReadDepartment.php?action=view_departments';
                      </script>";
            }
        } catch (\Exception $e) {
            // En caso de error, mostramos un mensaje de error en un alert
            $errorMessage = $e->getMessage();
            echo "<script>
                    alert('Se ha producido un error al intentar eliminar el departamento: $errorMessage');
                    window.location.href = 'ReadDepartment.php?action=view_departments';
                  </script>";
        }
    } else {
        // Alert si no se proporciona un ID de departamento válido
        echo "<script>
                alert('No se ha proporcionado un ID de departamento válido');
                window.location.href = 'ReadDepartment.php?action=view_departments';
              </script>";
    }
?>
