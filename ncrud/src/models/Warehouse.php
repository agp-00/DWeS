<?php

namespace models;

use config\Database;

class Warehouse extends Model {
    // Definir la taula associada a la classe
    protected static $table = 'warehouses';

    // Constructor
    public function __construct(    
        public ?int $warehouse_id=null,
        public ?string $warehouse_name=null,
        public ?string $location=null
    ) { 
        $this->warehouse_id = $warehouse_id;
        $this->warehouse_name = $warehouse_name;
        $this->location = $location;
    }

    // Mètode per guardar el magatzem a la base de dades
    public function save() {
        error_reporting(E_ALL);
        try {
            // Connectar a la base de dades
            $db = new Database();
            $db->connectDB('C:/temp/config.db');

            // Obtenir el nom de la taula de la classe filla
            $table = static::$table; 

            // Connectar a la base de dades
            if (isset($this->warehouse_id)) {
                // Preparar l'INSERT / UPDATE
                $sql = "INSERT INTO $table (warehouse_id, warehouse_name, location) 
                        VALUES (?, ?, ?)
                        ON DUPLICATE KEY UPDATE
                            warehouse_name = VALUES (warehouse_name),
                            location = VALUES (location)";
                $stmt = $db->conn->prepare($sql);
                // Vincular els valors
                $stmt->bind_param( "iss", 
                                        $this->warehouse_id, 
                                        $this->warehouse_name, 
                                        $this->location
                                    );

                // Executar la consulta
                $stmt->execute();
            } else {
                throw new \Exception ("ID magatzem no informat.");
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
    
    // Mètode per eliminar el magatzem a la base de dades
    public function destroy() {
        error_reporting(E_ALL);
        try {
            // Connectar a la base de dades
            $db = new Database();
            $db->connectDB('C:/temp/config.db');

            // Obtenir el nom de la taula de la classe filla
            $table = static::$table; 

            if (isset($this->warehouse_id)) {
                $sql = "SELECT * FROM $table WHERE warehouse_id = $this->warehouse_id";
                $result = $db->conn->query($sql);

                // Comprovar si hi ha resultats
                if ($result->num_rows == 1) {
                    $sql = "DELETE FROM $table 
                            WHERE warehouse_id = ?";
                    $stmt = $db->conn->prepare($sql);
                    // Vincular els valors
                    $stmt->bind_param( "i", $this->warehouse_id );
                    // Executar la consulta
                    $stmt->execute();
                } else {
                    throw new \Exception ("El magatzem no existeix.");
                }
            } else {
                throw new \Exception ("ID magatzem no informat.");
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
