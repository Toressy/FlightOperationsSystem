


<?php

class passengerCrud 
{
	private $db;
	
	function __construct($mysqli)
	{
		$this->db = $mysqli;
	}
	
	

	public function create($PASSPORT, $SURNAME, $NAME, $PHONE, $ADDRESS)
	{
		$existing = $this->getID($PASSPORT);

        if ($existing) {
            return false;
        }
		$stmt = $this->db->prepare("INSERT INTO PASSENGER (PASSPORT, SURNAME, NAME, PHONE, ADDRESS) 
		VALUES(?, ?, ?, ?, ?)");
		$stmt->bind_param("sssss", $PASSPORT, $SURNAME, $NAME, $PHONE, $ADDRESS);
		return $stmt->execute();
	}



	


	
	public function getID($PASSPORT)  
	{
		$stmt = $this->db->prepare("SELECT * FROM PASSENGER WHERE PASSPORT=?");
        $stmt->bind_param("s", $PASSPORT);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
	}

	

	

		



	
	public function update($PASSPORT,$SURNAME, $NAME, $PHONE, $ADDRESS)
	{
        
		$stmt1 = $this->db->prepare("UPDATE PASSENGER SET  SURNAME=?, 
                                                        NAME=?,
                                                        PHONE = ?,
                                                        ADDRESS=?
														
													
                                    WHERE PASSPORT=?");
        $stmt1->bind_param("ssssss", $SURNAME, $NAME, $PHONE, $ADDRESS, $PASSPORT );
        $result = $stmt1->execute();
        $stmt1->close();
        return $result;

    
	}

	
	
	public function delete($PASSPORT) 
{
   
    $stmt = $this->db->prepare("DELETE FROM PASSENGER WHERE PASSPORT=?");
    $stmt->bind_param("s", $PASSPORT);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}
    
	
	
	
	public function dataview() 
	{
		$query = "SELECT * FROM PASSENGER LIMIT 10";
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
                    <td align="center">
						<a href="edit-staff.php?edit_id=<?php echo $row['EMPNUM']; ?>" class="btn btn-warning">
							<i class="glyphicon glyphicon-edit"></i> Edit
						</a>
					</td>
					<td align="center">
						<a href="delete-booking.php?delete_id=<?php echo $row['EMPNUM']; ?>" class="btn btn-danger">
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

    public function login($PASSPORT)
    {
        $stmt = $this->db->prepare("SELECT * FROM PASSENGER WHERE PASSPORT=?");
        $stmt->bind_param("s", $PASSPORT);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        
        return $result->fetch_assoc();
    }

    


}
?>