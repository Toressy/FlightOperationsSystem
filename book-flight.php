
<?php
include_once 'dbconfig.php';

if(isset($_POST['btn-save'])){
   
    $PASSPORT = $_POST['PASSPORT'];
    $FLIGHTNUM = $_POST['FLIGHTNUM'];
	$SEAT = $_POST['SEAT'];
	$CLASS = $_POST['CLASS'];
	
	if($booking->create( $PASSPORT, $FLIGHTNUM, $SEAT, $CLASS)){
		header("Location: pass-booking.php?passport=$PASSPORT");
		exit();
	} else {
		header("Location: book-flight.php?failure");
		exit();
	}
}

include_once 'header-pass.php';

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
            <td>Passport</td><td><input type='text' name='PASSPORT' class='form-control' required></td>
        </tr>
       
        <tr>
            <td>Flight number</td><td><input type='text' name='FLIGHTNUM' class='form-control' value="<?php echo isset($_GET['create_id']) ? $_GET['create_id'] : ''; ?>" required readonly></td>
        </tr>
        <tr>
            <td>Seat</td><td><input type='text' name='SEAT' class='form-control' required></td>
        </tr>
        <tr>
            <td>Class </td><td><input type='text' name='CLASS' class='form-control' required></td>
        </tr>
        
        
    
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
            <span class="glyphicon glyphicon-plus"></span> Add flight</button>
            <a href="admin_
            start.php" class="btn btn-large btn-success" style="float: right;">
            <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to menu</a>
            </td>
        </tr>
    </table>
</form>
</div>

<?php include_once 'footer.php'; ?>
