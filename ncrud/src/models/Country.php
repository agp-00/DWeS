<?php

namespace models;

use config\Database;

class Country extends Model {
    // Definir la tabla asociada a la clase
    protected static $table = 'countries';

    // Constructor
    public function __construct(
        public ?string $country_id = null,
        public ?string $country_name = null,
        public ?string $country_code = null,
        public ?string $region_id = null
    ) { }

    // Método para guardar el país en la base de datos
    public function save() {
        error_reporting(E_ALL);
        try {
            $db = new Database();
            $db->connectDB('C:/temp/config.db');

            $table = static::$table;

            if (isset($this->country_id)) {
                // Preparar la consulta INSERT / UPDATE
                $sql = "INSERT INTO $table (
                    country_id, country_name, country_code, region
                ) VALUES (
                    ?, ?, ?, ?
                ) ON DUPLICATE KEY UPDATE
                    country_name = VALUES(country_name),
                    country_code = VALUES(country_code),
                    region = VALUES(region)";
                
                $stmt = $db->conn->prepare($sql);

                // Vincular los valores
                $stmt->bind_param(
                    "isss",
                    $this->country_id,
                    $this->country_name,
                    $this->country_code,
                    $this->region
                );

                $stmt->execute();
            } else {
                throw new \Exception("ID de país no informado.");
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

    // Método para eliminar el país de la base de datos
    public function destroy() {
        error_reporting(E_ALL);
        try {
            $db = new Database();
            $db->connectDB('C:/temp/config.db');

            $table = static::$table;

            if (isset($this->country_id)) {
                $sql = "SELECT * FROM $table WHERE country_id = $this->country_id";
                $result = $db->conn->query($sql);

                if ($result->num_rows == 1) {
                    $sql = "DELETE FROM $table WHERE country_id = ?";
                    $stmt = $db->conn->prepare($sql);
                    $stmt->bind_param("i", $this->country_id);
                    $stmt->execute();
                } else {
                    throw new \Exception("El país no existe.");
                }
            } else {
                throw new \Exception("ID de país no informado.");
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

    public static function getUniqueRegions() {
        try {
            $db = new Database();
            $db->connectDB('C:/temp/config.db');

            // Obtener valores únicos de 'region' en la tabla 'countries'
            $sql = "SELECT DISTINCT region FROM " . static::$table . " WHERE region IS NOT NULL";
            $result = $db->conn->query($sql);

            $regions = [];
            while ($row = $result->fetch_assoc()) {
                $regions[] = $row['region'];
            }
            return $regions;
        } catch (\Exception $e) {
            throw new \Exception("Error al obtener las regiones únicas: " . $e->getMessage());
        } finally {
            if ($db->conn)
                $db->closeDB();
        }
    }
}

?>
