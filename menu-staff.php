 
<?php include_once 'header.php'; ?> 


</br>
<div class="container">
    <div class="row">
        <div class="col-md-4 mb-3"> 
            <a href="add-staff.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Add staff
            </a>
        </div>
        
        
    </div>
</div>


<br />
<div class="container"> 
	<table class='table table-bordered table-responsive'> 
        <tr>
            <th>Employee number</th>
            <th>Surname </th>
            <th>Name</th>
            <th>Date of birth</th>
            <th>Number</th>
            <th>Address</th>
            <th>Salary</th>
            <th colspan="2" align="center">Actions</th>
        </tr>
        <?php   
        $staff = $staffCrud->getAll(10);
        foreach ($staff as $row) {
            ?>
            <tr>
                <td><?php echo ($row->getEmpNum()); ?></td>
                <td><?php echo ($row->getSurname()); ?></td>
                <td><?php echo ($row->getName()); ?></td>
                <td><?php echo ($row->getDateOfBirth()); ?></td>
                <td><?php echo ($row->getPhone()); ?></td>
                <td><?php echo ($row->getAddress()); ?></td>
                <td><?php echo ($row->getSalary()); ?></td>
                <td align="center">
                    <a href="edit-staff.php?edit_id=<?php echo ($row->getEmpNum()); ?>" class="btn btn-warning">
                        <i class="glyphicon glyphicon-edit"></i> Edit
                    </a>
                </td>
                <td align="center">
                    <a href="delete-staff.php?delete_id=<?php echo ($row->getEmpNum()); ?>" class="btn btn-danger">
                        <i class="glyphicon glyphicon-remove-circle"></i> Delete
                    </a>
                </td>
            </tr>
            <?php
        } 
	    ?>
    </table> 

</div>
<?php include_once 'footer.php'; ?> 