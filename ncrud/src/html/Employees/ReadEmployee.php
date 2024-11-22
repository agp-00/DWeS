<?php
	require '../../../vendor/autoload.php';
	use models\Employee;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Employees List</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container mt-5">
		<?php
		if (isset($_GET['action']) && $_GET['action'] == 'view_employees') {
			try {
				$employees = Employee::all();
				echo "<h2 class='mb-4'>Llista d'Empleats</h2>";
				echo "<a href='../../../index.php' class='btn btn-primary mb-3'>Inicio</a>";
				echo "<table class='table table-bordered'>";
				echo "<thead class='thead-dark'><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th>
													<th>Número de Teléfono</th><th>Fecha de Contractación</th>
													<th>ID de Treball</th><th>Salario</th><th>Comisión</th>
													<th>ID del Gerente</th><th>ID del Departamento</th>
													<th class='text-center'>Acciones</th>
												</tr>
					</thead>";

				echo "<tbody>";
				foreach ($employees as $employee) {
					echo "<tr>";
					echo "<td>{$employee->employee_id}</td>";
					echo "<td>{$employee->first_name}</td>";
					echo "<td>{$employee->last_name}</td>";
					echo "<td>{$employee->email}</td>";
					echo "<td>{$employee->phone_number}</td>";
					echo "<td>{$employee->hire_date}</td>";
					echo "<td>{$employee->job_id}</td>";
					echo "<td>{$employee->salary}</td>";
					echo "<td>{$employee->commission_pct}</td>";
					echo "<td>{$employee->manager_id}</td>";
					echo "<td>{$employee->department_id}</td>";
					echo "<td><span class='d-flex justify-content-around'><a href='DeleteEmployee.php?id={$employee->employee_id}' class='btn btn-danger'>Eliminar empleado</a>";
					echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
				echo "<a href='../../../index.php' class='btn btn-primary mt-3'>Inicio</a>";
			} catch (\Exception $e) {
				echo "<div class='alert alert-danger'>S'ha produït el següent error:<br>" . $e->getMessage() . "</div>";
			}
		}
		?>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
