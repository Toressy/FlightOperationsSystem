

<?php include_once 'header.php'; ?> 




<br />
<div class="container"> 
	<table class='table table-bordered table-responsive'> 
        <tr>
            <th>Employee number</th>
            <th>Surname </th>
            <th>Name</th>
            <th>Date of birth</th>
            <th>Total hours</th>
            
            <th colspan="2" align="center">Actions</th>
        </tr>
        <?php    
		  $pilot->dataview(); 
	    ?>
    </table> 

</div>
<?php include_once 'footer.php'; ?> 