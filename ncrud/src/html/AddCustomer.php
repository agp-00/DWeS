<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Cliente</title>
    <link rel="stylesheet" href="../../src/css/AddCustomer.css">
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
            <option value="">Selecciona un gerente</option>
            <option value="1">Gerente 1</option>
            <option value="2">Gerente 2</option>
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

        <input type="submit" value="Añadir Cliente">
        <button type="button" onclick="window.location.href='../../index.php'">Cancelar</button>
    </form>
</body>
</html>
