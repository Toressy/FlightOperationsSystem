

<?php include_once 'header.php'; ?> 



<br />
<div class="container"> 
	<table class='table table-bordered table-responsive'> 
        <tr>
            <th>Flight number</th>
            <th>Origin </th>
            <th>Destination</th>
            <th>Departure time</th>
            <th>Arrival time</th>
            <th>Airplane</th>
            <th>Pilot</th>
            <th>Gate</th>
            <th>Schedule ID</th>
            <th colspan="2" align="center">Actions</th>
            <th>Car</th>
        </tr>
        <?php    
		  $flight->dataview(); 
	    ?>
    </table> 

</div>
<?php include_once 'footer.php'; ?> 