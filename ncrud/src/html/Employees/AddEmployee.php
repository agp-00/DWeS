<?php
	require_once '../../../vendor/autoload.php';

	function convertToNull($value) {
		return $value === '' ? null : $value;
	}

	use Config\Database;
	use Models\Employee;

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

	function getDepartmentIds() {
		$db = new Database();
		$db->connectDB('C:/temp/config.db');
		$department_ids = [];
		
		$query = "SELECT department_id FROM departments ORDER BY department_id";
		$result = $db->conn->query($query);

		if ($result) {
			while ($row = $result->fetch_assoc()) {
				$department_ids[] = $row['department_id'];
			}
		}
		$db->closeDB();
		return $department_ids;
	}

	$department_ids = getDepartmentIds();

	try {
		// Si el formulari ha estat enviat
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Obtenir els valors del formulari
			$employee_id    = $_POST['employee_id'];    
			$first_name     = $_POST['first_name'];
			$last_name      = $_POST['last_name'];
			$email          = $_POST['email'];
			$phone_number   = $_POST['phone_number'];
			$hire_date      = $_POST['hire_date'];
			$job_id         = $_POST['job_id'];
			$salary         = $_POST['salary'];
			$commission_pct = $_POST['commission_pct'];
			$manager_id     = $_POST['manager_id'];
			$department_id  = $_POST['department_id'];
			
			// Crear una nova instància d'Employee amb els valors del formulari
			$employee = new Employee( $employee_id, 
									$first_name,
									$last_name,
									convertToNull($email),
									convertToNull($phone_number),
									convertToNull($hire_date),
									$job_id, 
									convertToNull($salary), 
									convertToNull($commission_pct), 
									convertToNull($manager_id),
									convertToNull($department_id) );

			// Guardar l'empleat a la base de dades
			$employee->save();  // INSERT / UPDATE
		}
	} catch(\Exception $e) {
		echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Formulario de Empleado</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container mt-5">
		<h1 class="mb-4">Añadir o actualizar empleado</h1>
		<form method="POST" action="">
			<div class="form-group">
				<label>ID Empleado:</label>
				<input type="number" class="form-control" name="employee_id" required>
			</div>
			
			<div class="form-group">
				<label>Nombre:</label>
				<input type="text" class="form-control" name="first_name" required>
			</div>
			
			<div class="form-group">
				<label>Apellido:</label>
				<input type="text" class="form-control" name="last_name" required>
			</div>
			
			<div class="form-group">
				<label>Email:</label>
				<input type="email" class="form-control" name="email" required>
			</div>
			
			<div class="form-group">
				<label>Número de Teléfono:</label>
				<input type="text" class="form-control" name="phone_number">
			</div>
			
			<div class="form-group">
				<label>Fecha de Contratación:</label>
				<input type="date" class="form-control" name="hire_date" required>
			</div>
			
			<div class="form-group">
				<label>ID del Trabajo:</label>
				<input type="text" class="form-control" name="job_id" required>
			</div>
			
			<div class="form-group">
				<label>Salario:</label>
				<input type="number" class="form-control" name="salary" step="0.01" required>
			</div>
			
			<div class="form-group">
				<label>Comisión:</label>
				<input type="number" class="form-control" name="commission_pct" step="0.01">
			</div>
			
			<div class="form-group">
				<label>ID del Gerente:</label>
				<select class="form-control" name="manager_id">
					<option value="">Seleccione un gerente</option>
					<?php foreach ($employee_ids as $id): ?>
						<option value="<?= $id ?>"><?= $id ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			
			<div class="form-group">
				<label>Departamento:</label>
				<select class="form-control" name="department_id">
					<option value="">Seleccione un departamento</option>
					<?php foreach ($department_ids as $id): ?>
						<option value="<?= $id ?>"><?= $id ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<button type="button" class="btn btn-secondary" onclick="window.location.href='../../../index.php'">Cancelar</button>
				<input type="submit" class="btn btn-primary" value="Afegir Empleat">
			</div>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>