

<?php include_once 'header.php'; ?> 


</br>
<div class="container">
    <div class="row">
        <div class="col-md-4 mb-3"> 
            <a href="add-flight.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Add flight
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
            
        </tr>
        <?php   


        $flights = $flightCrud->getAll(10);

        foreach ($flights as $row) {
            ?>
            <tr>
                <td><?php echo ($row->getFlightNum()); ?></td>
                <td><?php echo ($row->getOrigin()); ?></td>
                <td><?php echo ($row->getDestination()); ?></td>
                <td><?php echo ($row->getDepTime()); ?></td>
                <td><?php echo ($row->getArrTime()); ?></td>
                <td><?php echo ($row->getAirplane()); ?></td>
                <td><?php echo ($row->getPilot()); ?></td>
                <td><?php echo ($row->getGate()); ?></td>
                <td><?php echo ($row->getScheduleId()); ?></td>
                <td align="center">
                    <a href="edit-flight.php?edit_id=<?php echo ($row->getFlightNum()); ?>" class="btn btn-warning">
                        <i class="glyphicon glyphicon-edit"></i> Edit
                    </a>
                </td>
                <td align="center">
                    <a href="delete.php?delete_id=<?php echo ($row->getFlightNum()); ?>" class="btn btn-danger">
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