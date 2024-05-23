
<?php
include_once 'dbconfig.php';

if(isset($_POST['btn-save'])){
    // Retrieve form data
    $FLIGHTNUM = $_POST['FLIGHTNUM'];
    $ORIGIN = $_POST['ORIGIN'];
    $DESTINATION = $_POST['DESTINATION'];
	$DEPTIME = $_POST['DEPTIME'];
	$ARRTIME = $_POST['ARRTIME'];
	$AIRPLANE = $_POST['AIRPLANE'];
	$PILOT = $_POST['PILOT'];
    $GATE = $_POST['GATE'];
    $SCHEDULEID = $_POST['SCHEDULEID'];
    // Create a new Flight object with the retrieved data
    $flight = new Flight($FLIGHTNUM, $ORIGIN, $DESTINATION, $DEPTIME, $ARRTIME, $AIRPLANE, $PILOT, $GATE, $SCHEDULEID);
    // Attempt to add the flight information in the database
	if($flightCrud->create($flight)){
		header("Location: add-flight.php?inserted");
		exit();
	} else {
		header("Location: add-flight.php?failure");
		exit();
	}
}

include_once 'header.php';

if(isset($_GET['inserted'])){
	?>
    <div class="container">
	   <div class="alert alert-info">
       Successful!
	   </div>
	</div>
    <?php
} elseif(isset($_GET['failure'])){
    ?>
    <div class="container">
	   <div class="alert alert-warning">
       Insertion failed:&lt;
	   </div>
	</div>
    <?php
}

?>

<div class="container">
	<form method='post'>
    <table class='table table-bordered'>
        <tr>
            <td>Flight number</td><td><input type='text' name='FLIGHTNUM' class='form-control' required></td>
        </tr>
        <tr>
            <td>Origin</td><td><input type='text' name='ORIGIN' class='form-control' required></td>
        </tr>

        <tr>
            <td>Destination</td><td><input type='text' name='DESTINATION' class='form-control' required></td>
        </tr>
        <tr>
            <td>Departure time</td><td><input type='datetime-local' name='DEPTIME' class='form-control' required></td>
        </tr>
        <tr>
            <td>Arrival time</td><td><input type='datetime-local' name='ARRTIME' class='form-control' required></td>
        </tr>
        <tr>
            <td>Airplane</td><td><input type='number' name='AIRPLANE' class='form-control' required></td>
        </tr>
        <tr>
            <td>Pilot</td><td><input type='number' name='PILOT' class='form-control' required></td>
        </tr>
        <tr>
            <td>Gate</td><td><input type='text' name='GATE' class='form-control' required></td>
        </tr>
        <tr>
            <td>Schedule ID</td><td><input type='number' name='SCHEDULEID' class='form-control' required></td>
        </tr>
    
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
            <span class="glyphicon glyphicon-plus"></span> Add flight</button>
            <a href="admin-start.php" class="btn btn-large btn-success" style="float: right;">
            <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to menu</a>
            </td>
        </tr>
    </table>
</form>
</div>

<?php include_once 'footer.php'; ?>
