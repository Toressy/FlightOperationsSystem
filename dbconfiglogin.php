<?php
class Database {
    private static $instance;
    private $db;

    private function __construct($host, $user, $pass, $name) {
        $this->db = new mysqli($host, $user, $pass, $name);

        if ($this->db->connect_errno) {
            echo "Failed to connect to MySQL: " . $this->db->connect_error;
            exit();
        }

        $this->db->set_charset("utf8mb4");
    }

    public static function getInstance($host, $user, $pass, $name) {
        if (!self::$instance) {
            self::$instance = new self($host, $user, $pass, $name);
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->db;
    }
}

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "LoginDB";


$database = Database::getInstance($DB_host, $DB_user, $DB_pass, $DB_name);
