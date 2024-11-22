<?php
    require_once '../../../vendor/autoload.php';

    function convertToNull($value) {
        return $value === '' ? null : $value;
    }

    use Config\Database;
    use Models\Region;

    try {
        // Si el formulario ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los valores del formulario
            $region_id   = $_POST['region_id'];
            $region_name = $_POST['region_name'];

            // Crear una nueva instancia de Region con los valores del formulario
            $region = new Region($region_id, $region_name);

            // Guardar la región en la base de datos
            $region->save();  // INSERT / UPDATE
        }
    } catch(\Exception $e) {
        echo "Se ha producido el siguiente error:" . "<br>" . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Región</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Añadir o actualizar región</h1>
        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label for="region_id">ID Región:</label>
                <input type="number" class="form-control" id="region_id" name="region_id" required>
            </div>
            <div class="form-group">
                <label for="region_name">Nombre de la Región:</label>
                <input type="text" class="form-control" id="region_name" name="region_name" required>
            </div>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='../../../index.php'">Cancelar</button>
            <button type="submit" class="btn btn-primary">Añadir Región</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
