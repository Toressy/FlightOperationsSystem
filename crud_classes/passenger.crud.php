


<?php
include_once("interface.crud.php");

class Passenger {
    private $passport;
    private $surname;
    private $name;
    private $phone;
    private $address;

    public function __construct($passport, $surname, $name, $phone, $address) {
        $this->passport = $passport;
        $this->surname = $surname;
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
    }
    public function getPassport() {
        return $this->passport;
    }
    public function getSurname() {
        return $this->surname;
    }
    public function getName() {
        return $this->name;
    }
    public function getPhone() {
        return $this->phone;
    }
    public function getAddress() {
        return $this->address;
    }
}
class passengerCrud implements CrudInterface
{
	private $db;
	
	public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }
	
	

	public function create($passenger)
	{
		$existing = $this->getID($passenger->getPassport());

        if ($existing) {
            return false;
        }

        $passport = $passenger->getPassport();
        $surname = $passenger->getSurname();
        $name = $passenger->getName();
        $phone = $passenger->getPhone();
        $address = $passenger->getAddress();

		$stmt = $this->db->prepare("INSERT INTO PASSENGER (PASSPORT, SURNAME, NAME, PHONE, ADDRESS) 
		VALUES(?, ?, ?, ?, ?)");
		$stmt->bind_param("sssss", $passport, $surname, $name, $phone, $address);
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

    public function getAll($limit = 10) {
        $query = "SELECT * FROM PASSENGER LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $passengers = [];
        while ($row = $result->fetch_assoc()) {
            $passport = $row["PASSPORT"];
            $surname = $row["SURNAME"];
            $name = $row["NAME"];
            $phone = $row["PHONE"];
            $address = $row["ADDRESS"];
            $passenger = new Passenger($passport, $surname, $name, $phone, $address);
            $passengers[] = $passenger;
        }
        return $passengers;
        
    }

	

	

		



	
	public function update($passenger)
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