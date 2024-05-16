<?php include_once 'header-pass.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 mb-3"> 
            <a href="get-flight.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; All Flights
            </a>
        </div>
        <div class="col-md-4 mb-3"> 
            <a href="get-schedule.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Review shedule
            </a>
        </div>
        
        
    </div>

<?php 


// Check if passport is provided in the URL
if(isset($_GET['passport'])) {
    $PASSPORT = $_GET['passport'];

   

    ?>
    <br />
    <div class="container"> 
        <h2>Bookings for you <?php echo $PASSPORT; ?></h2>
        <table class='table table-bordered table-responsive'> 
            <tr>
                <th>Booking ID</th>
                <th>Passport</th>
                <th>Flight Number</th>
                <th>Seat</th>
                <th>Class</th>
                <th  align="center">Actions</th>

            </tr>
            <?php    
            // Fetch and display booking data associated with the passport
            $booking->bookingDataview($PASSPORT); 
            ?>
        </table> 
    </div>
    <?php 
} else {
    // If passport is not provided in the URL, display an error message
    echo "<div class='container'><p class='alert alert-danger'>Passport number is missing.</p></div>";
}

include_once 'footer.php'; 
?>
