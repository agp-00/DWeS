<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Departamento</title>
    <link rel="stylesheet" href="../../../src/css/AddDepartment.css">
</head>
<body>
    <h1>Añadir un Nuevo Departamento</h1>
    <form method="POST" action="">
        <label>ID Departamento:</label><br>
        <input type="number" name="department_id" required><br><br>

        <label>Nombre del Departamento:</label><br>
        <input type="text" name="department_name" required><br><br>

        <label>Ubicación:</label><br>
        <input type="text" name="location"><br><br>

        <label>Gerente del Departamento:</label><br>
        <select name="manager_id">
            <option value="">Selecciona un gerente</option>
            <option value="1">Gerente 1</option>
            <option value="2">Gerente 2</option>
        </select><br><br>

        <button type="button" onclick="window.location.href='../../../index.php'">Cancelar</button>
        <input type="submit" value="Añadir Departamento">
    </form>
</body>
</html>
