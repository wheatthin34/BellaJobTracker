<head>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="apple-touch-icon" sizes="180x180" href="apple-icon.png">

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<div align="center" class="logo-image" id="spacetaker">
<a href="http://team.BellaStoneDesigns.com">
<img src="bella_logo.png" style="max-width:100%; height:auto !important;">
</a>
</div>
<title>Project Updated!</title>
<!--<link rel="stylesheet" type="text/css" href="style.css" />-->

</head>

<?php

require('connect.php');

	if (isset($_POST['jobid'])){
		$jobid = $_POST['jobid'];
	}
	else {
		$jobid = 0;
	}
	if (isset($_POST['templatebit'])){
		$templatebit = $_POST['templatebit'];
	}
	else {
		$templatebit = 0;
	}
	if (isset($_POST['workorderbit'])){
		$workorderbit = $_POST['workorderbit'];
	}
	else {
		$workorderbit = 0;
	}
	if (isset($_POST['materialbit'])){
		$materialbit = $_POST['materialbit'];
	}
	else {
		$materialbit = 0;
	}
	if (isset($_POST['sinkbit'])){
		$sinkbit = $_POST['sinkbit'];
	}
	else {
		$sinkbit = 0;
	}
	if (isset($_POST['fabbit'])){
		$fabbit = $_POST['fabbit'];
	}
	else {
		$fabbit = 0;
	}
	if (isset($_POST['installedbit'])){
		$installedbit = $_POST['installedbit'];
	}
	else {
		$installedbit = 0;
	}
	if (isset($_POST['billedbit'])){
		$billedbit = $_POST['billedbit'];
	}
	else {
		$billedbit = 0;
	}


$query = "UPDATE projectstatus SET templatebit = '$templatebit', 
																  workorderbit = '$workorderbit', 
																  materialbit = '$materialbit',
																  sinkbit = '$sinkbit',
																  fabbit = '$fabbit',
																  installedbit = '$installedbit',
																  billedbit = '$billedbit'
										  WHERE jobid = '$jobid'";


if (!mysqli_query($connection, $query)) {
	die('Error: ' . mysqli_error($connection));
} 

mysqli_close($connection);

?>

<body>

<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-black">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-1">
                    <div class="px-1">
					<h3>Project Updated!</h3>
					<button type="button" style="background-color:rgb(207, 146, 43); border:none" class="btn btn-primary btn-lg" onClick="window.location.href='completeproject.php'">Completed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>