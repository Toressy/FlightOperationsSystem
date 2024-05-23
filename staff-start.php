<?php
include_once 'dbconfig.php';
include_once 'header-pass.php';

// Check if EMPNUM is set and not empty
if(isset($_GET['empnumber']) && !empty($_GET['empnumber'])) {
    // Get the employee number from the URL query parameters
    $EMPNUM = $_GET['empnumber'];

    // Call the getFlight function to retrieve flights assigned to the staff
    $flights = $staffCrud->getFlight($EMPNUM);
} else {
    $EMPNUM = null;
    $flights = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Flights</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php if ($EMPNUM === null): ?>
            <h2 class="mt-5">Enter Your Employee Number</h2>
            <form action="" method="GET" class="mt-3">
                <div class="form-group">
                    <label for="empnumber">Employee Number:</label>
                    <input type="text" id="empnumber" name="empnumber" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        <?php else: ?>
            <h2 class="mt-5">Flights Assigned to Employee <?php echo htmlspecialchars($EMPNUM); ?></h2>
            <?php if($flights): ?>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Flight Number</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Departure Time</th>
                        <th>Arrival Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($flights['FLIGHTNUM']); ?></td>
                        <td><?php echo htmlspecialchars($flights['ORIGIN']); ?></td>
                        <td><?php echo htmlspecialchars($flights['DESTINATION']); ?></td>
                        <td><?php echo htmlspecialchars($flights['DEPTIME']); ?></td>
                        <td><?php echo htmlspecialchars($flights['ARRTIME']); ?></td>
                    </tr>
                </tbody>
            </table>
            <?php else: ?>
            <p>No flights assigned to this employee.</p>
            <?php endif; ?>
            <a href="" class="btn btn-primary">Back</a>
        <?php endif; ?>
    </div>
</body>
</html>
<?php include_once 'footer.php'; ?>
