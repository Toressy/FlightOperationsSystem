<?php
class Database {
    // Static property to hold the single instance of the class.
    private static $instance;
    // Property to hold the database connection.
    private $db;

    // Private constructor to prevent direct creation of objects (singleton pattern).
    private function __construct($host, $user, $pass, $name) {
        // Establish a connection to the MySQL database.
        $this->db = new mysqli($host, $user, $pass, $name);
        // Check for connection errors and handle them.
        if ($this->db->connect_errno) {
            echo "Failed to connect to MySQL: " . $this->db->connect_error;
            exit();
        }
        // Set the character set to utf8mb4 for the connection.
        $this->db->set_charset("utf8mb4");
    }
    // Public static method to get the single instance of the class.
    public static function getInstance($host, $user, $pass, $name) {
        if (!self::$instance) {
            self::$instance = new self($host, $user, $pass, $name);
        }
        return self::$instance;
    }

    // Public method to get the database connection.
    public function getConnection() {
        return $this->db;
    }
}

// Database connection parameters.
$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "Airlane";

// Get the single instance of the Database class and establish the connection.
$database = Database::getInstance($DB_host, $DB_user, $DB_pass, $DB_name);

// Include the CRUD class files.
include_once 'crud_classes/flight.crud.php';
include_once 'crud_classes/staff.crud.php';
include_once 'crud_classes/pilot.crud.php';
include_once 'crud_classes/plane.crud.php';
include_once 'crud_classes/passenger.crud.php';
include_once 'crud_classes/schedule.crud.php';
include_once 'crud_classes/booking.crud.php';
include_once 'crud_classes/city.crud.php';

// Create instances of CRUD classes, passing the database connection to each.
$flightCrud = new FlightCrud($database);
$staffCrud  = new StaffCrud($database);
$pilotCrud  = new PilotCrud($database);
$planeCrud  = new PlaneCrud($database);
$passengerCrud  = new PassengerCrud($database);
$bookingCrud  = new BookingCrud($database);
$scheduleCrud  = new ScheduleCrud($database);
$cityCrud = new CityCrud($database);