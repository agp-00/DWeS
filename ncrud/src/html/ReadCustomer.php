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
				  </a>";
			echo "<table border='1'>";
			echo "<tr>
					<th>ID</th><th>Nom</th><th>Cognom</th><th>Adreça</th><th>Codi Postal</th>
					<th>Ciutat</th><th>Estat</th><th>País</th><th>Telèfon</th><th>Idioma</th>
					<th>Territori</th><th>Límit de Crèdit</th><th>Email</th><th>ID de Gestor</th>
					<th>Localització</th><th>Data de Naixement</th><th>Estat Civil</th>
					<th>Gènere</th><th>Nivell d'Ingressos</th><th>Accions</th>
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
				echo "<td>{$customer->nls_language}</td>";
				echo "<td>{$customer->nls_territory}</td>";
				echo "<td>{$customer->credit_limit}</td>";
				echo "<td>{$customer->cust_email}</td>";
				echo "<td>{$customer->account_mgr_id}</td>";
				echo "<td>{$customer->cust_geo_location}</td>";
				echo "<td>{$customer->date_of_birth}</td>";
				echo "<td>{$customer->marital_status}</td>";
				echo "<td>{$customer->gender}</td>";
				echo "<td>{$customer->income_level}</td>";
				
				// Botón para eliminar cliente
				echo "<td><a href='DeleteCustomer.php?id={$customer->customer_id}'>
							<button type='button'>Eliminar client</button>
					  </a></td>";
				echo "</tr>";
			}
			echo "</table>";
			
		} catch (\Exception $e) {
			echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
		}
	}
?>
