<?php
    require '../../../vendor/autoload.php';
    use models\Job;

        if (isset($_GET['action']) && $_GET['action'] == 'view_jobs') {
            try {
                $jobs = Job::all();
                echo "<h2>Lista de Trabajos</h2>";
                echo "<a href='../../../index.php'>
                <button type='button'>Inicio</button>
              </a>
              <br><br>";
                echo "<table border='1'>";
                echo "<tr><th>ID de Trabajo</th><th>Título de Trabajo</th>
                            <th>Salario Mínimo</th><th>Salario Máximo</th>
                            <th>Acción</th></tr>";
                foreach ($jobs as $job) {
                    echo "<tr>";
                    echo "<td>{$job->job_id}</td>";
                    echo "<td>{$job->job_title}</td>";
                    echo "<td>{$job->min_salary}</td>";
                    echo "<td>{$job->max_salary}</td>";
                    echo "<td><a href='DeleteJob.php?id={$job->job_id}'>
                                    <button type='button'>Eliminar trabajo</button>  
                            </a></td>";

                    echo "</tr>";
                }
                echo "</table>";
                
                echo "<br><br>";
                echo "<a href='../../../index.php'>
                <button type='button'>Inicio</button>
              </a>";
              
            } catch (\Exception $e) {
                echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
            }
        }
        ?>
