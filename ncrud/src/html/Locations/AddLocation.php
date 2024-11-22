<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Ubicación</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../src/css/AddLocation.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Añadir una Nueva Ubicación</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="location_id">ID Ubicación:</label>
                <input type="number" class="form-control" id="location_id" name="location_id" required>
            </div>

            <div class="form-group">
                <label for="street_address">Dirección:</label>
                <input type="text" class="form-control" id="street_address" name="street_address" required>
            </div>

            <div class="form-group">
                <label for="postal_code">Código Postal:</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" required>
            </div>

            <div class="form-group">
                <label for="city">Ciudad:</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>

            <div class="form-group">
                <label for="state_province">Estado:</label>
                <input type="text" class="form-control" id="state_province" name="state_province" required>
            </div>

            <div class="form-group">
                <label for="country_id">País:</label>
                <input type="text" class="form-control" id="country_id" name="country_id" required>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='../../../index.php'">Cancelar</button>
                <input type="submit" class="btn btn-primary" value="Añadir Ubicación">
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
