<?php
include_once("interface.crud.php");

 class  Flight {
    private $flightNum;
    private $origin;
    private $destination;
    private $depTime;
    private $arrTime;
    private $airplane;
    private $pilot;
    private $gate;
    private $scheduleId;

    public function __construct($flightNum, $origin, $destination, $depTime, $arrTime, $airplane, $pilot, $gate, $scheduleId) {
        $this->flightNum = $flightNum;
        $this->origin = $origin;
        $this->destination = $destination;
        $this->depTime = $depTime;
        $this->arrTime = $arrTime;
        $this->airplane = $airplane;
        $this->pilot = $pilot;
        $this->gate = $gate;
        $this->scheduleId = $scheduleId;
    }

    public function getFlightNum() { return $this->flightNum; }
    public function getOrigin() { return $this->origin; }
    public function getDestination() { return $this->destination; }
    public function getDepTime() { return $this->depTime; }
    public function getArrTime() { return $this->arrTime; }
    public function getAirplane() { return $this->airplane; }
    public function getPilot() { return $this->pilot; }
    public function getGate() { return $this->gate; }
    public function getScheduleId() { return $this->scheduleId; }
}

class FlightCrud implements CrudInterface{
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function create($flight) {
       
        if ($this->getId($flight->getFlightNum())) {
            return false;
        }

        $flightNum = $flight->getFlightNum();
        $origin = $flight->getOrigin();
        $destination = $flight->getDestination();
        $depTime = $flight->getDepTime();
        $arrTime = $flight->getArrTime();
        $airplane = $flight->getAirplane();
        $pilot = $flight->getPilot();
        $gate = $flight->getGate();
        $scheduleId = $flight->getScheduleId();

        $stmt = $this->db->prepare("INSERT INTO FLIGHT (FLIGHTNUM, ORIGIN, DESTINATION, DEPTIME, ARRTIME, AIRPLANE, PILOT, GATE, SCHEDULEID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssiisi", $flightNum, $origin, $destination, $depTime, $arrTime, $airplane, $pilot, $gate, $scheduleId);
        return $stmt->execute();
    }

    public function getId($flightNum) {
        $stmt = $this->db->prepare("SELECT * FROM FLIGHT WHERE FLIGHTNUM=?");
        $stmt->bind_param("s", $flightNum);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if (!$result) {
            return null;
        }

        return new Flight(
            $result['FLIGHTNUM'],
            $result['ORIGIN'],
            $result['DESTINATION'],
            $result['DEPTIME'],
            $result['ARRTIME'],
            $result['AIRPLANE'],
            $result['PILOT'],
            $result['GATE'],
            $result['SCHEDULEID']
        );
       
    }
    
    public function getAll($limit = 10) {
        $query = "SELECT * FROM FLIGHT LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $flights = [];
        while ($row = $result->fetch_assoc()) {
            $FLIGHTNUM = $row["FLIGHTNUM"];
            $ORIGIN = $row['ORIGIN'];
            $DESTINATION = $row['DESTINATION'];
            $DEPTIME = $row['DEPTIME'];
            $ARRTIME = $row['ARRTIME'];
            $AIRPLANE = $row['AIRPLANE'];
            $PILOT = $row['PILOT'];
            $GATE = $row['GATE'];
            $SCHEDULEID = $row['SCHEDULEID'];
            $flight = new Flight($FLIGHTNUM, $ORIGIN, $DESTINATION, $DEPTIME, $ARRTIME, $AIRPLANE, $PILOT, $GATE, $SCHEDULEID);
            $flights[] = $flight;
        }
        return $flights;
    }

    public function update($flight) {
        

        $flightNum = $flight->getFlightNum();
        $origin = $flight->getOrigin();
        $destination = $flight->getDestination();
        $depTime = $flight->getDepTime();
        $arrTime = $flight->getArrTime();
        $airplane = $flight->getAirplane();
        $pilot = $flight->getPilot();
        $gate = $flight->getGate();
        $scheduleId = $flight->getScheduleId();

        
        $stmt = $this->db->prepare("UPDATE FLIGHT SET ORIGIN=?, 
                                                    DESTINATION=?, 
                                                    DEPTIME=?,
                                                    ARRTIME=?,
                                                    AIRPLANE=?,
                                                    PILOT=?,
                                                    GATE=?,
                                                    SCHEDULEID=?
                                            WHERE FLIGHTNUM=?");
        $stmt->bind_param("ssssiisis", $origin, $destination, $depTime, $arrTime, $airplane, $pilot, $gate, $scheduleId, $flightNum);
        return $stmt->execute();
    }

    public function delete($flightNum) {
        $stmt = $this->db->prepare("DELETE FROM FLIGHT WHERE FLIGHTNUM=?");
        $stmt->bind_param("s", $flightNum);
        return $stmt->execute();
    }

   

    
}
?>
