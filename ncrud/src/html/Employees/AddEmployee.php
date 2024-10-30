<?php
    require_once '../../../vendor/autoload.php';

    function convertToNull($value) {
		return $value === '' ? null : $value;
	}

	use Config\Database;
	use Models\Employee;

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
	</head>
	<body>
		<h1>Añadir o actualizar empleado</h1>
		<form method="POST" action="">
			<label>ID Empleado:</label><br>
			<input type="number" name="employee_id" required><br><br>
			
			<label>Nombre:</label><br>
			<input type="text" name="first_name" required><br><br>
			
			<label>Apellido:</label><br>
			<input type="text" name="last_name" required><br><br>
			
			<label>Email:</label><br>
			<input type="email" name="email" required><br><br>
			
			<label>Número de Teléfono:</label><br>
			<input type="text" name="phone_number"><br><br>
			
			<label>Fecha de Contratación:</label><br>
			<input type="date" name="hire_date" required><br><br>
			
			<label>ID del Trabajo:</label><br>
			<input type="text" name="job_id" required><br><br>
			
			<label>Salario:</label><br>
			<input type="number" name="salary" step="0.01" required><br><br>
			
			<label>Comisión:</label><br>
			<input type="number" name="commission_pct" step="0.01"><br><br>
			
			<label>ID del Gerente:</label><br>
			<input type="number" name="manager_id"><br><br>
			
			<label>ID del Departamento:</label><br>
			<select name="department_id">
				<option value="">Selecciona el departamento</option>
				<option value="1">Departamento 1</option>
				<option value="2">Departamento 2</option>
			</select><br><br>
			
			<button type="button" onclick="window.location.href='../../index.php'">Cancelar</button>
			<input type="submit" value="Afegir Empleat">
		</form>
	</body>
</html>