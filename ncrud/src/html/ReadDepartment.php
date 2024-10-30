<?php
    require '../../vendor/autoload.php';
    use models\Department;

    if (isset($_GET['action']) && $_GET['action'] == 'view_departments') {
        try {
            $departments = Department::all();
            echo "<h2>Llista de Departaments</h2>";
            echo "<a href='../../index.php'>
            <button type='button'>Inicio</button>
          </a>
          <br><br>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Nom</th><th>ID del Gerent</th><th>Ubicació</th></tr>";
            foreach ($departments as $department) {
                echo "<tr>";
                echo "<td>{$department->department_id}</td>";
                echo "<td>{$department->department_name}</td>";
                echo "<td>{$department->manager_id}</td>";
                echo "<td>{$department->location_id}</td>";
                echo "<td><a href='DeleteDepartment.php?id={$department->department_id}'>
                                <button type='button'>Eliminar departament</button>  
                        </a></td>";
                echo "</tr>";
            }
            echo "</table>";
            
            echo "<br><br>";
            echo "<a href='../../index.php'>
            <button type='button'>Inicio</button>
          </a>";
          
        } catch (\Exception $e) {
            echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
        }
    }
?>
