<?php
include_once("interface.crud.php");

class Plane 
{
	private $numSer;
	private $aircraft;

	public function __construct($numSer, $aircraft)
	{
		$this->numSer = $numSer;
		$this->aircraft = $aircraft;
	}

	public function getNumSer(){
		return $this->numSer;
	}

	public function getAircraft(){
		return $this->aircraft;
	}
}
class planeCrud implements CrudInterface
{
	private $db;
	
	public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }
	
	public function create($plane) 
	{
		$numSer = $plane->getNumSer();
		$aircraft = $plane->getAircraft();
		
		$stmt = $this->db->prepare("INSERT INTO AIRPLANE(NUMSER, AIRCRAFT) 
		VALUES(?, ?)");
		$stmt->bind_param("is", $numSer, $aircraft);
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

	public function getAll($limit = 10) {
        $query = "SELECT * FROM AIRPLANE LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $planes = [];
        while ($row = $result->fetch_assoc()) {
            $numSer = $row['NUMSER'];
            $aircraft = $row['AIRCRAFT'];
            
            $plane = new Plane($numSer, $aircraft);
            $planes[] = $plane;
        }
        return $planes;
    }

	

	
	public function update($plane)
	{
		$numSer = $plane->getNumSer();
		$aircraft = $plane->getAircraft();
		$stmt = $this->db->prepare("UPDATE AIRPLANE SET AIRCRAFT=? 
                                                        
                                    WHERE NUMSER=?");
        $stmt->bind_param("si", $aircraft, $numSer);
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