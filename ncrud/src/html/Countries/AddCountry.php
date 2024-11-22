<?php

    require_once '../../../vendor/autoload.php';

    function convertToNull($value) {
        return $value === '' ? null : $value;
    }

    use Config\Database;
    use Models\Country;

    
    function getRegions() {
        $db = new Database();
        $db->connectDB('C:/temp/config.db');
        $regions = [];
        
        $query = "SELECT region_name FROM regions ORDER BY region_name";
        $result = $db->conn->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $regions[] = $row['region_name'];
            }
        }
        $db->closeDB();
        return $regions;
    }

    $regions = getRegions();

    try {
        // Si el formulario ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los valores del formulario
            $country_id   = $_POST['country_id'];
            $country_name = $_POST['country_name'];
            
            // Crear una nueva instancia de Country con los valores del formulario
            $country = new Country(
                $country_id,
                $country_name,
            );

            // Guardar el país en la base de datos
            $country->save();  // INSERT / UPDATE
        }
    } catch(\Exception $e) {
        echo "Se ha producido el siguiente error:" . "<br>" . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de País</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/css/AddCountry.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Añadir un Nuevo País</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="country_id">ID País:</label>
                <input type="number" class="form-control" id="country_id" name="country_id" required>
            </div>

            <div class="form-group">
                <label for="country_name">Nombre del País:</label>
                <input type="text" class="form-control" id="country_name" name="country_name" required>
            </div>

            <button type="button" class="btn btn-secondary" onclick="window.location.href='../../../index.php'">Cancelar</button>
            <button type="submit" class="btn btn-primary">Añadir País</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
