
<?php include_once 'dbconfig.php'; ?> 
<?php include_once 'header.php'; ?> 

<div class="container">
    <div class="row">
        <div class="col-md-4 mb-3"> 
            <a href="add-flight.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Add flight
            </a>
        </div>
        <div class="col-md-4 mb-3"> 
            <a href="add-staff.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Add staff
            </a>
        </div>
        <div class="col-md-4 mb-3"> 
            <a href="add-pilot.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Add pilot
            </a>
        </div>
        <div class="col-md-4 mb-3"> 
            <a href="add-plane.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Add plane
            </a>
        </div>
        
    </div>
</div>


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