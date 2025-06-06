<?php
include_once 'dbconfig.php';

if(isset($_POST['btn-update'])) {
    $EMPNUM = $_GET['edit_id'];
    $SURNAME = $_POST['SURNAME'];
    $NAME = $_POST['NAME'];
    $DATEOFBIRTH = $_POST['DATEOFBIRTH'];
    $PHONE = $_POST['PHONE'];
    $ADDRESS = $_POST['ADDRESS'];
    $SALARY  = $_POST['SALARY'];
    $staff = new Staff($EMPNUM, $SURNAME, $NAME, $DATEOFBIRTH, $PHONE, $ADDRESS, $SALARY);

    

    if($staffCrud->update($staff)) {
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
    $EMPNUM = $_GET['edit_id'];
    $staffget = $staffCrud->getID($EMPNUM);
    $SURNAME = $staffget->getSurname();
    $NAME = $staffget->getName();
    $DATEOFBIRTH = $staffget->getDateOfBirth();
    $PHONE = $staffget->getPhone();
    $ADDRESS = $staffget->getAddress();
    $SALARY = $staffget->getSalary();
    
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
                <td>EMPNUM</td>
                <td><input type='number' name='EMPNUM' class='form-control' value="<?php echo $EMPNUM; ?>" required disabled></td>
            </tr>
    
            <tr>
                <td>SURNAME</td>
                <td><input type='text' name='SURNAME' class='form-control' value="<?php echo $SURNAME; ?>" required></td>
            </tr>
    
            <tr>
                <td>NAME</td>
                <td><input type='text' name='NAME' class='form-control' value="<?php echo $NAME; ?>" required></td>
            </tr>
            <tr>
                <td>DATEOFBIRTH</td>
                <td><input type='date' name='DATEOFBIRTH' class='form-control' value="<?php echo $DATEOFBIRTH; ?>" required></td>
            </tr>
            <tr>
                <td>PHONE</td>
                <td><input type='text' name='PHONE' class='form-control' value="<?php echo $PHONE; ?>" required></td>
            </tr>
            <tr>
                <td>ADDRESS</td>
                <td><input type='text' name='ADDRESS' class='form-control' value="<?php echo $ADDRESS; ?>" required></td>
            </tr>
            <tr>
                <td>SALARY</td>
                <td><input type='number' name='SALARY' class='form-control' value="<?php echo $SALARY; ?>" required></td>
            </tr>
           
    
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary" name="btn-update">
                    <span class="glyphicon glyphicon-edit"></span>  Edit staff
                    </button>
                    <a href="menu-staff.php" class="btn btn-large btn-success" style="float: right;"><i class="glyphicon glyphicon-backward"></i> &nbsp; Cancel </a>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php include_once 'footer.php'; ?>
