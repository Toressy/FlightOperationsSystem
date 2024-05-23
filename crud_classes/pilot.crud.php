<?php
include_once("interface.crud.php");

class Pilot {
    private $empNum;
    private $totalFlightHours;

    public function __construct($empNum, $totalFlightHours) {
        $this->empNum = $empNum;
        $this->totalFlightHours = $totalFlightHours;
    }
    public function getEmpNum() {
        return $this->empNum;
    }
    public function getTotalFlightHours() { 
        return $this->totalFlightHours;
    }
}

class pilotCrud implements CrudInterface{

	private $db;
	
	public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }
	
	

	public function create($pilot)
	{
		if ($this->getID($pilot->getEmpNum())) {return false;}

        
		$empNum = $pilot->getEmpNum();
        $totalFLightHours = $pilot->getTotalFlightHours();
        
        // Call create method from staffCrud
        
        $stmt = $this->db->prepare("INSERT INTO PILOT (EMPNUM, TOTALFLIGHTHOURS) 
		VALUES(?, ?)");
        $stmt->bind_param("ii", $empNum,  $totalFLightHours);
        return $stmt->execute();

	}



	
	
	public function getID($EMPNUM)  
	{
		$stmt = $this->db->prepare("SELECT * FROM STAFF WHERE EMPNUM=?");
        $stmt->bind_param("i", $EMPNUM);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
	}

	
	public function update($pilot)
	{
        $empNum = $pilot->getEmpNum();
        $totalFLightHours = $pilot->getTotalFlightHours();


		
        $stmt1 = $this->db->prepare("UPDATE PILOT SET  TOTALFLIGHTHOURS=?
														
													
                                    WHERE EMPNUM=?");
        $stmt1->bind_param("ii", $totalFLightHours, $empNum);
        return $stmt1->execute();
        /*
        $stmt2 = $this->db->prepare("UPDATE STAFFPHONE SET  PHONENUMBER=?, 
                                    WHERE EMPNUM=?");
        $stmt2->bind_param("si", $PHONENUMBER, $EMPNUM);
        $stmt2->execute();
        $stmt3 = $this->db->prepare("UPDATE STAFFADDRESS SET  ADDRESS=?, 
                                    WHERE EMPNUM=?");
        $stmt3->bind_param("si", $ADDRESS, $EMPNUM);*/
        

        
	}

	
	
	public function delete($EMPNUM) 
{
    
    $stmt = $this->db->prepare("DELETE FROM PILOT WHERE EMPNUM=?");
    $stmt->bind_param("i", $EMPNUM);
    return $stmt->execute();
    

}
    
	
	
	
public function getAll($limit = 10) {
    $query = "SELECT * FROM PILOT LIMIT ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $pilotList = [];
    while ($row = $result->fetch_assoc()) {
        $pilot = new Pilot(
            $row['EMPNUM'],
            $row['TOTALFLIGHTNOURS']
        );
        $pilotList[] = $pilot;
    }
    return $pilotList;
}



}
?>