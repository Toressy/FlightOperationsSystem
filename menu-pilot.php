

<?php include_once 'header.php'; ?> 


</br>
<div class="container">
    <div class="row">
        <div class="col-md-4 mb-3"> 
            <a href="add-pilot.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Add pilot
            </a>
        </div>
        
        
    </div>
</div>

</br>
<div class="container"> 
	<table class='table table-bordered table-responsive'> 
        <tr>
            <th>Employee number</th>
            <th>Surname </th>
            <th>Name</th>
            <th>Date of birth</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Salary</th>
            <th>Total hours</th>
            
            <th colspan="2" align="center">Actions</th>
        </tr>
        <?php   
        $flights = $staffCrud->getAll(10);
        $pilotCrud = $pilotCrud->getAll(10);
        $employees = array_merge($flights, $pilots);
        foreach ($employees as $row) {
            ?>
            <tr>
                <td><?php echo ($row->getEmpNum()); ?></td>
                <td><?php echo ($row->getSurname()); ?></td>
                <td><?php echo ($row->getName()); ?></td>
                <td><?php echo ($row->getDateOfBirth()); ?></td>
                <td><?php echo ($row->getPhone()); ?></td>
                <td><?php echo ($row->getAddress()); ?></td>
                <td><?php echo ($row->getSalary()); ?></td>
                <td><?php echo ($row->getTotalFlightNumber()); ?></td>
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