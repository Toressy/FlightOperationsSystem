<?php

class bookingCrud 
{
	private $db;
	
	function __construct($mysqli)
	{
		$this->db = $mysqli;
	}
	
	

	public function create( $PASSPORT, $FRIGHTNUM, $SEAT, $CLASS)
	{
		
		$stmt = $this->db->prepare("INSERT INTO BOOKING (PASSPORT, FRIGHTNUM, SEAT, CLASS) 
		VALUES(?, ?, ?, ?)");
		$stmt->bind_param("ssss", $PASSPORT, $FRIGHTNUM, $SEAT, $CLASS);
		return $stmt->execute();
	}



	


	
	public function getID($BOOKINGID)  
	{
		$stmt = $this->db->prepare("SELECT * FROM BOOKING WHERE BOOKINGID=?");
        $stmt->bind_param("i", $BOOKINGID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
	}

	

	

		



	
	public function update($BOOKINGID,$PASSPORT, $FLIGHTNUM,$SEAT, $CLASS)
	{
        
		$stmt1 = $this->db->prepare("UPDATE BOOKING SET  PASSPORT=?, 
                                                        FLIGHTNUM=?, 
                                                        SEAT=?,
                                                        CLASS = ?
                                                        
														
													
                                    WHERE BOOKINGID=?");
        $stmt1->bind_param("ssssi", $PASSPORT, $FLIGHTNUM, $SEAT, $CLASS, $BOOKINGID );
        $result = $stmt1->execute();
        $stmt1->close();/*
        $stmt2 = $this->db->prepare("UPDATE STAFFPHONE SET  PHONENUMBER=?, 
                                    WHERE EMPNUM=?");
        $stmt2->bind_param("si", $PHONENUMBER, $EMPNUM);
        $stmt2->execute();
        $stmt3 = $this->db->prepare("UPDATE STAFFADDRESS SET  ADDRESS=?, 
                                    WHERE EMPNUM=?");
        $stmt3->bind_param("si", $ADDRESS, $EMPNUM);*/
        return $result;

        
	}

	
	
	public function delete($BOOKINGID) 
{
   
    $stmt = $this->db->prepare("DELETE FROM BOOKING WHERE BOOKINGID=?");
    $stmt->bind_param("i", $BOOKINGID);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}
    
	
	
	
	public function dataview() 
	{
		$query = "SELECT * FROM BOOKING LIMIT 10";
		$result = $this->db->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['BOOKINGID']; ?></td>
                    <td><?php echo $row['PASSPORT']; ?></td>
                    <td><?php echo $row['FLIGHTNUM']; ?></td>
                    <td><?php echo $row['SEAT']; ?></td>

                    <td><?php echo $row['CLASS']; ?></td>
                    
                    <td align="center">
						<a href="edit-staff.php?edit_id=<?php echo $row['BOOKINGID']; ?>" class="btn btn-warning">
							<i class="glyphicon glyphicon-edit"></i> Edit
						</a>
					</td>
					<td align="center">
						<a href="delete-staff.php?delete_id=<?php echo $row['BOOKINGID']; ?>" class="btn btn-danger">
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
    public function bookingDataview($PASSPORT) 
{
    $stmt = $this->db->prepare("SELECT * FROM BOOKING WHERE PASSPORT=?");
    $stmt->bind_param("s", $PASSPORT);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['BOOKINGID']; ?></td>
                <td><?php echo $row['PASSPORT']; ?></td>
                <td><?php echo $row['FLIGHTNUM']; ?></td>
                <td><?php echo $row['SEAT']; ?></td>
                <td><?php echo $row['CLASS']; ?></td>
                <td align="center">
						<a href="delete-booking.php?delete_id=<?php echo $row['BOOKINGID']; ?>" class="btn btn-danger">
							<i class="glyphicon glyphicon-remove-circle"></i> Delete
						</a>
					</td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="5">No bookings found for this passport.</td>
        </tr>
        <?php
    }

    $stmt->close();
}

public function flightview() 
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
					
                    <td align="center">
						<a href="book-flight.php?create_id=<?php echo $row['FLIGHTNUM']; ?>" class="btn btn-warning">
							<i class="glyphicon glyphicon-edit"></i> Book
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