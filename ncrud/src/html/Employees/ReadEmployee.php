<?php
	require '../../../vendor/autoload.php';
    use models\Employee;

		if (isset($_GET['action']) && $_GET['action'] == 'view_employees') {
			try {
				$employees = Employee::all();
				echo "<h2>Llista d'Empleats</h2>";
				echo "<a href='../../index.php'>
				<button type='button'>Inicio</button>
			  </a>
			  <br><br>";
				echo "<table border='1'>";
				echo "<tr><th>ID</th><th>Nom</th><th>Llinatge</th><th>Email</th><th>Número de Telèfon</th><th>Data de Contractació</th><th>ID de Treball</th><th>Salari</th><th>Comissió</th><th>ID del Gerent</th><th>ID del Departament</th></tr>";
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
					echo "<td><a href='DeleteEmployee.php?id={$employee->employee_id}'>
									<button type='button'>Eliminar empleado</button>  
							</a></td>";

					echo "</tr>";
				}
				echo "</table>";
				
				echo "<br><br>";
				echo "<a href='../../index.php'>
				<button type='button'>Inicio</button>
			  </a>";
			  
			} catch (\Exception $e) {
				echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
			}
		}
		?>