 
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
            <th colspan="2" align="center">Actions</th>
        </tr>
        <?php    
		  $staff->dataview(); 
	    ?>
    </table> 

</div>
<?php include_once 'footer.php'; ?> 