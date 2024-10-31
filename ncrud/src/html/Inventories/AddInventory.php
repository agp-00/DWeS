<?php
    require_once '../../../vendor/autoload.php';

    function convertToNull($value) {
        return $value === '' ? null : $value;
    }

    use Config\Database;
    use Models\Inventory;

    try {
        // Si el formulario ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los valores del formulario
            $inventory_id   = $_POST['inventory_id'];
            $inventory_name = $_POST['inventory_name'];
            $quantity       = $_POST['quantity'];

            // Crear una nueva instancia de Inventory con los valores del formulario
            $inventory = new Inventory($inventory_id, $inventory_name, $quantity);

            // Guardar el inventario en la base de datos
            $inventory->save();  // INSERT / UPDATE
        }
    } catch(\Exception $e) {
        echo "Se ha producido el siguiente error:" . "<br>" . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Inventario</title>
</head>
<body>
    <h1>Añadir o actualizar inventario</h1>
    <form method="POST" action="">
        <label>ID Inventario:</label><br>
        <input type="number" name="inventory_id" required><br><br>
        
        <label>Nombre del Inventario:</label><br>
        <input type="text" name="inventory_name" required><br><br>
        
        <label>Cantidad:</label><br>
        <input type="number" name="quantity" required><br><br>
        
        <button type="button" onclick="window.location.href='../../../index.php'">Cancelar</button>
        <input type="submit" value="Añadir Inventario">
    </form>
</body>
</html>
