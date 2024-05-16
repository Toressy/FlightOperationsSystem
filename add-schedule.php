
<?php
include_once 'dbconfig.php';

if(isset($_POST['btn-save'])){
    $SCHEDULEID = $_POST['SCHEDULEID'];
    $SCHEDULETYPE = $_POST['SCHEDULETYPE'];
    $ORIGIN = $_POST['ORIGIN'];
    $DESTINATION = $_POST['DESTINATION'];
	$DEPTIME = $_POST['DEPTIME'];
	$ARRTIME = $_POST['ARRTIME'];
	if($schedule->create($SCHEDULEID, $SCHEDULETYPE, $ORIGIN, $DESTINATION, $DEPTIME, $ARRTIME)){
		header("Location: add-schedule.php?inserted");
		exit();
	} else {
		header("Location: add-schedule.php?failure");
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
            <td>Schedule ID</td><td><input type='number' name='SCHEDULEID' class='form-control' required></td>
        </tr>
        <tr>
            <td>Schedule type</td><td><input type='text' name='SCHEDULETYPE' class='form-control' required></td>
        </tr>
        <tr>
            <td>Origin</td><td><input type='text' name='ORIGIN' class='form-control' required></td>
        </tr>

        <tr>
            <td>Destination</td><td><input type='text' name='DESTINATION' class='form-control' required></td>
        </tr>
        <tr>
            <td>Departure time</td><td><input type='time' name='DEPTIME' class='form-control' required></td>
        </tr>
        <tr>
            <td>Arrival time</td><td><input type='time' name='ARRTIME' class='form-control' required></td>
        </tr>
        
    
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
            <span class="glyphicon glyphicon-plus"></span> Add schedule</button>
            <a href="menu-schedule.php" class="btn btn-large btn-success" style="float: right;">
            <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to menu</a>
            </td>
        </tr>
    </table>
</form>
</div>

<?php include_once 'footer.php'; ?>
