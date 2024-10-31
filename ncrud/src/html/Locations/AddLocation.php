<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Ubicación</title>
    <link rel="stylesheet" href="../../../src/css/AddLocation.css">
</head>
<body>
    <h1>Añadir una Nueva Ubicación</h1>
    <form method="POST" action="">
        <label>ID Ubicación:</label><br>
        <input type="number" name="location_id" required><br><br>

        <label>Dirección:</label><br>
        <input type="text" name="street_address" required><br><br>

        <label>Código Postal:</label><br>
        <input type="text" name="postal_code" required><br><br>

        <label>Ciudad:</label><br>
        <input type="text" name="city" required><br><br>

        <label>Estado:</label><br>
        <input type="text" name="state_province" required><br><br>

        <label>País:</label><br>
        <input type="text" name="country_id" required><br><br>
       
        <button type="button" onclick="window.location.href='../../../index.php'">Cancelar</button>
        <input type="submit" value="Añadir Ubicación">
    </form>
</body>
</html>
