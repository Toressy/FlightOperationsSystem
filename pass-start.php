
<?php
include_once 'header-pass.php';
include_once 'dbconfig.php';
if(isset($_POST['login'])) {
    $PASSPORT = $_POST['PASSPORT'];
    
    // Check if the passport exists in the database
    $passengerData = $passenger->login($PASSPORT);
    
    if($passengerData) {
        // Passport exists, redirect to booking page or perform further actions
        header("Location: booking.php?passport=$PASSPORT");
        exit();
    } else {
        // Passport does not exist, display error message
        header("Location: pass-start.php?login_failure");
        exit();
    }

}
elseif (isset($_POST['btn-save'])){
    $PASSPORT = $_POST['PASSPORT'];
    $SURNAME = $_POST['SURNAME'];
    $NAME = $_POST['NAME'];
    $PHONE = $_POST['PHONE'];
    $ADDRESS = $_POST['ADDRESS'];
	
	if($passenger->create($PASSPORT, $SURNAME, $NAME, $PHONE, $ADDRESS)){
		header("Location: booking.php?passport=$PASSPORT");
		exit();
	} else {
		header("Location: pass-start.php?failure");
		exit();
	}
}



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
            <td>SURNAME</td><td><input type='text' name='SURNAME' class='form-control' required></td>
        </tr>

        <tr>
            <td>NAME</td><td><input type='text' name='NAME' class='form-control' required></td>
        </tr>
        
        <tr>
            <td>PHONE</td><td><input type='text' name='PHONE' class='form-control' required></td>
        </tr>
        <tr>
            <td>ADDRESS</td><td><input type='text' name='ADDRESS' class='form-control' required></td>
        </tr>
        
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="login">
                <span class="glyphicon glyphicon-log-in"></span> Login
            </button>
            <button type="submit" class="btn btn-primary" name="btn-save">
            <span class="glyphicon glyphicon-plus"></span> Create </button>
            <a href="index.php" class="btn btn-large btn-success" style="float: right;">
            <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to menu</a>
            </td>
        </tr>
    </table>
</form>
</div>

<?php include_once 'footer.php'; ?>
