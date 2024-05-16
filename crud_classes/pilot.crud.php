<?php

class pilotCrud 
{
	private $db;
	
	function __construct($mysqli)
	{
		$this->db = $mysqli;
	}
	
	

	public function create($EMPNUM, $SURNAME, $NAME, $DATEOFBIRTH, $PHONE, $ADDRESS, $TOTALFLIGHTHOURS)
	{
		$existing = $this->getID($EMPNUM);

        if ($existing) {
            return false;
        }
		$staffCrudObj = new staffCrud($this->db);
        
        // Call create method from staffCrud
        $staffCreateResult = $staffCrudObj->create($EMPNUM, $SURNAME, $NAME, $DATEOFBIRTH, $PHONE, $ADDRESS);

        if (!$staffCreateResult) {
            return false; // Handle if staff creation fails
        }
        $stmt = $this->db->prepare("INSERT INTO PILOT (EMPNUM, TOTALFLIGHTHOURS) 
		VALUES(?, ?)");
        $stmt->bind_param("ii", $EMPNUM,  $TOTALFLIGHTHOURS);
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

	
	public function update($EMPNUM,$SURNAME, $NAME,$DATEOFBIRTH,$PHONE, $ADDRESS,  $TOTALFLIGHTHOURS)
	{

        $staffCrudObj = new staffCrud($this->db);
        
        // Call update method from staffCrud
        $staffUpdateResult = $staffCrudObj->update($EMPNUM, $SURNAME, $NAME, $DATEOFBIRTH, $PHONE, $ADDRESS);

        if (!$staffUpdateResult) {
            return false; // Handle if staff update fails
        }

        
		
        $stmt1 = $this->db->prepare("UPDATE PILOT SET  TOTALFLIGHTHOURS=?
														
													
                                    WHERE EMPNUM=?");
        $stmt1->bind_param("ii", $TOTALFLIGHTHOURS, $EMPNUM);
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
    $staffCrudObj = new staffCrud($this->db);
        
    // Call delete method from staffCrud
    $staffDeleteResult = $staffCrudObj->delete($EMPNUM);

    if (!$staffDeleteResult) {
        return false; // Handle if staff delete fails
    }
    $stmt = $this->db->prepare("DELETE FROM PILOT WHERE EMPNUM=?");
    $stmt->bind_param("i", $EMPNUM);
    return $stmt->execute();
    

}
    
	
	
	
	public function dataview() 
	{
		$query = "SELECT s.*, p.TOTALFLIGHTHOURS
        FROM STAFF s 
        LEFT JOIN PILOT p ON s.EMPNUM = p.EMPNUM 
        LIMIT 10";
		$result = $this->db->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['EMPNUM']; ?></td>
                    <td><?php echo $row['SURNAME']; ?></td>
                    <td><?php echo $row['NAME']; ?></td>
                    <td><?php echo $row['DATEOFBIRTH']; ?></td>
                    <td><?php echo $row['PHONE']; ?></td>
                    <td><?php echo $row['ADDRESS']; ?></td>
                    <td><?php echo $row['TOTALFLIGHTHOURS']; ?></td>
                    <td align="center">
						<a href="edit-pilot.php?edit_id=<?php echo $row['EMPNUM']; ?>" class="btn btn-warning">
							<i class="glyphicon glyphicon-edit"></i> Edit
						</a>
					</td>
					<td align="center">
						<a href="delete-staff.php?delete_id=<?php echo $row['EMPNUM']; ?>" class="btn btn-danger">
							<i class="glyphicon glyphicon-remove-circle"></i> Delete
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