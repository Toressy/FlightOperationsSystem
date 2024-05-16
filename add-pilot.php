
<?php
include_once 'dbconfig.php';

if(isset($_POST['btn-save'])){
    $EMPNUM = $_POST['EMPNUM'];
    $SURNAME = $_POST['SURNAME'];
    $NAME = $_POST['NAME'];
	$DATEOFBIRTH = $_POST['DATEOFBIRTH'];
    $TOTALFLIGHTHOURS = $_POST['TOTALFLIGHTHOURS'];
	
	if($crud->createPilot($EMPNUM, $SURNAME, $NAME, $DATEOFBIRTH, $TOTALFLIGHTHOURS)){
		header("Location: add-pilot.php?inserted");
		exit();
	} else {
		header("Location: add-pilot.php?failure");
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
            <td>EMPNUM</td><td><input type='number' name='EMPNUM' class='form-control' required></td>
        </tr>
        <tr>
            <td>SURNAME</td><td><input type='text' name='SURNAME' class='form-control' required></td>
        </tr>

        <tr>
            <td>NAME</td><td><input type='text' name='NAME' class='form-control' required></td>
        </tr>
        <tr>
            <td>DATEOFBIRTH</td><td><input type='date' name='DATEOFBIRTH' class='form-control' required></td>
        </tr>
        <tr>
            <td>TOTALFLIGHTHOURS</td><td><input type='number' step='0.01' name='TOTALFLIGHTHOURS' class='form-control' required></td>
        </tr>
        
        
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
            <span class="glyphicon glyphicon-plus"></span> Add flight</button>
            <a href="admin_start.php" class="btn btn-large btn-success" style="float: right;">
            <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to menu</a>
            </td>
        </tr>
    </table>
</form>
</div>

<?php include_once 'footer.php'; ?>
