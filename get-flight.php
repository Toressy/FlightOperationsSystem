

<?php include_once 'header-pass.php'; ?> 



<br />
<div class="container"> 
	<table class='table table-bordered table-responsive'> 
        <tr>
            <th>Flight number</th>
            <th>Origin </th>
            <th>Destination</th>
            <th>Departure time</th>
            <th>Arrival time</th>
            <th>Actions</th>
        </tr>
        <?php    
		  $bookingCrud->flightview(); 
	    ?>
    </table> 

</div>
<?php include_once 'footer.php'; ?> 