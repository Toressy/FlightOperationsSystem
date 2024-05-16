<?php 

include_once 'dbconfig.php';

if(isset($_POST['btn-del'])) {
    if(isset($_GET['delete_id'])) {
        $SCHEDULEID = $_GET['delete_id'];
        if ($schedule->delete($SCHEDULEID)) {
            header("Location: delete-schedule.php?deleted"); // Redirect after successful deletion
            exit();
        } else {
            // Handle deletion failure
            echo "Failed to delete schedule.";
        }
    } else {
        // Handle invalid delete request
        echo "Invalid delete request.";
    }
}

include_once 'header-pass.php';
?>

<div class="container">
    <?php
    if(isset($_GET['deleted'])) {
        ?>
        <div class="alert alert-success">
        Schedule deleted successfully 
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
        $SCHEDULEID = $_GET['delete_id'];
        $row = $schedule->getID($SCHEDULEID);
        if ($row) {
            ?>
            <table class='table table-bordered'>
                <tr>
                    <th>Schedule ID</th>
                    <th>Schedule Type</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                </tr>
                <tr>
                    <td><?php echo $row['SCHEDULEID']; ?></td>
                    <td><?php echo $row['SCHEDULETYPE']; ?></td>
                    <td><?php echo $row['ORIGIN']; ?></td>
                    <td><?php echo $row['DESTINATION']; ?></td>
                    <td><?php echo $row['DEPTIME']; ?></td>
                    <td><?php echo $row['ARRTIME']; ?></td>
                </tr>
            </table>
            <form method="post">
                <input type="hidden" name="SCHEDULEID" value="<?php echo $row['SCHEDULEID']; ?>" />
                <button class="btn btn-large btn-primary" type="submit" name="btn-del">
                <i class="glyphicon glyphicon-trash"></i> &nbsp; Yes</button>
                <a href="view-schedule.php" class="btn btn-large btn-success">
                    <i class="glyphicon glyphicon-backward"></i> &nbsp; No
                </a>

            </form>
            <?php
        } else {
            echo "Schedule not found.";
        }
    } else {
        ?>
        <a href="view-schedule.php" class="btn btn-large btn-success" style="float: right;">
        <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to schedule</a>
        <?php
    }
    ?>
</div>  

<?php include_once 'footer.php'; ?>
