
<?php
include_once 'dbconfig.php';

if(isset($_POST['btn-save'])){
    $EMPNUM = $_POST['EMPNUM'];
    $SURNAME = $_POST['SURNAME'];
    $NAME = $_POST['NAME'];
	$DATEOFBIRTH = $_POST['DATEOFBIRTH'];
    $PHONE = $_POST['PHONE'];
    $ADDRESS = $_POST['ADDRESS'];
    $SALARY = $_POST['SALARY'];
	$staff = new Staff($EMPNUM, $SURNAME, $NAME, $DATEOFBIRTH, $PHONE, $ADDRESS, $SALARY);
	if($staffCrud->create($staff)){
		header("Location: add-staff.php?inserted");
		exit();
	} else {
		header("Location: add-staff.php?failure");
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
            <td>PHONE</td><td><input type='text' name='PHONE' class='form-control' required></td>
        </tr>
        <tr>
            <td>ADDRESS</td><td><input type='text' name='ADDRESS' class='form-control' required></td>
        </tr>
        <tr>
            <td>Salary</td><td><input type='int' name='SALARY' class='form-control' required></td>
        </tr>
        
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
            <span class="glyphicon glyphicon-plus"></span> Add staff</button>
            <a href="menu-staff.php" class="btn btn-large btn-success" style="float: right;">
            <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to menu</a>
            </td>
        </tr>
    </table>
</form>
</div>

<?php include_once 'footer.php'; ?>
