<?php

namespace models;

use config\Database;

class Customer extends Model {
    // Definir la tabla asociada a la clase
    protected static $table = 'customers';

    // Constructor
    public function __construct(
        public ?int $customer_id = null,
        public ?string $cust_first_name = null,
        public ?string $cust_last_name = null,
        public ?string $cust_street_address = null,
        public ?string $cust_postal_code = null,
        public ?string $cust_city = null,
        public ?string $cust_state = null,
        public ?string $cust_country = null,
        public ?string $phone_numbers = null,
        public ?string $nls_language = null,
        public ?string $nls_territory = null,
        public ?float $credit_limit = null,
        public ?string $cust_email = null,
        public ?int $account_mgr_id = null,
        public ?string $cust_geo_location = null,
        public ?string $date_of_birth = null,
        public ?string $marital_status = null,
        public ?string $gender = null,
        public ?string $income_level = null
    ) { }

    // Método para guardar el cliente en la base de datos
    public function save() {
        error_reporting(E_ALL);
        try {
            $db = new Database();
            $db->connectDB('C:/temp/config.db');


            $table = static::$table;

            if (isset($this->customer_id)) {
                // Preparar la consulta INSERT / UPDATE
                $sql = "INSERT INTO $table (
                    customer_id, cust_first_name, cust_last_name, cust_street_address, cust_postal_code, cust_city, cust_state, cust_country, phone_numbers, nls_language, nls_territory, credit_limit, cust_email, account_mgr_id, cust_geo_location, date_of_birth, marital_status, gender, income_level
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                ) ON DUPLICATE KEY UPDATE
                    cust_first_name = VALUES(cust_first_name),
                    cust_last_name = VALUES(cust_last_name),
                    cust_street_address = VALUES(cust_street_address),
                    cust_postal_code = VALUES(cust_postal_code),
                    cust_city = VALUES(cust_city),
                    cust_state = VALUES(cust_state),
                    cust_country = VALUES(cust_country),
                    phone_numbers = VALUES(phone_numbers),
                    nls_language = VALUES(nls_language),
                    nls_territory = VALUES(nls_territory),
                    credit_limit = VALUES(credit_limit),
                    cust_email = VALUES(cust_email),
                    account_mgr_id = VALUES(account_mgr_id),
                    cust_geo_location = VALUES(cust_geo_location),
                    date_of_birth = VALUES(date_of_birth),
                    marital_status = VALUES(marital_status),
                    gender = VALUES(gender),
                    income_level = VALUES(income_level)";
                
                $stmt = $db->conn->prepare($sql);

                // Vincular los valores
                $stmt->bind_param(
                    "issssssssssfsisssss",
                    $this->customer_id,
                    $this->cust_first_name,
                    $this->cust_last_name,
                    $this->cust_street_address,
                    $this->cust_postal_code,
                    $this->cust_city,
                    $this->cust_state,
                    $this->cust_country,
                    $this->phone_numbers,
                    $this->nls_language,
                    $this->nls_territory,
                    $this->credit_limit,
                    $this->cust_email,
                    $this->account_mgr_id,
                    $this->cust_geo_location,
                    $this->date_of_birth,
                    $this->marital_status,
                    $this->gender,
                    $this->income_level
                );

                $stmt->execute();
            } else {
                throw new \Exception("ID de cliente no informado.");
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

    // Método para eliminar el cliente de la base de datos
    public function destroy() {
        error_reporting(E_ALL);
        try {
            $db = new Database();
            $db->connectDB('C:/temp/config.db');

            $table = static::$table;

            if (isset($this->customer_id)) {
                $sql = "SELECT * FROM $table WHERE customer_id = $this->customer_id";
                $result = $db->conn->query($sql);

                if ($result->num_rows == 1) {
                    $sql = "DELETE FROM $table WHERE customer_id = ?";
                    $stmt = $db->conn->prepare($sql);
                    $stmt->bind_param("i", $this->customer_id);
                    $stmt->execute();
                } else {
                    throw new \Exception("El cliente no existe.");
                }
            } else {
                throw new \Exception("ID de cliente no informado.");
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

    public static function getUniqueGenders() {
        try {
            $db = new Database();
            $db->connectDB('C:/temp/config.db');

            // Obtener valores únicos de 'gender' en la tabla 'customers'
            $sql = "SELECT DISTINCT gender FROM " . static::$table . " WHERE gender IS NOT NULL";
            $result = $db->conn->query($sql);

            $genders = [];
            while ($row = $result->fetch_assoc()) {
                $genders[] = $row['gender'];
            }
            return $genders;
        } catch (\Exception $e) {
            throw new \Exception("Error al obtener los géneros únicos: " . $e->getMessage());
        } finally {
            if ($db->conn)
                $db->closeDB();
        }
    }
}

?>
