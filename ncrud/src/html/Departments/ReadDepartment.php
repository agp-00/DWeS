<?php
    require '../../../vendor/autoload.php';
    use models\Department;

    if (isset($_GET['action']) && $_GET['action'] == 'view_departments') {
        try {
            $departments = Department::all();
            echo "<h2>Lista de Departamentos</h2>";
            echo "<a href='../../../index.php'>
            <button type='button'>Inicio</button>
          </a>
          <br><br>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th> <th>Nombre</th> <th>ID del Gerente</th>
                      <th>Ubicación</th> <th>Acción</th></tr>";
            foreach ($departments as $department) {
                echo "<tr>";
                echo "<td>{$department->department_id}</td>";
                echo "<td>{$department->department_name}</td>";
                echo "<td>{$department->manager_id}</td>";
                echo "<td>{$department->location_id}</td>";
                echo "<td><a href='DeleteDepartment.php?id={$department->department_id}'>
                                <button class='button'>Eliminar departamento</button>  
                        </a></td>";
                echo "</tr>";
            }
            echo "</table>";
            
            echo "<br><br>";
            echo "<a href='../../../index.php'>
            <button type='button'>Inicio</button>
          </a>";
          
        } catch (\Exception $e) {
            echo "Se ha producido el siguiente error:" . "<br>" . $e->getMessage();
        }
    }
?>
