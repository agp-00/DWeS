<?php

    require_once '../../../vendor/autoload.php';

    function convertToNull($value) {
        return $value === '' ? null : $value;
    }

    use Config\Database;
    use Models\Department;

    function getEmployeeIds() {
        $db = new Database();
        $db->connectDB('C:/temp/config.db');
        $employee_ids = [];
        
        $query = "SELECT employee_id FROM employees ORDER BY employee_id";
        $result = $db->conn->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $employee_ids[] = $row['employee_id'];
            }
        }
        $db->closeDB();
        return $employee_ids;
    }

    $employee_ids = getEmployeeIds();

    
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
            $department_id   = $_POST['department_id'];
            $department_name = $_POST['department_name'];
            $location        = $_POST['location'];
            $manager_id      = $_POST['manager_id'];
            
            // Crear una nueva instancia de Department con los valores del formulario
            $department = new Department(
                $department_id,
                $department_name,
                convertToNull($location),
                convertToNull($manager_id)
            );

            // Guardar el departamento en la base de datos
            $department->save();  // INSERT / UPDATE
        }
    } catch(\Exception $e) {
        echo "Se ha producido el siguiente error:" . "<br>" . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Departamento</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/css/AddDepartment.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Añadir un Nuevo Departamento</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label>ID Departamento:</label>
                <input type="number" name="department_id" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Nombre del Departamento:</label>
                <input type="text" name="department_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Ubicación del Departamento:</label>
                <select name="location" class="form-control">
                    <option value="">Seleccione una ubicación</option>
                    <?php foreach ($locations as $location): ?>
                    <option value="<?= $location ?>"><?= $location ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Gerente del departamento:</label>
                <select name="manager_id" class="form-control">
                    <option value="">Seleccione un gerente</option>
                    <?php foreach ($employee_ids as $id): ?>
                        <option value="<?= $id ?>"><?= $id ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='../../../index.php'">Cancelar</button>
                <input type="submit" class="btn btn-primary" value="Añadir Departamento">
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
