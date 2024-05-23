<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Airline
</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
</head>
<body>
	<div class="navbar navbar-default navbar-static-top" role="navigation">
    	<div class="container">
    	</div>
	</div>
	<?php include_once 'dbconfig.php'; ?> 

	<div class="container">
    <div class="row">
        <div class="col-md-4 mb-3"> 
            <a href="admin-start.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Review flight
            </a>
        </div>
        <div class="col-md-4 mb-3"> 
            <a href="menu-staff.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Review staff
            </a>
        </div>
        <div class="col-md-4 mb-3"> 
            <a href="menu-pilot.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Review pilot
            </a>
        </div>
        <div class="col-md-4 mb-3"> 
            <a href="menu-plane.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Review plane
            </a>
        </div>
		<div class="col-md-4 mb-3"> 
            <a href="menu-schedule.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Review schedule
            </a>
        </div>
        <div class="col-md-4 mb-3"> 
            <a href="menu-schedule.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Review passenger
            </a>
        </div>
        <div class="col-md-4 mb-3"> 
            <a href="menu-schedule.php" class="btn btn-large btn-info btn-block">
                <i class="glyphicon glyphicon-plus"></i> &nbsp; Review booking
            </a>
        </div>
        
    </div>
</div>