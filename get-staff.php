<div class="container">
    <?php
    if(isset($_GET['delete_id'])) {
        $EMPNUM = $_GET['delete_id'];
        $row = $staff->getID($EMPNUM);
        ?>
        <table class='table table-bordered'>
            <tr>
                <th>EMPNUM</th>
                <th>Surname</th>
                <th>Name</th>
                <th>Date of birth</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>
            <tr>
                <td><?php echo $row['EMPNUM']; ?></td>
                <td><?php echo $row['SURNAME']; ?></td>
                <td><?php echo $row['NAME']; ?></td>
                <td><?php echo $row['DATEOFBIRTH']; ?></td>
                <td><?php echo $row['PHONE']; ?></td>
                <td><?php echo $row['ADDRESS']; ?></td>

                
            </tr>
        </table>
        <form method="post">
            <input type="hidden" name="EMPNUM" value="<?php echo $row['EMPNUM']; ?>" />
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