<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claim Amount by Driver Gender and Car Color</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Claim Amount by Driver Gender and Red Car</h1>
        <div class="row">
            <div class="col-md-6">
                <canvas id="genderAmountChart" width="400" height="200"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="redCarClaimChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <script>
        <?php
        include_once 'dbconfig.php';

        $genderQuery = "SELECT D.GENDER, COUNT(*) AS CLAIM_COUNT
        FROM Driver D
        JOIN Car C ON D.DRIVER_ID = C.DRIVER_ID
        JOIN Claim CL ON C.CAR_ID = CL.CAR_ID
        GROUP BY D.GENDER;";
        $genderResult = $mysqli->query($genderQuery);

        $genders = [];
        $claimCounts = [];

        while ($row = $genderResult->fetch_assoc()) {
            $genders[] = $row['GENDER'];
            $claimCounts[] = $row['CLAIM_COUNT'];
        }

        $redCarQuery = "SELECT C.RED_CAR, COUNT(*) AS CLAIM_COUNT
        FROM Car C
        JOIN Claim CL ON C.CAR_ID = CL.CAR_ID
        WHERE C.RED_CAR = 'yes'
        GROUP BY C.RED_CAR;";
        $redCarResult = $mysqli->query($redCarQuery);

        $redCarClaimCount = 0;

        if ($redCarRow = $redCarResult->fetch_assoc()) {
            $redCarClaimCount = $redCarRow['CLAIM_COUNT'];
        }

        $mysqli->close();
        ?>

        var genderAmountCtx = document.getElementById('genderAmountChart').getContext('2d');
        var genderAmountChart = new Chart(genderAmountCtx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($genders); ?>,
                datasets: [{
                    label: 'Claim Amount by Driver Gender',
                    data: <?php echo json_encode($claimCounts); ?>,
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var redCarClaimCtx = document.getElementById('redCarClaimChart').getContext('2d');
        var redCarClaimChart = new Chart(redCarClaimCtx, {
            type: 'pie',
            data: {
                labels: ['Red Car', 'Other Cars'],
                datasets: [{
                    label: 'Claim Amount by Red Car',
                    data: [<?php echo $redCarClaimCount; ?>, <?php echo array_sum($claimCounts) - $redCarClaimCount; ?>],
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

<div class="container">
    <a href="index.php" class="btn btn-large btn-success" style="float: right;">
<i class="glyphicon glyphicon-backward"></i> &nbsp; Back to menu</a>
  
    </div>
</body>
</html>
