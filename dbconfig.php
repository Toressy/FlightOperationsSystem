<?php


$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "Airlane";
$mysqli = new mysqli($DB_host, $DB_user, $DB_pass, $DB_name);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}


$mysqli->set_charset("utf8mb4"); 



include_once 'class.crud.php';
$crud = new crud($mysqli);

include_once 'crud_classes/flight.crud.php';
include_once 'crud_classes/staff.crud.php';
include_once 'crud_classes/pilot.crud.php';
include_once 'crud_classes/plane.crud.php';
include_once 'crud_classes/passenger.crud.php';


$flight = new flightCrud($mysqli);
$staff = new staffCrud($mysqli);
$pilot = new pilotCrud($mysqli);
$plane = new planeCrud($mysqli);
$passenger = new passengerCrud($mysqli);






?>
