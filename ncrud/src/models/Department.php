<?php

    namespace models;

    use config\Database;

    class Department extends Model {
        // Definir la taula associada a la classe
        protected static $table = 'departments';

        // Constructor
        public function __construct(    
            public ?int $department_id=null,
            public ?string $department_name=null,
            public ?int $manager_id=null,
            public ?int $location_id=null
        ) { }

        // Mètode per guardar el departament a la base de dades
        public function save() {
            error_reporting(E_ALL);
            try {
                // Connectar a la base de dades
                $db = new Database();
                $db->connectDB('C:/temp/config.db');

                // Obtenir el nom de la taula de la classe filla
                $table = static::$table; 

                // Connectar a la base de dades
                if (isset($this->department_id)) {
                    // Preparar l'INSERT / UPDATE
                    $sql = "INSERT INTO $table (department_id, department_name, manager_id, location_id) 
                            VALUES (?, ?, ?, ?)
                            ON DUPLICATE KEY UPDATE
                                department_name = VALUES (department_name),
                                manager_id      = VALUES (manager_id),
                                location_id     = VALUES (location_id)";
                    $stmt = $db->conn->prepare($sql);
                    // Vincular els valors
                    $stmt->bind_param( "isii", 
                                            $this->department_id, 
                                            $this->department_name, 
                                            $this->manager_id, 
                                            $this->location_id
                                        );

                    // Executar la consulta
                    $stmt->execute();
                } else {
                    throw new \Exception ("ID departament no informat.");
                }

                $db->conn->commit();
            } catch (\mysqli_sql_exception $e) {
                if ($db->conn)
                    $db->conn->rollback(); 
                throw new \mysqli_sql_exception($e->getMessage());
            } finally {
                if ($db->conn)
                    // Tancar la connexió
                    $db->closeDB();         				 
            }
        }
        
        // Mètode per eliminar el departament a la base de dades
        public function destroy() {
            error_reporting(E_ALL);
            try {
                // Connectar a la base de dades
                $db = new Database();
                $db->connectDB('C:/temp/config.db');

                // Obtenir el nom de la taula de la classe filla
                $table = static::$table; 

                if (isset($this->department_id)) {
                    $sql = "SELECT * FROM $table WHERE department_id = $this->department_id";
                    $result = $db->conn->query($sql);

                    // Comprovar si hi ha resultats
                    if ($result->num_rows == 1) {
                        $sql = "DELETE FROM $table 
                                WHERE department_id = ?";
                        $stmt = $db->conn->prepare($sql);
                        // Vincular els valors
                        $stmt->bind_param( "i", $this->department_id );
                        // Executar la consulta
                        $stmt->execute();
                    } else {
                        throw new \Exception ("El departament no existeix.");
                    }
                } else {
                    throw new \Exception ("ID departament no informat.");
                }
                $db->conn->commit();
            } catch (\mysqli_sql_exception $e) {
                if ($db->conn)
                    $db->conn->rollback(); 
                throw new \mysqli_sql_exception($e->getMessage());
            } finally {
                if ($db->conn)
                    // Tancar la connexió
                    $db->closeDB();         				 
            }
        }
    }
?>
