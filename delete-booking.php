<?php 

include_once 'dbconfig.php';

if(isset($_POST['btn-del'])) {
    if(isset($_GET['delete_id'])) {
        $BOOKINGID = $_GET['delete_id'];
        if ($passenger->delete($EMPNUM)) {
            header("Location: delete-pilot.php?deleted"); // Redirect after successful deletion
            exit();
        } else {
            // Handle deletion failure
            echo "Failed to delete pilot.";
        }
    } else {
        // Handle invalid delete request
        echo "Invalid delete request.";
    }
}

include_once 'header.php';
?>

<div class="container">
    <?php
    if(isset($_GET['deleted'])) {
        ?>
        <div class="alert alert-success">
        Pilot deleted successfully 
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
        $EMPNUM = $_GET['delete_id'];
        $row = $pilot->getID($EMPNUM);
        if ($row) {
            ?>
            <table class='table table-bordered'>
                <tr>
                    <th>EMPNUM</th>
                    <th>Surname</th>
                    <th>Name</th>
                    <th>Date of birth</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Hours</th>
                </tr>
                <tr>
                    <td><?php echo $row['EMPNUM']; ?></td>
                    <td><?php echo $row['SURNAME']; ?></td>
                    <td><?php echo $row['NAME']; ?></td>
                    <td><?php echo $row['DATEOFBIRTH']; ?></td>
                    <td><?php echo $row['PHONE']; ?></td>
                    <td><?php echo $row['ADDRESS']; ?></td>
                    <td><?php echo $row['TOTALFLIGHTHOURS']; ?></td>
                    
                </tr>
            </table>
            <form method="post">
                <input type="hidden" name="EMPNUM" value="<?php echo $row['EMPNUM']; ?>" />
                <button class="btn btn-large btn-primary" type="submit" name="btn-del">
                <i class="glyphicon glyphicon-trash"></i> &nbsp; Yes</button>
                <a href="menu-pilot.php" class="btn btn-large btn-success">
                <i class="glyphicon glyphicon-backward"></i> &nbsp; No</a>
            </form>
            <?php
        } else {
            echo "Pilot not found.";
        }
    } else {
        ?>
        <a href="menu-pilot.php" class="btn btn-large btn-success" style="float: right;">
        <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to menu</a>
        <?php
    }
    ?>
</div>  

<?php include_once 'footer.php'; ?>
