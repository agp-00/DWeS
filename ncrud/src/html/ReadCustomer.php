<?php
	require '../../vendor/autoload.php';
    use models\Customer;

	if (isset($_GET['action']) && $_GET['action'] === 'view_customers') {
		try {
			// Obtenemos todos los clientes
			$customers = Customer::all();
			
			// Encabezado de la tabla y botón de inicio
			echo "<h2>Llista de Clients</h2>";
			echo "<a href='../../index.php'>
					<button type='button'>Inicio</button>
				  </a>
                  <br><br>";
			echo "<table border='1'>";
			echo "<tr>
					<th>ID</th> <th>Nombre</th> <th>Apellido</th> <th>Dirección</th>
					<th>Código Postal</th> <th>Ciudad</th> <th>Estado</th> <th>País</th>
					<th>Teléfono</th> <th>Territorio</th> <th>Email</th>
					<th>ID de Gestor</th> <th>Fecha de Nacimiento</th>
					<th>Estado Civil</th> <th>Sexo</th><th>Acciones</th>
				  </tr>";

			// Iteramos sobre cada cliente y mostramos sus datos en la tabla
			foreach ($customers as $customer) {
				echo "<tr>";
				echo "<td>{$customer->customer_id}</td>";
				echo "<td>{$customer->cust_first_name}</td>";
				echo "<td>{$customer->cust_last_name}</td>";
				echo "<td>{$customer->cust_street_address}</td>";
				echo "<td>{$customer->cust_postal_code}</td>";
				echo "<td>{$customer->cust_city}</td>";
				echo "<td>{$customer->cust_state}</td>";
				echo "<td>{$customer->cust_country}</td>";
				echo "<td>{$customer->phone_numbers}</td>";
				echo "<td>{$customer->nls_territory}</td>";
				echo "<td>{$customer->cust_email}</td>";
				echo "<td>{$customer->account_mgr_id}</td>";
				echo "<td>{$customer->date_of_birth}</td>";
				echo "<td>{$customer->marital_status}</td>";
				echo "<td>{$customer->gender}</td>";
				
				// Botón para eliminar cliente
				echo "<td><a href='DeleteCustomer.php?id={$customer->customer_id}'>
							<button type='button'>Eliminar client</button>
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
