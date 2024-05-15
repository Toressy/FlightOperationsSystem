<?php
include_once 'dbconfig.php';


if(isset($_POST['btn-update'])) {
    $CAR_ID = $_GET['edit_id'];
    $DRIVER_ID = $_POST['DRIVER_ID'];
    $CAR_TYPE = $_POST['CAR_TYPE'];
    $RED_CAR = $_POST['RED_CAR'];
    $CAR_AGE = $_POST['CAR_AGE'];

    if($crud->updateCar($CAR_ID, $DRIVER_ID, $CAR_TYPE, $RED_CAR, $CAR_AGE)) {
        $msg = "<div class='alert alert-info'>
                Car details updated successfully
                </div>";
    } else {
        $msg = "<div class='alert alert-warning'>
                Error updating car details
                </div>";
    }
}


if(isset($_GET['edit_id'])) {
    $CAR_ID = $_GET['edit_id'];
    $car = $crud->getCarById($CAR_ID);
    $DRIVER_ID = $car['DRIVER_ID'];
    $CAR_TYPE = $car['CAR_TYPE'];
    $RED_CAR = $car['RED_CAR'];
    $CAR_AGE = $car['CAR_AGE'];
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
                <td>Driver ID</td>
                <td>
                    <select name="DRIVER_ID" class="form-control">
                        <?php
                        
                        $drivers = $crud->getAllDrivers();
                        foreach ($drivers as $driver) {
                            echo "<option value='".$driver['DRIVER_ID']."' ".($driver['DRIVER_ID'] == $DRIVER_ID ? 'selected' : '').">".$driver['DRIVER_ID']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
    
            <tr>
                <td>Car Type</td>
                <td><input type='text' name='CAR_TYPE' class='form-control' value="<?php echo $CAR_TYPE; ?>" required></td>
            </tr>
    
            <tr>
                <td>Red Car</td>
                <td>
                    <select name='RED_CAR' class='form-control' required>
                        <option value='yes' <?php if($RED_CAR == 'yes') echo 'selected'; ?>>yes</option>
                        <option value='no' <?php if($RED_CAR == 'no') echo 'selected'; ?>>no</option>
                    </select>
                </td>
            </tr>

    
            <tr>
                <td>Car Age</td>
                <td><input type='number' name='CAR_AGE' class='form-control' value="<?php echo $CAR_AGE; ?>" required></td>
            </tr>
    
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary" name="btn-update">
                    <span class="glyphicon glyphicon-edit"></span>  Edit Car
                    </button>
                    <a href="show-car.php?driver_id=<?php echo $DRIVER_ID; ?>" class="btn btn-large btn-success" style="float: right;">
                        <i class="glyphicon glyphicon-backward"></i> &nbsp; Cancel
                    </a>

                </td>
            </tr>
        </table>
    </form>
</div>

<?php include_once 'footer.php'; ?>
