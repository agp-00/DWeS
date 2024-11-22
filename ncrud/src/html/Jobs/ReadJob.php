<?php
require '../../../vendor/autoload.php';
use models\Job;

if (isset($_GET['action']) && $_GET['action'] == 'view_jobs') {
    try {
        $jobs = Job::all();
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Lista de Trabajos</title>
            <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body>
        <div class='container'>
            <h2 class='my-4'>Lista de Trabajos</h2>
            <a href='../../../index.php' class='btn btn-primary mb-3'>Inicio</a>
            <table class='table table-bordered'>
                <thead class='thead-dark'>
                    <tr>
                        <th>ID de Trabajo</th>
                        <th>Título de Trabajo</th>
                        <th>Salario Mínimo</th>
                        <th>Salario Máximo</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($jobs as $job) {
            echo "<tr>
                    <td>{$job->job_id}</td>
                    <td>{$job->job_title}</td>
                    <td>{$job->min_salary}</td>
                    <td>{$job->max_salary}</td>
                    <td><a href='DeleteJob.php?id={$job->job_id}' class='btn btn-danger'>Eliminar trabajo</a></td>
                </tr>";
        }
        echo "</tbody>
            </table>
            <a href='../../../index.php' class='btn btn-primary mt-3'>Inicio</a>
        </div>
        <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js'></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
        </body>
        </html>";
    } catch (\Exception $e) {
        echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
    }
}
?>
