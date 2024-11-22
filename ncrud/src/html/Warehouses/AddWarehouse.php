<?php
    require_once '../../../vendor/autoload.php';

    function convertToNull($value) {
        return $value === '' ? null : $value;
    }

    use Config\Database;
    use Models\Warehouse;

    function getLocations() {
        $db = new Database();
        $db->connectDB('C:/temp/config.db');
        $locations = [];
        
        $query = "SELECT city FROM locations ORDER BY city";
        $result = $db->conn->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $locations[] = $row['city'];
            }
        }
        $db->closeDB();
        return $locations;
    }

    $locations = getLocations();

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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Añadir o actualizar almacén</h1>
        <form method="POST" action="" class="mt-3">
            <div class="form-group">
                <label for="warehouse_id">ID Almacén:</label>
                <input type="number" class="form-control" id="warehouse_id" name="warehouse_id" required>
            </div>
            <div class="form-group">
                <label for="warehouse_name">Nombre del Almacén:</label>
                <input type="text" class="form-control" id="warehouse_name" name="warehouse_name" required>
            </div>
            <div class="form-group">
                <label for="location">Ubicación del Departamento:</label>
                <select class="form-control" id="location" name="location">
                    <option value="">Seleccione una ubicación</option>
                    <?php foreach ($locations as $location): ?>
                    <option value="<?= $location ?>"><?= $location ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='../../../index.php'">Cancelar</button>
            <button type="submit" class="btn btn-primary">Añadir Almacén</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
