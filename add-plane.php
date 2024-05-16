
<?php
include_once 'dbconfig.php';

if(isset($_POST['btn-save'])){
    $NUMSER = $_POST['NUMSER'];
    $AIRCRAFT = $_POST['AIRCRAFT'];
	
	if($plane->create($NUMSER, $AIRCRAFT)){
		header("Location: add-plane.php?inserted");
		exit();
	} else {
		header("Location: add-plane.php?failure");
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
            <td>NUMSER</td><td><input type='number' name='NUMSER' class='form-control' required></td>
        </tr>
       
        <tr>
                <td>AIRCRAFT</td>
                <td>
                    <select name="AIRCRAFT" class="form-control">
                        <?php
                        
                        $aircrafts = $crud->getAllAirplanes();
                        foreach ($aircrafts as $aircraft) {
                            echo "<option value='".$aircraft['AIRCRAFT']."' ".($aircraft['AIRCRAFT'] == $AIRCRAFT ? 'selected' : '').">".$aircraft['AIRCRAFT']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
        
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
            <span class="glyphicon glyphicon-plus"></span> Add plane</button>
            <a href="menu-plane.php" class="btn btn-large btn-success" style="float: right;">
            <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to menu</a>
            </td>
        </tr>
    </table>
</form>
</div>

<?php include_once 'footer.php'; ?>
