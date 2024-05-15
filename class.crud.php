<?php

class crud 
{
	private $db;
	
	function __construct($mysqli)
	{
		$this->db = $mysqli;
	}
	
	public function create($FLIGHTNUM, $ORIGIN,$DESTINATION,$DEPTIME,$ARRTIME, $AIRPLANE, $PILOT, $GATE, $SCHEDULEID) 
	{
		$existingFlight = $this->getID($FLIGHTNUM);

        if ($existingFlight) {
            return false;
        }
		$stmt = $this->db->prepare("INSERT INTO FLIGHT(FLIGHTNUM, ORIGIN, DESTINATION, DEPTIME, ARRTIME, AIRPLANE, PILOT, GATE, SCHEDULEID) 
		VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssiisi", $FLIGHTNUM, $ORIGIN, $DESTINATION, $DEPTIME, $ARRTIME, $AIRPLANE, $PILOT, $GATE, $SCHEDULEID);
		return $stmt->execute();
	}

	public function createCar($DRIVER_ID, $CAR_TYPE ,$RED_CAR, $CAR_AGE) 
	{
		$stmt = $this->db->prepare("INSERT INTO Car (DRIVER_ID, CAR_TYPE, RED_CAR, CAR_AGE) 
		VALUES(?, ?, ?, ?)");
		$stmt->bind_param("issi", $DRIVER_ID, $CAR_TYPE, $RED_CAR, $CAR_AGE);
		return $stmt->execute();
	}

	public function createClaim($CAR_ID, $OLDCLAIM ,$CLM_FREQ, $CLM_AMT, $CLAIM_FLAG) 
	{
		$stmt = $this->db->prepare("INSERT INTO Claim (CAR_ID, OLDCLAIM, CLM_FREQ, CLM_AMT, CLAIM_FLAG) 
		VALUES(?, ?, ?, ?, ?)");
		$stmt->bind_param("isisi", $CAR_ID, $OLDCLAIM, $CLM_FREQ, $CLM_AMT, $CLAIM_FLAG);
		return $stmt->execute();
	}

	
	public function getID($FLIGHTNUM)  
	{
		$stmt = $this->db->prepare("SELECT * FROM FLIGHT WHERE FLIGHTNUM=?");
        $stmt->bind_param("i", $FLIGHTNUM);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
	}

	public function getCarById($CAR_ID) {
	
		$stmt = $this->db->prepare("SELECT * FROM Car WHERE CAR_ID=?");
        $stmt->bind_param("i", $CAR_ID);
        $stmt->execute();
		$result = $stmt->get_result();
		
		return $result->fetch_assoc();
		

	}

	public function getClaimByCarId($CAR_ID){
		$stmt = $this->db->prepare("SELECT * FROM Claim WHERE CAR_ID=?");
        $stmt->bind_param("i", $CAR_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
	}

	public function getCarByDriverId($DRIVER_ID) {
	
		$stmt = $this->db->prepare("SELECT * FROM Car WHERE DRIVER_ID=?");
        $stmt->bind_param("i", $DRIVER_ID);
        $stmt->execute();
		$result = $stmt->get_result();
		
		$cars = array(); 
		
		while ($row = $result->fetch_assoc()) {
			$cars[] = $row; 
		}
		
		return $cars;
	}

	public function getDataForAgeCohorts()
    {
        $query = "SELECT d.AGE, c.CLM_FREQ, c.CLM_AMT 
		FROM Driver d 
		INNER JOIN Car car ON d.DRIVER_ID = car.DRIVER_ID 
		INNER JOIN Claim c ON car.CAR_ID = c.CAR_ID";
        $result = $this->db->query($query);

        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

	public function getAllDrivers() {
		$query = "SELECT * FROM Driver";
		$result = $this->db->query($query);
		
		$drivers = array(); 
		
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$drivers[] = $row; 
			}
		}
		
		return $drivers;
	}

	
		



	
	public function update($DRIVER_ID,$KIDSDRIV, $AGE,$INCOME,$MSTATUS,$GENDER, $EDUCATION, $OCCUPATION)
	{
		$stmt = $this->db->prepare("UPDATE Driver SET KIDSDRIV=?, 
                                                        AGE=?, 
                                                        INCOME=?, 
                                                        MSTATUS=?,
														GENDER=?,
														EDUCATION=?,
														OCCUPATION=?
                                    WHERE DRIVER_ID=?");
        $stmt->bind_param("iisssssi", $KIDSDRIV, $AGE, $INCOME, $MSTATUS, $GENDER, $EDUCATION, $OCCUPATION, $DRIVER_ID);
        return $stmt->execute();
	}

	public function updateCar($CAR_ID, $DRIVER_ID, $CAR_TYPE,$RED_CAR,$CAR_AGE)
	{
		$stmt = $this->db->prepare("UPDATE Car SET DRIVER_ID=?, 
                                                        CAR_TYPE=?, 
                                                        RED_CAR=?, 
                                                        CAR_AGE=?
														
                                    WHERE CAR_ID=?");
        $stmt->bind_param("issii", $DRIVER_ID, $CAR_TYPE, $RED_CAR, $CAR_AGE, $CAR_ID);
        return $stmt->execute();
	}

	public function updateClaim($CAR_ID, $OLDCLAIM, $CLM_FREQ,$CLM_AMT,$CLAIM_FLAG)
	{
		$stmt = $this->db->prepare("UPDATE Claim SET OLDCLAIM=?, 
                                                        CLM_FREQ=?, 
                                                        CLM_AMT=?, 
                                                        CLAIM_FLAG=?
														
                                    WHERE CAR_ID=?");
        $stmt->bind_param("sisii", $OLDCLAIM, $CLM_FREQ, $CLM_AMT, $CLAIM_FLAG, $CAR_ID);
        return $stmt->execute();
	}
	
	public function delete($DRIVER_ID) 
{
    $stmt = $this->db->prepare("SELECT CAR_ID FROM Car WHERE DRIVER_ID=?");
    $stmt->bind_param("i", $DRIVER_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    while ($row = $result->fetch_assoc()) {
        $carID = $row['CAR_ID'];
        $this->deleteClaim($carID); 
        $this->deleteCar($carID);   
    }

    $stmt = $this->db->prepare("DELETE FROM Driver WHERE DRIVER_ID=?");
    $stmt->bind_param("i", $DRIVER_ID);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}
    
	
	public function deleteCar($CAR_ID) 
	{
		$stmt1 = $this->db->prepare("DELETE FROM Claim WHERE CAR_ID=?");
		$stmt1->bind_param("i", $CAR_ID);
		$stmt1->execute();
		$stmt1->close();
	
		$stmt2 = $this->db->prepare("DELETE FROM Car WHERE CAR_ID=?");
		$stmt2->bind_param("i", $CAR_ID);
		$result = $stmt2->execute();
		$stmt2->close();
	
		return $result; 
	}    

	public function deleteClaim($CAR_ID){
		$stmt = $this->db->prepare("DELETE FROM Claim WHERE CAR_ID=?");
		$stmt->bind_param("i", $CAR_ID);
		return $stmt->execute();
	}
	
	
	public function dataview() 
	{
		$query = "SELECT * FROM FLIGHT LIMIT 10";
		$result = $this->db->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['FLIGHTNUM']; ?></td>
                    <td><?php echo $row['ORIGIN']; ?></td>
                    <td><?php echo $row['DESTINATION']; ?></td>
                    <td><?php echo $row['DEPTIME']; ?></td>
                    <td><?php echo $row['ARRTIME']; ?></td>
					<td><?php echo $row['AIRPLANE']; ?></td>
					<td><?php echo $row['PILOT']; ?></td>
					<td><?php echo $row['GATE']; ?></td>
					<td><?php echo $row['SHEDULEID']; ?></td>
                    <td align="center">
						<a href="edit-data.php?edit_id=<?php echo $row['DRIVER_ID']; ?>" class="btn btn-warning">
							<i class="glyphicon glyphicon-edit"></i> Edit
						</a>
					</td>
					<td align="center">
						<a href="delete.php?delete_id=<?php echo $row['DRIVER_ID']; ?>" class="btn btn-danger">
							<i class="glyphicon glyphicon-remove-circle"></i> Delete
						</a>
					</td>

					<td align="center">
						<a href="show-car.php?driver_id=<?php echo $row['DRIVER_ID']; ?>" class="btn btn-info">
							Show Cars
						</a>
					</td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="7">No flight found...</td>
            </tr>
            <?php
        }
	}	

	public function displayClaimDetails($CAR_ID)
{
    $claim = $this->getClaimByCarId($CAR_ID);

    if ($claim) {
        echo "<table class='table table-bordered'>";
        echo "<tr><th>Claim ID</th><th>Old Claim</th><th>Claim Frequency</th><th>Claim Amount</th><th>Claim Flag</th></tr>";
        echo "<tr>";
        echo "<td>" . $claim['CLAIM_ID'] . "</td>";
        echo "<td>" . $claim['OLDCLAIM'] . "</td>";
        echo "<td>" . $claim['CLM_FREQ'] . "</td>";
        echo "<td>" . $claim['CLM_AMT'] . "</td>";
        echo "<td>" . $claim['CLAIM_FLAG'] . "</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "No claims found for this car.";
    }
}

}
?>