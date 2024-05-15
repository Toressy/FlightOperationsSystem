

<?php
include_once 'dbconfig.php';

if(isset($_POST['btn-save'])){
    $FLIGHTNUM = $_POST['FLIGHTNUM'];
    $ORIGIN = $_POST['ORIGIN'];
    $DESTINATION = $_POST['DESTINATION'];
	$DEPTIME = $_POST['DEPTIME'];
	$ARRTIME = $_POST['ARRTIME'];
	$AIRPLANE = $_POST['AIRPLANE'];
	$PILOT = $_POST['PILOT'];
    $GATE = $_POST['GATE'];
    $GATE = $_POST['GATE'];
	if($crud->create($DRIVER_ID, $KIDSDRIV, $AGE, $INCOME, $MSTATUS, $GENDER, $EDUCATION, $OCCUPATION)){
		header("Location: add-data.php?inserted");
		exit();
	} else {
		header("Location: add-data.php?failure");
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
            <td>Flight number</td><td><input type='number' name='DRIVER_ID' class='form-control' required></td>
        </tr>
        <tr>
            <td>Origin</td><td><input type='text' name='KIDSDRIV' class='form-control' required></td>
        </tr>

        <tr>
            <td>Destination</td><td><input type='text' name='AGE' class='form-control' required></td>
        </tr>
        <tr>
            <td>Departure time</td><td><input type='text' name='AGE' class='form-control' required></td>
        </tr>
        <tr>
            <td>Arrival time</td><td><input type='text' name='AGE' class='form-control' required></td>
        </tr>
        <tr>
            <td>Airplane</td><td><input type='number' name='AGE' class='form-control' required></td>
        </tr>
        <tr>
            <td>Pilot</td><td><input type='number' name='AGE' class='form-control' required></td>
        </tr>
        <tr>
            <td>Gate</td><td><input type='text' name='AGE' class='form-control' required></td>
        </tr>
        <tr>
            <td>Schedule ID</td><td><input type='number' name='AGE' class='form-control' required></td>
        </tr>
    
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
            <span class="glyphicon glyphicon-plus"></span> Add driver</button>
            <a href="index.php" class="btn btn-large btn-success" style="float: right;">
            <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to menu</a>
            </td>
        </tr>
    </table>
</form>
</div>

<?php include_once 'footer.php'; ?>
