<?php
    require_once '../../vendor/autoload.php';

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
</head>
<body>
    <h1>Añadir o actualizar región</h1>
    <form method="POST" action="">
        <label>ID Región:</label><br>
        <input type="number" name="region_id" required><br><br>
        
        <label>Nombre de la Región:</label><br>
        <input type="text" name="region_name" required><br><br>
        
        <button type="button" onclick="window.location.href='../../index.php'">Cancelar</button>
        <input type="submit" value="Añadir Región">
    </form>
</body>
</html>
