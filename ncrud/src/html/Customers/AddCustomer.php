<?php

    require_once '../../../vendor/autoload.php';

    function convertToNull($value) {
        return $value === '' ? null : $value;
    }

    use Config\Database;
    use Models\Customer;
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

    try {
        // Si el formulario ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los valores del formulario
            $customer_id        = $_POST['customer_id'];
            $cust_first_name    = $_POST['cust_first_name'];
            $cust_last_name     = $_POST['cust_last_name'];
            $cust_street_address = $_POST['cust_street_address'];
            $cust_postal_code   = $_POST['cust_postal_code'];
            $cust_city          = $_POST['cust_city'];
            $cust_state         = $_POST['cust_state'];
            $cust_country       = $_POST['cust_country'];
            $phone_numbers      = $_POST['phone_numbers'];
            $nls_territory      = $_POST['nls_territory'];
            $cust_email         = $_POST['cust_email'];
            $account_mgr_id     = $_POST['account_mgr_id'];
            $date_of_birth      = $_POST['date_of_birth'];
            $marital_status     = $_POST['marital_status'];
            $gender             = $_POST['gender'];

            // Crear una nueva instancia de Customer con los valores del formulario
            $customer = new Customer(
                $customer_id,
                $cust_first_name,
                $cust_last_name,
                convertToNull($cust_street_address),
                convertToNull($cust_postal_code),
                convertToNull($cust_city),
                convertToNull($cust_state),
                convertToNull($cust_country),
                convertToNull($phone_numbers),
                convertToNull($nls_territory),
                convertToNull($cust_email),
                convertToNull($account_mgr_id),
                convertToNull($date_of_birth),
                convertToNull($marital_status),
                convertToNull($gender)
            );

            // Guardar el cliente en la base de datos
            $customer->save();  // INSERT / UPDATE
        }
    } catch(\Exception $e) {
        echo "Se ha producido el siguiente error:" . "<br>" . $e->getMessage();
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../src/css/AddCustomer.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Añadir un Nuevo Cliente</h1>
        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label>ID Cliente:</label>
                <input type="number" name="customer_id" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="cust_first_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Apellido:</label>
                <input type="text" name="cust_last_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Dirección:</label>
                <input type="text" name="cust_street_address" class="form-control">
            </div>

            <div class="form-group">
                <label>Código Postal:</label>
                <input type="text" name="cust_postal_code" class="form-control">
            </div>

            <div class="form-group">
                <label>Ciudad:</label>
                <input type="text" name="cust_city" class="form-control">
            </div>

            <div class="form-group">
                <label>Estado:</label>
                <input type="text" name="cust_state" class="form-control">
            </div>

            <div class="form-group">
                <label>País:</label>
                <input type="text" name="cust_country" class="form-control">
            </div>

            <div class="form-group">
                <label>Número de Teléfono:</label>
                <input type="text" name="phone_numbers" class="form-control">
            </div>

            <div class="form-group">
                <label>Territorio (NLS):</label>
                <input type="text" name="nls_territory" class="form-control">
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="cust_email" class="form-control">
            </div>

            <div class="form-group">
                <label>ID del Gerente de Cuenta:</label>
                <select name="account_mgr_id" class="form-control">
                    <option value="">Seleccione un gerente</option>
                    <?php foreach ($employee_ids as $id): ?>
                        <option value="<?= $id ?>"><?= $id ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Fecha de Nacimiento:</label>
                <input type="date" name="date_of_birth" class="form-control">
            </div>

            <div class="form-group">
                <label>Estado Civil:</label>
                <select name="marital_status" class="form-control">
                    <option value="">Selecciona el estado civil</option>
                    <option value="single">Soltero</option>
                    <option value="married">Casado</option>
                </select>
            </div>

            <div class="form-group">
                <label>Género:</label>
                <select name="gender" class="form-control">
                    <option value="">Selecciona el género</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='../../../index.php'">Cancelar</button>
                <input type="submit" class="btn btn-primary" value="Añadir Cliente">
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
