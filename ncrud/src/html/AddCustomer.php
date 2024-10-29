<?php
    require_once '../../vendor/autoload.php';

    function convertToNull($value) {
        return $value === '' ? null : $value;
    }

    use Config\Database;
    use Models\Customer;

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
            $nls_language       = $_POST['nls_language'];
            $nls_territory      = $_POST['nls_territory'];
            $credit_limit       = $_POST['credit_limit'];
            $cust_email         = $_POST['cust_email'];
            $account_mgr_id     = $_POST['account_mgr_id'];
            $cust_geo_location  = $_POST['cust_geo_location'];
            $date_of_birth      = $_POST['date_of_birth'];
            $marital_status     = $_POST['marital_status'];
            $gender             = $_POST['gender'];
            $income_level       = $_POST['income_level'];

            // Crear una nueva instancia de Customer con los valores del formulario
            $customer = new Customer(
                $customer_id,
                convertToNull($cust_first_name),
                convertToNull($cust_last_name),
                convertToNull($cust_street_address),
                convertToNull($cust_postal_code),
                convertToNull($cust_city),
                convertToNull($cust_state),
                convertToNull($cust_country),
                convertToNull($phone_numbers),
                convertToNull($nls_language),
                convertToNull($nls_territory),
                convertToNull($credit_limit),
                convertToNull($cust_email),
                convertToNull($account_mgr_id),
                convertToNull($cust_geo_location),
                convertToNull($date_of_birth),
                convertToNull($marital_status),
                convertToNull($gender),
                convertToNull($income_level)
            );

            // Guardar el cliente en la base de datos
            $customer->save(); // INSERT / UPDATE
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
	<link rel="stylesheet" href="../../src/css/index.css">
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

        <label>Idioma (NLS):</label><br>
        <input type="text" name="nls_language"><br><br>

        <label>Territorio (NLS):</label><br>
        <input type="text" name="nls_territory"><br><br>

        <label>Límite de Crédito:</label><br>
        <input type="number" name="credit_limit" step="0.01"><br><br>

        <label>Email:</label><br>
        <input type="email" name="cust_email"><br><br>

        <label>ID del Gerente de Cuenta:</label><br>
        <input type="number" name="account_mgr_id"><br><br>

        <label>Ubicación Geográfica:</label><br>
        <input type="text" name="cust_geo_location"><br><br>

        <label>Fecha de Nacimiento:</label><br>
        <input type="date" name="date_of_birth"><br><br>

        <label>Estado Civil:</label><br>
        <input type="text" name="marital_status"><br><br>

        <label>Género:</label><br>
        <input type="text" name="gender"><br><br>

        <label>Nivel de Ingreso:</label><br>
        <input type="text" name="income_level"><br><br>

        <input type="submit" value="Añadir Cliente">
    </form>
</body>
</html>
