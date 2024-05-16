<?php

class scheduleCrud
{
	private $db;
	
	function __construct($mysqli)
	{
		$this->db = $mysqli;
	}
	
	public function create($SCHEDULEID, $SCHEDULETYPE,$ORIGIN,$DESTINATION,$DEPTIME, $ARRTIME) 
	{
		$existingFlight = $this->getID($SCHEDULEID);

        if ($existingFlight) {
            return false;
        }
		$stmt = $this->db->prepare("INSERT INTO SCHEDULE(SCHEDULEID,SCHEDULETYPE, ORIGIN, DESTINATION, DEPTIME, ARRTIME) 
		VALUES(?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("isssss", $SCHEDULEID, $SCHEDULETYPE,  $ORIGIN, $DESTINATION, $DEPTIME, $ARRTIME);
		return $stmt->execute();
	}

	
	public function getID($SCHEDULEID)  
	{
		$stmt = $this->db->prepare("SELECT * FROM SCHEDULE WHERE SCHEDULEID=?");
        $stmt->bind_param("i", $SCHEDULEID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
	}





	
	public function update($SCHEDULEID, $SCHEDULETYPE, $ORIGIN,$DESTINATION,$DEPTIME,$ARRTIME)
	{
		$stmt = $this->db->prepare("UPDATE SCHEDULE SET SCHEDULETYPE = ?,
                                                        ORIGIN=?, 
                                                        DESTINATION=?, 
                                                        DEPTIME=?,
														ARRTIME=?,
														
                                    WHERE SCHEDULEID=?");
        $stmt->bind_param("sssssi", $SCHEDULETYPE, $ORIGIN,$DESTINATION,$DEPTIME,$ARRTIME, $SCHEDULEID);
        return $stmt->execute();
	}

    public function delete($SCHEDULEID) 
{
   
    $stmt = $this->db->prepare("DELETE FROM SCHEDULE WHERE SCHEDULEID=?");
    $stmt->bind_param("s", $SCHEDULEID);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}
    
    
	
	public function dataview() 
	{
		$query = "SELECT * FROM SCHEDULE LIMIT 10";
		$result = $this->db->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['SCHEDULEID']; ?></td>
                    <td><?php echo $row['SCHEDULETYPE']; ?></td>
                    <td><?php echo $row['ORIGIN']; ?></td>
                    <td><?php echo $row['DESTINATION']; ?></td>
                    <td><?php echo $row['DEPTIME']; ?></td>
                    <td><?php echo $row['ARRTIME']; ?></td>
                    <td align="center">
						<a href="edit-flight.php?edit_id=<?php echo $row['SCHEDULEID']; ?>" class="btn btn-warning">
							<i class="glyphicon glyphicon-edit"></i> Edit
						</a>
					</td>
					<td align="center">
						<a href="delete.php?delete_id=<?php echo $row['SCHEDULEID']; ?>" class="btn btn-danger">
							<i class="glyphicon glyphicon-remove-circle"></i> Delete
						</a>
					</td>

					
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="7">No schedule found...</td>
            </tr>
            <?php
        }
	}	

    
    public function dataviewPass() 
	{
		$query = "SELECT * FROM SCHEDULE LIMIT 10";
		$result = $this->db->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['SCHEDULEID']; ?></td>
                    <td><?php echo $row['SCHEDULETYPE']; ?></td>
                    <td><?php echo $row['ORIGIN']; ?></td>
                    <td><?php echo $row['DESTINATION']; ?></td>
                    <td><?php echo $row['DEPTIME']; ?></td>
                    <td><?php echo $row['ARRTIME']; ?></td>
                    

					
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="7">No schedule found...</td>
            </tr>
            <?php
        }
	}	




}
?>