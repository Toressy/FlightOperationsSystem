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
$DB_name = "Airlane";

$database = Database::getInstance($DB_host, $DB_user, $DB_pass, $DB_name);

include_once 'crud_classes/flight.crud.php';
include_once 'crud_classes/staff.crud.php';
include_once 'crud_classes/pilot.crud.php';
include_once 'crud_classes/plane.crud.php';
include_once 'crud_classes/passenger.crud.php';
include_once 'crud_classes/booking.crud.php';
include_once 'crud_classes/schedule.crud.php';

$flightCrud = new FlightCrud($database);
$staff = new StaffCrud($database);
$pilot = new PilotCrud($database);
$plane = new PlaneCrud($database);
$passenger = new PassengerCrud($database);
$booking = new BookingCrud($database);
$schedule = new ScheduleCrud($database);
