<?php
include_once("interface.crud.php");
class planeCrud 
{
	private $db;
	
	function __construct($mysqli)
	{
		$this->db = $mysqli;
	}
	
	public function create($NUMSER, $AIRCRAFT) 
	{
		
		$stmt = $this->db->prepare("INSERT INTO AIRPLANE(NUMSER, AIRCRAFT) 
		VALUES(?, ?)");
		$stmt->bind_param("is", $NUMSER, $AIRCRAFT);
		return $stmt->execute();
	}


	
	public function getID($NUMSER)  
	{
		$stmt = $this->db->prepare("SELECT * FROM AIRPLANE WHERE NUMSER=?");
        $stmt->bind_param("i", $NUMSER);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
	}

	

	
	public function update($NUMSER,$AIRCRAFT)
	{
		$stmt = $this->db->prepare("UPDATE AIRPLANE SET AIRCRAFT=? 
                                                        
                                    WHERE NUMSER=?");
        $stmt->bind_param("si", $AIRCRAFT, $NUMSER);
        return $stmt->execute();
	}


	public function delete($NUMSER) 
{
    
    $stmt = $this->db->prepare("DELETE FROM AIRPLANE WHERE NUMSER=?");
    $stmt->bind_param("i", $NUMSER);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}
    
	 

	
	
	public function dataview() 
	{
		$query = "SELECT * FROM AIRPLANE LIMIT 10";
		$result = $this->db->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['NUMSER']; ?></td>
                    <td><?php echo $row['AIRCRAFT']; ?></td>
                    
                    <td align="center">
						<a href="edit-plane.php?edit_id=<?php echo $row['NUMSER']; ?>" class="btn btn-warning">
							<i class="glyphicon glyphicon-edit"></i> Edit
						</a>
					</td>
					<td align="center">
						<a href="delete-plane.php?delete_id=<?php echo $row['NUMSER']; ?>" class="btn btn-danger">
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