 
<?php include_once 'header-pass.php'; ?> 



<br />
<div class="container"> 
	<table class='table table-bordered table-responsive'> 
        <tr>
            <th>Schedule ID</th>
            <th>Schedule type</th>
            <th>Origin </th>
            <th>Destination</th>
            <th>Departure time</th>
            <th>Arrival time</th>
            
        </tr>
        <?php    
		  $schedule->dataviewPass(); 
	    ?>
    </table> 

</div>
<?php include_once 'footer.php'; ?> 