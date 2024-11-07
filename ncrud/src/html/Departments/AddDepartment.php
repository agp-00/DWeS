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
    <link rel="stylesheet" href="../../../src/css/AddDepartment.css">
</head>
<body>
    <h1>Añadir un Nuevo Departamento</h1>
    <form method="POST" action="">
        <label>ID Departamento:</label><br>
        <input type="number" name="department_id" required><br><br>

        <label>Nombre del Departamento:</label><br>
        <input type="text" name="department_name" required><br><br>


        <label>Ubicación del Departamento:</label><br>
        <select name="location">
            <option value="">Seleccione una ubicación</option>
            <?php foreach ($locations as $location): ?>
            <option value="<?= $location ?>"><?= $location ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Gerente del departamento:</label><br>
			<select name="manager_id">
				<option value="">Seleccione un gerente</option>
				<?php foreach ($employee_ids as $id): ?>
					<option value="<?= $id ?>"><?= $id ?></option>
				<?php endforeach; ?>
			</select><br><br>

        <button type="button" onclick="window.location.href='../../../index.php'">Cancelar</button>
        <input type="submit" value="Añadir Departamento">
    </form>
</body>
</html>


