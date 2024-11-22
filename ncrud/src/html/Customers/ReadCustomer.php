<?php
	require '../../../vendor/autoload.php';
	use models\Customer;

	if (isset($_GET['action']) && $_GET['action'] === 'view_customers') {
		try {
			// Obtenemos todos los clientes
			$customers = Customer::all();
			
			// Encabezado de la tabla y botón de inicio
			echo "<!DOCTYPE html>
				  <html lang='en'>
				  <head>
					  <meta charset='UTF-8'>
					  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
					  <title>Llista de Clients</title>
					  <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
				  </head>
				  <body>
				  <div class='container mt-5'>
					  <h2 class='mb-4'>Llista de Clients</h2>
					  <a href='../../../index.php' class='btn btn-primary mb-3'>Inicio</a>
					  <table class='table table-striped table-hover'>
						  <thead class='thead-dark'>
							  <tr>
								  <th>ID</th> <th>Nombre</th> <th>Apellido</th> <th>Dirección</th>
								  <th>Código Postal</th> <th>Ciudad</th> <th>Estado</th> <th>País</th>
								  <th>Teléfono</th> <th>Territorio</th> <th>Email</th>
								  <th>ID de Gestor</th> <th>Fecha de Nacimiento</th>
								  <th>Estado Civil</th> <th>Sexo</th><th>Acciones</th>
							  </tr>
						  </thead>
						  <tbody>";

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
				echo "<td><a href='DeleteCustomer.php?id={$customer->customer_id}' class='btn btn-danger'>Eliminar client</a></td>";
				echo "</tr>";
			}
			echo "</tbody>
				  </table>
				  <a href='../../../index.php' class='btn btn-primary mt-3'>Inicio</a>
				  </div>
				  <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
				  <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js'></script>
				  <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
				  </body>
				  </html>";
			
		} catch (\Exception $e) {
			echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
		}
	}
?>
