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
    <link rel="stylesheet" href="../../../src/css/AddCustomer.css">
</head>
<body>
    <h1>Añadir un Nuevo Cliente</h1>
    <form method="POST" action="">
        <label>ID Cliente:</label><br>
        <input type="number" name="customer_id" required><br><br>

        <label>Nombre:</label><br>
        <input type="text" name="cust_first_name" required><br><br>

        <label>Apellido:</label><br>
        <input type="text" name="cust_last_name" required><br><br>

        <label>Dirección:</label><br>
        <input type="text" name="cust_street_address"><br><br>

        <label>Código Postal:</label><br>
        <input type="text" name="cust_postal_code"><br><br>

        <label>Ciudad:</label><br>
        <input type="text" name="cust_city"><br><br>

        <label>Estado:</label><br>
        <input type="text" name="cust_state"><br><br>

        <label>País:</label><br>
        <input type="text" name="cust_country"><br><br>

        <label>Números de Teléfono:</label><br>
        <input type="text" name="phone_numbers"><br><br>

        <label>Territorio (NLS):</label><br>
        <input type="text" name="nls_territory"><br><br>

        <label>Email:</label><br>
        <input type="email" name="cust_email"><br><br>

        <!-- Desplegable para ID del Gerente de Cuenta -->
        <label>ID del Gerente de Cuenta:</label><br>
        <select name="account_mgr_id">
        <option value="">Seleccione un gerente</option>
				<?php foreach ($employee_ids as $id): ?>
					<option value="<?= $id ?>"><?= $id ?></option>
				<?php endforeach; ?>
			</select><br><br>

        <label>Fecha de Nacimiento:</label><br>
        <input type="date" name="date_of_birth"><br><br>

        <label>Estado Civil:</label><br>
        <select name="marital_status">
            <option value="">Selecciona el estado civil</option>
            <option value="single">Soltero</option>
            <option value="married">Casado</option>
        </select><br><br>

        <label>Género:</label><br>
        <select name="gender">
            <option value="">Selecciona el género</option>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select><br><br>

        <button type="button" onclick="window.location.href='../../../index.php'">Cancelar</button>
        <input type="submit" value="Añadir Cliente">
    </form>
</body>
</html>
