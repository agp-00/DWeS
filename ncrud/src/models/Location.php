<?php

namespace models;

use config\Database;

class Location extends Model {
    // Definir la tabla asociada a la clase
    protected static $table = 'locations';

    // Constructor
    public function __construct(
        public ?int $location_id = null,
        public ?string $street_address = null,
        public ?string $postal_code = null,
        public ?string $city = null,
        public ?string $state_province = null,
        public ?string $country_id = null
    ) { }

    // Método para guardar la ubicación en la base de datos
    public function save() {
        error_reporting(E_ALL);
        try {
            $db = new Database();
            $db->connectDB('C:/temp/config.db');

            $table = static::$table;

            if (isset($this->location_id)) {
                // Preparar la consulta INSERT / UPDATE
                $sql = "INSERT INTO $table (
                    location_id, street_address, postal_code, city, state_province, country_id
                ) VALUES (
                    ?, ?, ?, ?, ?, ?
                ) ON DUPLICATE KEY UPDATE
                    street_address = VALUES(street_address),
                    postal_code = VALUES(postal_code),
                    city = VALUES(city),
                    state_province = VALUES(state_province),
                    country_id = VALUES(country_id)";
                
                $stmt = $db->conn->prepare($sql);

                // Vincular los valores
                $stmt->bind_param(
                    "isssss",
                    $this->location_id,
                    $this->street_address,
                    $this->postal_code,
                    $this->city,
                    $this->state_province,
                    $this->country_id
                );

                $stmt->execute();
            } else {
                throw new \Exception("ID de ubicación no informado.");
            }

            $db->conn->commit();
        } catch (\mysqli_sql_exception $e) {
            if ($db->conn)
                $db->conn->rollback();
            throw new \mysqli_sql_exception($e->getMessage());
        } finally {
            if ($db->conn)
                $db->closeDB();
        }
    }

    // Método para eliminar la ubicación de la base de datos
    public function destroy() {
        error_reporting(E_ALL);
        try {
            $db = new Database();
            $db->connectDB('C:/temp/config.db');

            $table = static::$table;

            if (isset($this->location_id)) {
                $sql = "SELECT * FROM $table WHERE location_id = $this->location_id";
                $result = $db->conn->query($sql);

                if ($result->num_rows == 1) {
                    $sql = "DELETE FROM $table WHERE location_id = ?";
                    $stmt = $db->conn->prepare($sql);
                    $stmt->bind_param("i", $this->location_id);
                    $stmt->execute();
                } else {
                    throw new \Exception("La ubicación no existe.");
                }
            } else {
                throw new \Exception("ID de ubicación no informado.");
            }

            $db->conn->commit();
        } catch (\mysqli_sql_exception $e) {
            if ($db->conn)
                $db->conn->rollback();
            throw new \mysqli_sql_exception($e->getMessage());
        } finally {
            if ($db->conn)
                $db->closeDB();
        }
    }

    public static function getUniqueCities() {
        try {
            $db = new Database();
            $db->connectDB('C:/temp/config.db');

            // Obtener valores únicos de 'city' en la tabla 'locations'
            $sql = "SELECT DISTINCT city FROM " . static::$table . " WHERE city IS NOT NULL";
            $result = $db->conn->query($sql);

            $cities = [];
            while ($row = $result->fetch_assoc()) {
                $cities[] = $row['city'];
            }
            return $cities;
        } catch (\Exception $e) {
            throw new \Exception("Error al obtener las ciudades únicas: " . $e->getMessage());
        } finally {
            if ($db->conn)
                $db->closeDB();
        }
    }
}

?>
