<?php
include_once("interface.crud.php");

class Staff {
    private $empNum;
    private $surname;
    private $name;
    private $dateOfBirth;
    private $phone;
    private $address;
    private $salary;

    public function __construct($empNum, $surname, $name, $dateOfBirth, $phone, $address, $salary) {
        $this->empNum = $empNum;
        $this->surname = $surname;
        $this->name = $name;
        $this->dateOfBirth = $dateOfBirth;
        $this->phone = $phone;
        $this->address = $address;
        $this->salary = $salary;
    }

    public function getEmpNum() { return $this->empNum; }
    public function getSurname() { return $this->surname; }
    public function getName() { return $this->name; }
    public function getDateOfBirth() { return $this->dateOfBirth; }
    public function getPhone() { return $this->phone; }
    public function getAddress() { return $this->address; }
    public function getSalary() { return $this->salary; }
}

class StaffCrud implements CrudInterface {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function create($staff) {
        if ($this->getId($staff->getEmpNum())) {
            return false;
        }

        $empNum = $staff->getEmpNum();
        $surname = $staff->getSurname();
        $name = $staff->getName();
        $dateOfBirth = $staff->getDateOfBirth();
        $phone = $staff->getPhone();
        $address = $staff->getAddress();
        $salary = $staff->getSalary();

        $stmt = $this->db->prepare("INSERT INTO STAFF (EMPNUM, SURNAME, NAME, DATEOFBIRTH, PHONE, ADDRESS, SALARY) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssi", $empNum, $surname, $name, $dateOfBirth, $phone, $address, $salary);
        return $stmt->execute();
    }

    public function getId($empNum) {
        $stmt = $this->db->prepare("SELECT * FROM STAFF WHERE EMPNUM=?");
        $stmt->bind_param("i", $empNum);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if (!$result) {
            return null;
        }

        return new Staff(
            $result['EMPNUM'],
            $result['SURNAME'],
            $result['NAME'],
            $result['DATEOFBIRTH'],
            $result['PHONE'],
            $result['ADDRESS'],
            $result['SALARY']
        );
    }

    public function getAll($limit = 10) {
        $query = "SELECT * FROM STAFF LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $staffList = [];
        while ($row = $result->fetch_assoc()) {
            $staff = new Staff(
                $row['EMPNUM'],
                $row['SURNAME'],
                $row['NAME'],
                $row['DATEOFBIRTH'],
                $row['PHONE'],
                $row['ADDRESS'],
                $row['SALARY']
            );
            $staffList[] = $staff;
        }
        return $staffList;
    }

    public function update($staff) {
        $empNum = $staff->getEmpNum();
        $surname = $staff->getSurname();
        $name = $staff->getName();
        $dateOfBirth = $staff->getDateOfBirth();
        $phone = $staff->getPhone();
        $address = $staff->getAddress();
        $salary = $staff->getSalary();

        $stmt = $this->db->prepare("UPDATE STAFF SET SURNAME=?, NAME=?, DATEOFBIRTH=?, PHONE=?, ADDRESS=?, SALARY=? WHERE EMPNUM=?");
        $stmt->bind_param("ssssssi", $surname, $name, $dateOfBirth, $phone, $address, $salary, $empNum);
        return $stmt->execute();
    }

    public function delete($empNum) {
        $stmt = $this->db->prepare("DELETE FROM STAFF WHERE EMPNUM=?");
        $stmt->bind_param("i", $empNum);
        return $stmt->execute();
    }

    public function getFlight($empNum) {
        $stmt = $this->db->prepare("SELECT FLIGHT.FLIGHTNUM, FLIGHT.ORIGIN, FLIGHT.DESTINATION, FLIGHT.DEPTIME, FLIGHT.ARRTIME 
        FROM FLIGHT
        INNER JOIN CREW ON FLIGHT.FLIGHTNUM = CREW.FLIGHTNUM
        WHERE CREW.EMPNUM = ?");
        $stmt->bind_param("i", $empNum);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
