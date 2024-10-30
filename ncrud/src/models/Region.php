<?php

    namespace models;

    use config\Database;

    class Region extends Model {
        // Definir la taula associada a la classe
        protected static $table = 'regions';

        // Constructor
        public function __construct(    
            public ?int $region_id=null,
            public ?string $region_name=null
        ) { }

        // Mètode per guardar la regió a la base de dades
        public function save() {
            error_reporting(E_ALL);
            try {
                // Connectar a la base de dades
                $db = new Database();
                $db->connectDB('C:/temp/config.db');
                //$db->conn->autocommit(false);
                //$db->conn->begin_transaction();

                // Obtenir el nom de la taula de la classe filla
                $table = static::$table; 

                // Connectar a la base de dades
                if (isset($this->region_id)) {
                    // Preparar l'INSERT / UPDATE
                    $sql = "INSERT INTO $table (region_id, region_name) 
                            VALUES (?, ?)
                            ON DUPLICATE KEY UPDATE
                                region_name = VALUES (region_name)";
                    $stmt = $db->conn->prepare($sql);
                    // Vincular els valors
                    $stmt->bind_param( "is", 
                                            $this->region_id, 
                                            $this->region_name
                                        );

                    // Executar la consulta
                    $stmt->execute();
                } else {
                    throw new \Exception ("ID regió no informat.");
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
        
        // Mètode per eliminar la regió a la base de dades
        public function destroy() {
            error_reporting(E_ALL);
            try {
                // Connectar a la base de dades
                $db = new Database();
                $db->connectDB('C:/temp/config.db');
                //$db->conn->autocommit(false);
                //$db->conn->begin_transaction();

                // Obtenir el nom de la taula de la classe filla
                $table = static::$table; 

                if (isset($this->region_id)) {
                    $sql = "SELECT * FROM $table WHERE region_id = $this->region_id";
                    $result = $db->conn->query($sql);

                    // Comprovar si hi ha resultats
                    if ($result->num_rows == 1) {
                        $sql = "DELETE FROM $table 
                                WHERE region_id = ?";
                        $stmt = $db->conn->prepare($sql);
                        // Vincular els valors
                        $stmt->bind_param( "i", $this->region_id );
                        // Executar la consulta
                        $stmt->execute();
                    } else {
                        throw new \Exception ("La regió no existeix.");
                    }
                } else {
                    throw new \Exception ("ID regió no informat.");
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
