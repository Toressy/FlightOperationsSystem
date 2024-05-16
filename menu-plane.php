

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
		  $plane->dataview(); 
	    ?>
    </table> 

</div>
<?php include_once 'footer.php'; ?> 