<?php
include_once 'dbconfig.php';

if(isset($_POST['btn-update'])) {
    $NUMSER = $_GET['edit_id'];
    $AIRCRAFT = $_POST['AIRCRAFT'];
    

    if($planeCrud->update($NUMSER, $AIRCRAFT)) {
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
    $NUMSER = $_GET['edit_id'];
    $planeget = $planeCrud->getID($NUMSER);
    
    $AIRCRAFT = $planeget['AIRCRAFT'];
    
    
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
                <td>NUMSER</td>
                <td><input type='number' name='NUMSER' class='form-control' value="<?php echo $NUMSER; ?>" required></td>
            </tr>
    
            <tr>
                <td>AIRCRAFT</td>
                <td><input type='text' name='AIRCRAFT' class='form-control' value="<?php echo $AIRCRAFT; ?>" required></td>
            </tr>
    
           
    
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary" name="btn-update">
                    <span class="glyphicon glyphicon-edit"></span>  Edit plane
                    </button>
                    <a href="menu-plane.php" class="btn btn-large btn-success" style="float: right;"><i class="glyphicon glyphicon-backward"></i> &nbsp; Cancel </a>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php include_once 'footer.php'; ?>
