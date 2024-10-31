<?php
    require '../../../vendor/autoload.php';
    use models\job;

    // Comprobamos si se ha recibido el ID del trabajo a eliminar
    if (isset($_GET['id'])) {
        $job_id = $_GET['id'];
        
        try {
            // Buscamos el trabajo por su ID
            $job = new Job();
            $job->job_id = $job_id;

            if ($job_id) {
                // Si el trabajo existe, lo eliminamos
                $job->destroy();
                
                // Mostramos un alert de éxito con JavaScript
                echo "<script>
                        alert('Trabajo eliminado exitosamente');
                        window.location.href = 'ReadJob.php?action=view_jobs';
                      </script>";
            } else {
                // Alert si no se encuentra el trabajo
                echo "<script>
                        alert('El trabajo con ID $job_id no se encontró');
                        window.location.href = 'ReadJob.php?action=view_jobs';
                      </script>";
            }
        } catch (\Exception $e) {
            // En caso de error, mostramos un mensaje de error en un alert
            $errorMessage = $e->getMessage();
            echo "<script>
                    alert('Se ha producido un error al intentar eliminar el trabajo: $errorMessage');
                    window.location.href = 'ReadJob.php?action=view_jobs';
                  </script>";
        }
    } else {
        // Alert si no se proporciona un ID de trabajo válido
        echo "<script>
                alert('No se ha proporcionado un ID de trabajo válido');
                window.location.href = 'ReadJob.php?action=view_jobs';
              </script>";
    }
?>
