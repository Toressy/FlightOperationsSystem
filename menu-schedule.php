 
<?php include_once 'header.php'; ?> 


</br>
<div class="container">
    <div class="row">
        <div class="col-md-4 mb-3"> 
            <a href="add-schedule.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Add schedule
            </a>
        </div>
        
        
    </div>
</div>


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
            <th colspan="2" align="center">Actions</th>
        </tr>
        <?php    
		  $schedule->dataview(); 
	    ?>
    </table> 

</div>
<?php include_once 'footer.php'; ?> 