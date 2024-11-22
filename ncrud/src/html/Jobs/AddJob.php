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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Añadir o actualizar trabajo</h1>
        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label>ID del Trabajo:</label>
                <input type="text" name="job_id" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Título del Trabajo:</label>
                <input type="text" name="job_title" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Salario Mínimo:</label>
                <input type="number" name="min_salary" step="0.01" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Salario Máximo:</label>
                <input type="number" name="max_salary" step="0.01" class="form-control" required>
            </div>
            
            <button type="button" class="btn btn-secondary" onclick="window.location.href='../../../index.php'">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Añadir Trabajo">
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
