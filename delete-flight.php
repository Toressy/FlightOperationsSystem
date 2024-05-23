<?php 

include_once 'dbconfig.php';

if(isset($_POST['btn-del'])) {
    $FLIGHTNUM = $_GET['delete_id'];
    $flightCrud->delete($FLIGHTNUM);
    header("Location: delete-flight.php?deleted"); 
    exit();
}

include_once 'header.php';
?>

<div class="container">
    <?php
    if(isset($_GET['deleted'])) {
        ?>
        <div class="alert alert-success">
        Driver deleted successfully 
        </div>
        <?php
    } else {
        ?>
        <div class="alert alert-danger">
        Are you sure you want to delete?
        </div>
        <?php
    }
    ?>  
</div>

<div class="container">
    <?php
    if(isset($_GET['delete_id'])) {
        $FLIGHTNUM = $_GET['delete_id'];
        $flight = $flightCrud->getID($FLIGHTNUM);
        ?>
        <table class='table table-bordered'>
            <tr>
                <th>Flight number</th>
                <th>Origin</th>
                <th>Destination</th>
                <th>Dep time</th>
                <th>Arr time</th>
                <th>Airplane</th>
                <th>Pilot</th>
                <th>Gate</th>
                <th>Schedule ID</th>

            </tr>
            <tr>
                    <td><?php echo $flight->getFlightNum(); ?></td>
                    <td><?php echo $flight->getOrigin(); ?></td>
                    <td><?php echo $flight->getDestination(); ?></td>
                    <td><?php echo $flight->getDepTime(); ?></td>
                    <td><?php echo $flight->getArrTime(); ?></td>
                    <td><?php echo $flight->getAirplane(); ?></td>
                    <td><?php echo $flight->getPilot(); ?></td>
                    <td><?php echo $flight->getGate(); ?></td>
                    <td><?php echo $flight->getScheduleId(); ?></td>
            </tr>
        </table>
        <form method="post">
            <input type="hidden" name="FLIGHTNUM" value="<?php echo $row['FLIGHTNUM']; ?>" />
            <button class="btn btn-large btn-primary" type="submit" name="btn-del">
            <i class="glyphicon glyphicon-trash"></i> &nbsp; Yes</button>
            <a href="admin-start.php" class="btn btn-large btn-success">
            <i class="glyphicon glyphicon-backward"></i> &nbsp; No</a>
        </form>
        <?php
    } else {
        ?>
        <a href="admin-start.php" class="btn btn-large btn-success" style="float: right;">
        <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to menu</a>
        <?php
    }
    ?>
</div>  

<?php include_once 'footer.php'; ?>
