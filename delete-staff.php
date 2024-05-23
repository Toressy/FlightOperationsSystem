<?php 

include_once 'dbconfig.php';

if(isset($_POST['btn-del'])) {
    $EMPNUM = $_GET['delete_id'];
    $staffCrud->delete($EMPNUM);
    header("Location: delete-staff.php?deleted"); 
    exit();
}

include_once 'header.php';
?>

<div class="container">
    <?php
    if(isset($_GET['deleted'])) {
        ?>
        <div class="alert alert-success">
        Staff deleted successfully 
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
        $row = $staffCrud->getID($EMPNUM);
        ?>
        <table class='table table-bordered'>
            <tr>
                <th>EMPNUM</th>
                <th>Surname</th>
                <th>Name</th>
                <th>Date of birth</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Salary</th>
            </tr>
            <tr>
                <td><?php echo $row->getEmpNum(); ?></td>
                <td><?php echo $row->getSurname(); ?></td>
                <td><?php echo $row->getName(); ?></td>
                <td><?php echo $row->getDateOfBirth(); ?></td>
                <td><?php echo $row->getPhone(); ?></td>
                <td><?php echo $row->getAddress() ?></td>
                <td><?php echo $row->getSalary() ?></td>

                
            </tr>
        </table>
        <form method="post">
            <input type="hidden" name='delete_id' value="<?php echo $row->getEmpNum(); ?>" />
            <button class="btn btn-large btn-primary" type="submit" name="btn-del">
            <i class="glyphicon glyphicon-trash"></i> &nbsp; Yes</button>
            <a href="menu-staff.php" class="btn btn-large btn-success">
            <i class="glyphicon glyphicon-backward"></i> &nbsp; No</a>
        </form>
        <?php
    } else {
        ?>
        <a href="menu-staff.php" class="btn btn-large btn-success" style="float: right;">
        <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to menu</a>
        <?php
    }
    ?>
</div>  

<?php include_once 'footer.php'; ?>
