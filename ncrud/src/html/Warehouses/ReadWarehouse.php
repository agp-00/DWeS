<?php
    require '../../../vendor/autoload.php';
    use models\Warehouse;

    if (isset($_GET['action']) && $_GET['action'] == 'view_warehouses') {
        try {
            $warehouses = Warehouse::all();
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
                <title>Lista de Almacenes</title>
            </head>
            <body>
            <div class='container'>
                <h2 class='my-4'>Lista de Almacenes</h2>
                <a href='../../../index.php' class='btn btn-primary mb-3'>Inicio</a>
                <table class='table table-bordered'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>";
            foreach ($warehouses as $warehouse) {
                echo "<tr>
                        <td>{$warehouse->warehouse_id}</td>
                        <td>{$warehouse->warehouse_name}</td>
                        <td>
                            <a href='DeleteWarehouse.php?id={$warehouse->warehouse_id}' class='btn btn-danger'>Eliminar almacén</a>
                        </td>
                      </tr>";
            }
            echo "    </tbody>
                </table>
                <a href='../../../index.php' class='btn btn-primary mt-3'>Inicio</a>
            </div>
            <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
            <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js'></script>
            <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
            </body>
            </html>";
        } catch (\Exception $e) {
            echo "Se ha producido el siguiente error:" . "<br>" . $e->getMessage();
        }
    }
?>
