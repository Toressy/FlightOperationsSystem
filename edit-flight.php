<?php
include_once 'dbconfig.php';

if(isset($_POST['btn-update'])) {
    $FLIGHTNUM = $_GET['edit_id'];
    $ORIGIN = $_POST['ORIGIN'];
    $DESTINATION = $_POST['DESTINATION'];
    $DEPTIME = $_POST['DEPTIME'];
    $ARRTIME = $_POST['ARRTIME'];
    $AIRPLANE = $_POST['AIRPLANE'];
    $PILOT = $_POST['PILOT'];
    $GATE = $_POST['GATE'];
    $SCHEDULEID = $_POST['SCHEDULEID'];

    if($flight->update($FLIGHTNUM, $ORIGIN, $DESTINATION, $DEPTIME, $ARRTIME, $AIRPLANE, $PILOT, $GATE, $SCHEDULEID)) {
        $msg = "<div class='alert alert-info'>
                Modification successful
                </div>";
    } else {
        $msg = "<div class='alert alert-warning'>
                Editing error
                </div>";
    }
}

if(isset($_GET['edit_id'])) {
    $FLIGHTNUM = $_GET['edit_id'];
    $flightget = $flight->getID($FLIGHTNUM);
    $ORIGIN = $flightget['ORIGIN'];
    $DESTINATION = $flightget['DESTINATION'];
    $DEPTIME = $flightget['DEPTIME'];
    $ARRTIME = $flightget['ARRTIME'];
    $AIRPLANE = $flightget['AIRPLANE'];
    $PILOT = $flightget['PILOT'];
    $GATE = $flightget['GATE'];
    $SCHEDULEID = $flightget['SCHEDULEID'];
}

include_once 'header.php';
?>

<div class="container">
    <?php
    if(isset($msg)) {
        echo $msg;
    }
    ?>
</div>

<div class="container">    
    <form method='post'>
        <table class='table table-bordered'>
        
            <tr>
                <td>ORIGIN</td>
                <td><input type='text' name='ORIGIN' class='form-control' value="<?php echo $ORIGIN; ?>" required></td>
            </tr>
    
            <tr>
                <td>DESTINATION</td>
                <td><input type='text' name='DESTINATION' class='form-control' value="<?php echo $DESTINATION; ?>" required></td>
            </tr>
    
            <tr>
                <td>DEPTIME</td>
                <td><input type='datetime-local' name='DEPTIME' class='form-control' value="<?php echo $DEPTIME; ?>" required></td>
            </tr>
            <tr>
                <td>ARRTIME</td>
                <td><input type='datetime-local' name='ARRTIME' class='form-control' value="<?php echo $ARRTIME; ?>" required></td>
            </tr>
            <tr>
                <td>AIRPLANE</td>
                <td><input type='number' name='AIRPLANE' class='form-control' value="<?php echo $AIRPLANE; ?>" required></td>
            </tr>
            <tr>
                <td>PILOT</td>
                <td><input type='number' name='PILOT' class='form-control' value="<?php echo $PILOT; ?>" required></td>
            </tr>
    
           

            <tr>
                <td>GATE</td>
                <td><input type='text' name='GATE' class='form-control' value="<?php echo $GATE; ?>" required></td>
            </tr>

            <tr>
                <td>SCHEDULEID</td>
                <td><input type='number' name='SCHEDULEID' class='form-control' value="<?php echo $SCHEDULEID; ?>" required></td>
            </tr>
    
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary" name="btn-update">
                    <span class="glyphicon glyphicon-edit"></span>  Edit flight
                    </button>
                    <a href="admin_start.php" class="btn btn-large btn-success" style="float: right;"><i class="glyphicon glyphicon-backward"></i> &nbsp; Cancel </a>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php include_once 'footer.php'; ?>
