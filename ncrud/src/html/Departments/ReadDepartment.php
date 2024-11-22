<?php
    require '../../../vendor/autoload.php';
    use models\Department;

    if (isset($_GET['action']) && $_GET['action'] == 'view_departments') {
        try {
            $departments = Department::all();
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Lista de Departamentos</title>
                <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
            </head>
            <body>
            <div class='container mt-5'>
                <h2 class='mb-4'>Lista de Departamentos</h2>
                <a href='../../../index.php' class='btn btn-primary mb-3'>Inicio</a>
                <table class='table table-bordered'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>ID del Gerente</th>
                            <th>Ubicación</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>";
            foreach ($departments as $department) {
                echo "<tr>
                        <td>{$department->department_id}</td>
                        <td>{$department->department_name}</td>
                        <td>{$department->manager_id}</td>
                        <td>{$department->location_id}</td>
                        <td>
                            <a href='DeleteDepartment.php?id={$department->department_id}' class='btn btn-danger'>Eliminar departamento</a>
                        </td>
                    </tr>";
            }
            echo "      </tbody>
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
