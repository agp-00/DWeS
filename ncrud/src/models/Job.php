<?php

    namespace models;

    use config\Database;

    class Job extends Model {
        // Definir la taula associada a la classe
        protected static $table = 'jobs';

        // Constructor
        public function __construct(    
            public ?string $job_id=null,
            public ?string $job_title=null,
            public ?int $min_salary=null,
            public ?int $max_salary=null
        ) { 
            $this->job_id = $job_id;
            $this->job_title = $job_title;
            $this->min_salary = $min_salary !== null ? (int)$min_salary : null;
            $this->max_salary = $max_salary !== null ? (int)$max_salary : null;
        }

        // Mètode per guardar el treball a la base de dades
        public function save() {
            error_reporting(E_ALL);
            try {
                // Connectar a la base de dades
                $db = new Database();
                $db->connectDB('C:/temp/config.db');

                // Obtenir el nom de la taula de la classe filla
                $table = static::$table; 

                // Connectar a la base de dades
                if (isset($this->job_id)) {
                    // Preparar l'INSERT / UPDATE
                    $sql = "INSERT INTO $table (job_id, job_title, min_salary, max_salary) 
                            VALUES (?, ?, ?, ?)
                            ON DUPLICATE KEY UPDATE
                                job_title = VALUES (job_title),
                                min_salary = VALUES (min_salary),
                                max_salary = VALUES (max_salary)";
                    $stmt = $db->conn->prepare($sql);
                    // Vincular els valors
                    $stmt->bind_param( "isii", 
                                            $this->job_id, 
                                            $this->job_title, 
                                            $this->min_salary, 
                                            $this->max_salary
                                        );

                    // Executar la consulta
                    $stmt->execute();
                } else {
                    throw new \Exception ("ID treball no informat.");
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
        
        // Mètode per eliminar el treball a la base de dades
        public function destroy() {
            error_reporting(E_ALL);
            try {
                // Connectar a la base de dades
                $db = new Database();
                $db->connectDB('C:/temp/config.db');

                // Obtenir el nom de la taula de la classe filla
                $table = static::$table; 

                if (isset($this->job_id)) {
                    $sql = "SELECT * FROM $table WHERE job_id = $this->job_id";
                    $result = $db->conn->query($sql);

                    // Comprovar si hi ha resultats
                    if ($result->num_rows == 1) {
                        $sql = "DELETE FROM $table 
                                WHERE job_id = ?";
                        $stmt = $db->conn->prepare($sql);
                        // Vincular els valors
                        $stmt->bind_param( "i", $this->job_id );
                        // Executar la consulta
                        $stmt->execute();
                    } else {
                        throw new \Exception ("El treball no existeix.");
                    }
                } else {
                    throw new \Exception ("ID treball no informat.");
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
