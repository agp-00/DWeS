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
            $region       = $_POST['region'];
            
            // Crear una nueva instancia de Country con los valores del formulario
            $country = new Country(
                $country_id,
                $country_name,
                convertToNull($region)
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
    <link rel="stylesheet" href="../../../src/css/AddCountry.css">
</head>
<body>
    <h1>Añadir un Nuevo País</h1>
    <form method="POST" action="">
        <label>ID País:</label><br>
        <input type="number" name="country_id" required><br><br>

        <label>Nombre del País:</label><br>
        <input type="text" name="country_name" required><br><br>

        <label>Región:</label><br>
            <select name="region">
                <option value="">Seleccione una región</option>
                <?php foreach ($regions as $region): ?>
                    <option value="<?= $region ?>"><?= $region ?></option>
                <?php endforeach; ?>
            </select><br><br>

        <button type="button" onclick="window.location.href='../../../index.php'">Cancelar</button>
        <input type="submit" value="Añadir País">
    </form>
</body>
</html>
