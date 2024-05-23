

<?php include_once 'header.php'; ?> 


</br>
<div class="container">
    <div class="row">
        <div class="col-md-4 mb-3"> 
            <a href="add-plane.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Add plane
            </a>
        </div>
        
        
    </div>
</div>

</br>
<div class="container"> 
	<table class='table table-bordered table-responsive'> 
        <tr>
            <th>Numser</th>
            <th>Aircraft </th>
            
            
            <th colspan="2" align="center">Actions</th>
        </tr>
        <?php    
		$planeCrud = $planeCrud->getAll(10);
        foreach ($plane as $row) {
            ?>
            <tr>
                <td><?php echo $row->getNumSer; ?></td>
                <td><?php echo $row->getAircraft; ?></td>
                
                <td align="center">
                    <a href="edit-plane.php?edit_id=<?php echo $row->getNumSer; ?>" class="btn btn-warning">
                        <i class="glyphicon glyphicon-edit"></i> Edit
                    </a>
                </td>
                <td align="center">
                    <a href="delete-plane.php?delete_id=<?php echo $row->getNumSer; ?>" class="btn btn-danger">
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