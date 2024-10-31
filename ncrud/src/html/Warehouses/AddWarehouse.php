<?php
    require_once '../../../vendor/autoload.php';

    function convertToNull($value) {
        return $value === '' ? null : $value;
    }

    use Config\Database;
    use Models\Warehouse;

    try {
        // Si el formulario ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los valores del formulario
            $warehouse_id   = $_POST['warehouse_id'];
            $warehouse_name = $_POST['warehouse_name'];
            $location       = $_POST['location'];

            // Crear una nueva instancia de Warehouse con los valores del formulario
            $warehouse = new Warehouse($warehouse_id, $warehouse_name, $location);

            // Guardar el almacén en la base de datos
            $warehouse->save();  // INSERT / UPDATE
        }
    } catch(\Exception $e) {
        echo "Se ha producido el siguiente error:" . "<br>" . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Almacén</title>
</head>
<body>
    <h1>Añadir o actualizar almacén</h1>
    <form method="POST" action="">
        <label>ID Almacén:</label><br>
        <input type="number" name="warehouse_id" required><br><br>
        
        <label>Nombre del Almacén:</label><br>
        <input type="text" name="warehouse_name" required><br><br>
        
        <label>Ubicación:</label><br>
        <input type="text" name="location" required><br><br>
        
        <button type="button" onclick="window.location.href='../../../index.php'">Cancelar</button>
        <input type="submit" value="Añadir Almacén">
    </form>
</body>
</html>
