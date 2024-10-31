<?php
    require_once '../../../vendor/autoload.php';

    function convertToNull($value) {
        return $value === '' ? null : $value;
    }

    use Config\Database;
    use Models\Job;

    try {
        // Si el formulario ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los valores del formulario
            $job_id     = $_POST['job_id'];    
            $job_title  = $_POST['job_title'];
            $min_salary = $_POST['min_salary'];
            $max_salary = $_POST['max_salary'];
            
            // Crear una nueva instancia de Job con los valores del formulario
            $job = new Job( $job_id, 
                            $job_title,
                            convertToNull($min_salary),
                            convertToNull($max_salary) );

            // Guardar el trabajo en la base de datos
            $job->save();  // INSERT / UPDATE
        }
    } catch(\Exception $e) {
        echo "Se ha producido el siguiente error:" . "<br>" . $e->getMessage();
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8">
        <title>Formulario de Trabajo</title>
    </head>
    <body>
        <h1>Añadir o actualizar trabajo</h1>
        <form method="POST" action="">
            <label>ID del Trabajo:</label><br>
            <input type="text" name="job_id" required><br><br>
            
            <label>Título del Trabajo:</label><br>
            <input type="text" name="job_title" required><br><br>
            
            <label>Salario Mínimo:</label><br>
            <input type="number" name="min_salary" step="0.01" required><br><br>
            
            <label>Salario Máximo:</label><br>
            <input type="number" name="max_salary" step="0.01" required><br><br>
            
            <button type="button" onclick="window.location.href='../../../index.php'">Cancelar</button>
            <input type="submit" value="Añadir Trabajo">
        </form>
    </body>
</html>
