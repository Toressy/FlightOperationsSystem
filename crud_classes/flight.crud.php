<?php

class flightCrud 
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

	
	public function getID($FLIGHTNUM)  
	{
		$stmt = $this->db->prepare("SELECT * FROM FLIGHT WHERE FLIGHTNUM=?");
        $stmt->bind_param("s", $FLIGHTNUM);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
	}





	
	public function update($FLIGHTNUM, $ORIGIN,$DESTINATION,$DEPTIME,$ARRTIME, $AIRPLANE, $PILOT, $GATE, $SCHEDULEID)
	{
		$stmt = $this->db->prepare("UPDATE FLIGHT SET ORIGIN=?, 
                                                        DESTINATION=?, 
                                                        DEPTIME=?,
														ARRTIME=?,
														AIRPLANE=?,
														PILOT=?,
                                                        GATE=?,
                                                        SCHEDULEID=?
                                    WHERE FLIGHTNUM=?");
        $stmt->bind_param("ssssiisis", $ORIGIN,$DESTINATION,$DEPTIME,$ARRTIME, $AIRPLANE, $PILOT, $GATE, $SCHEDULEID, $FLIGHTNUM);
        return $stmt->execute();
	}
/*
	
	public function delete($FLIGHTNUM) //переробити бо спочатку треба видалити все інше
{
    $stmt = $this->db->prepare("SELECT CAR_ID FROM Car WHERE DRIVER_ID=?");
    $stmt->bind_param("i", $FLIGHTNUM);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    while ($row = $result->fetch_assoc()) {
        $carID = $row['CAR_ID'];
        $this->deleteClaim($carID); 
        $this->deleteCar($carID);   
    }

    $stmt = $this->db->prepare("DELETE FROM Driver WHERE DRIVER_ID=?");
    $stmt->bind_param("i", $FLIGHTNUM);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}*/
    
	
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
					<td><?php echo $row['SCHEDULEID']; ?></td>
                    <td align="center">
						<a href="edit-flight.php?edit_id=<?php echo $row['FLIGHTNUM']; ?>" class="btn btn-warning">
							<i class="glyphicon glyphicon-edit"></i> Edit
						</a>
					</td>
					<td align="center">
						<a href="delete.php?delete_id=<?php echo $row['FLIGHTNUM']; ?>" class="btn btn-danger">
							<i class="glyphicon glyphicon-remove-circle"></i> Delete
						</a>
					</td>

					<td align="center">
						<a href="show-car.php?driver_id=<?php echo $row['FLIGHTNUM']; ?>" class="btn btn-info">
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



}
?>