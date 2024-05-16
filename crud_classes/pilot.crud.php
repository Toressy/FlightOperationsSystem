<?php

class staffCrud 
{
	private $db;
	
	function __construct($mysqli)
	{
		$this->db = $mysqli;
	}
	
	

	public function create($EMPNUM, $SURNAME, $NAME, $DATEOFBIRTH, $TOTALFLIGHTHOURS)
	{
		$existing = $this->getID($EMPNUM);

        if ($existing) {
            return false;
        }
		$stmt = $this->db->prepare("INSERT INTO STAFF (EMPNUM, SURNAME, NAME, DATEOFBIRTH) 
		VALUES(?, ?, ?, ?)");
		$stmt->bind_param("isss", $EMPNUM, $SURNAME, $NAME, $DATEOFBIRTH);
		$stmt->execute();
        $stmt->close();
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

	
	public function update($EMPNUM,$SURNAME, $NAME,$DATEOFBIRTH, $TOTALFLIGHTHOURS)
	{
        
		$stmt1 = $this->db->prepare("UPDATE STAFF SET  SURNAME=?, 
                                                        NAME=?, 
                                                        DATEOFBIRTH=?
														
													
                                    WHERE EMPNUM=?");
        $stmt1->bind_param("ssii", $SURNAME, $NAME, $DATEOFBIRTH, $EMPNUM);
        $result = $stmt1->execute();
        $stmt1->close();
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
    $stmt = $this->db->prepare("DELETE FROM STAFFPHONE WHERE EMPNUM=?");
    $stmt->bind_param("i", $EMPNUM);
    $result = $stmt->execute();
    $stmt->close();
    $stmt = $this->db->prepare("DELETE FROM STAFFADDRESS WHERE EMPNUM=?");
    $stmt->bind_param("i", $EMPNUM);
    $result = $stmt->execute();
    $stmt->close();
    $stmt = $this->db->prepare("DELETE FROM STAFF WHERE EMPNUM=?");
    $stmt->bind_param("i", $EMPNUM);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}
    
	
	
	
	public function dataview() 
	{
		$query = "SELECT s.*, sa.ADDRESS, sp.PHONENUMBER 
        FROM STAFF s 
        LEFT JOIN STAFFADDRESS sa ON s.EMPNUM = sa.EMPNUM 
        LEFT JOIN STAFFPHONE sp ON s.EMPNUM = sp.EMPNUM 
        LIMIT 10";
		$result = $this->db->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['EMPNUM']; ?></td>
                    <td><?php echo $row['SURNAME']; ?></td>
                    <td><?php echo $row['NAME']; ?></td>
                    <td><?php echo $row['PHONENUMBER']; ?></td>
                    <td><?php echo $row['ADDRESS']; ?></td>
                    <td align="center">
						<a href="edit-staff.php?edit_id=<?php echo $row['EMPNUM']; ?>" class="btn btn-warning">
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