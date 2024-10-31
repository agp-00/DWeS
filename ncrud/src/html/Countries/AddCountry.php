<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de País</title>
    <link rel="stylesheet" href="../../../src/css/AddCountry.css">
</head>
<body>
    <h1>Añadir un Nuevo País</h1>
    <form method="POST" action="">
        <label>ID País:</label><br>
        <input type="number" name="country_id" required><br><br>

        <label>Nombre del País:</label><br>
        <input type="text" name="country_name" required><br><br>

        <label>Región:</label><br>
        <input type="text" name="region" required><br><br>

        <button type="button" onclick="window.location.href='../../../index.php'">Cancelar</button>
        <input type="submit" value="Añadir País">
    </form>
</body>
</html>
