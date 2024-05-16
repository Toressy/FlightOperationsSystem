<?php 

include_once 'dbconfig.php';

if(isset($_POST['btn-del'])) {
    if(isset($_GET['delete_id'])) {
        $NUMSER = $_GET['delete_id'];
        if ($plane->delete($NUMSER)) {
            header("Location: delete-plane.php?deleted"); // Redirect after successful deletion
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
        Plane deleted successfully 
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
        $NUMSER = $_GET['delete_id'];
        $row = $plane->getID($NUMSER);
        if ($row) {
            ?>
            <table class='table table-bordered'>
                <tr>
                    <th>NUMSER</th>
                    <th>Aircraft</th>
                    <th>Name</th>
                    <th>Date of birth</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Hours</th>
                </tr>
                <tr>
                    <td><?php echo $row['NUMSER']; ?></td>
                    <td><?php echo $row['AIRCRAFT']; ?></td>
                </tr>
            </table>
            <form method="post">
                <input type="hidden" name="NUMSER" value="<?php echo $row['NUMSER']; ?>" />
                <button class="btn btn-large btn-primary" type="submit" name="btn-del">
                <i class="glyphicon glyphicon-trash"></i> &nbsp; Yes</button>
                <a href="menu-plane.php" class="btn btn-large btn-success">
                <i class="glyphicon glyphicon-backward"></i> &nbsp; No</a>
            </form>
            <?php
        } else {
            echo "Plane not found.";
        }
    } else {
        ?>
        <a href="menu-plane.php" class="btn btn-large btn-success" style="float: right;">
        <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to menu</a>
        <?php
    }
    ?>
</div>  

<?php include_once 'footer.php'; ?>
