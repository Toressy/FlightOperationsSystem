<?php 

include_once 'dbconfig.php';

if(isset($_POST['btn-del'])) {
    if(isset($_GET['delete_id'])) {
        $BOOKINGID = $_GET['delete_id'];
        if ($bookingCrud->delete($BOOKINGID)) {
            header("Location: delete-booking.php?deleted"); // Redirect after successful deletion
            exit();
        } else {
            // Handle deletion failure
            echo "Failed to delete booking.";
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
        Booking deleted successfully 
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
        $BOOKINGID = $_GET['delete_id'];
        $row = $bookingCrud->getID($BOOKINGID);
        if ($row) {
            ?>
            <table class='table table-bordered'>
                <tr>
                    <th>Booking ID</th>
                    <th>Passport</th>
                    <th>Flight number</th>
                    <th>Seat </th>
                    <th>Class</th>
                </tr>
                <tr>
                    <td><?php echo $row['BOOKINGID']; ?></td>
                    <td><?php echo $row['PASSPORT']; ?></td>
                    <td><?php echo $row['FLIGHTNUM']; ?></td>
                    <td><?php echo $row['SEAT']; ?></td>
                    <td><?php echo $row['CLASS']; ?></td>
                    
                </tr>
            </table>
            <form method="post">
                <input type="hidden" name="BOOKINGID" value="<?php echo $row['BOOKINGID']; ?>" />
                <button class="btn btn-large btn-primary" type="submit" name="btn-del">
                <i class="glyphicon glyphicon-trash"></i> &nbsp; Yes</button>
                <a href="pass-booking.php?passport=<?php echo $row['PASSPORT']; ?>" class="btn btn-large btn-success">
                    <i class="glyphicon glyphicon-backward"></i> &nbsp; No
                </a>

            </form>
            <?php
        } else {
            echo "Booking not found.";
        }
    } else {
        ?>
        <a href="pass-booking.php?passport=<?php echo $row['PASSPORT']; ?>" class="btn btn-large btn-success" style="float: right;">
        <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to menu</a>
        <?php
    }
    ?>
</div>  

<?php include_once 'footer.php'; ?>
