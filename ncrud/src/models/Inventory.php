<?php

namespace models;

use config\Database;

class Inventory extends Model {
    // Definir la taula associada a la classe
    protected static $table = 'inventories';

    // Constructor
    public function __construct(    
        public ?int $inventory_id=null,
        public ?string $inventory_name=null,
        public ?int $quantity=null,
        public ?float $price=null
    ) { 
        $this->inventory_id = $inventory_id;
        $this->inventory_name = $inventory_name;
        $this->quantity = $quantity !== null ? (int)$quantity : null;
        $this->price = $price !== null ? (float)$price : null;
    }

    // Mètode per guardar l'inventari a la base de dades
    public function save() {
        error_reporting(E_ALL);
        try {
            // Connectar a la base de dades
            $db = new Database();
            $db->connectDB('C:/temp/config.db');

            // Obtenir el nom de la taula de la classe filla
            $table = static::$table; 

            // Connectar a la base de dades
            if (isset($this->inventory_id)) {
                // Preparar l'INSERT / UPDATE
                $sql = "INSERT INTO $table (inventory_id, inventory_name, quantity, price) 
                        VALUES (?, ?, ?, ?)
                        ON DUPLICATE KEY UPDATE
                            inventory_name = VALUES (inventory_name),
                            quantity = VALUES (quantity),
                            price = VALUES (price)";
                $stmt = $db->conn->prepare($sql);
                // Vincular els valors
                $stmt->bind_param( "isid", 
                                        $this->inventory_id, 
                                        $this->inventory_name, 
                                        $this->quantity, 
                                        $this->price
                                    );

                // Executar la consulta
                $stmt->execute();
            } else {
                throw new \Exception ("ID inventari no informat.");
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
    
    // Mètode per eliminar l'inventari a la base de dades
    public function destroy() {
        error_reporting(E_ALL);
        try {
            // Connectar a la base de dades
            $db = new Database();
            $db->connectDB('C:/temp/config.db');

            // Obtenir el nom de la taula de la classe filla
            $table = static::$table; 

            if (isset($this->inventory_id)) {
                $sql = "SELECT * FROM $table WHERE inventory_id = $this->inventory_id";
                $result = $db->conn->query($sql);

                // Comprovar si hi ha resultats
                if ($result->num_rows == 1) {
                    $sql = "DELETE FROM $table 
                            WHERE inventory_id = ?";
                    $stmt = $db->conn->prepare($sql);
                    // Vincular els valors
                    $stmt->bind_param( "i", $this->inventory_id );
                    // Executar la consulta
                    $stmt->execute();
                } else {
                    throw new \Exception ("L'inventari no existeix.");
                }
            } else {
                throw new \Exception ("ID inventari no informat.");
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
