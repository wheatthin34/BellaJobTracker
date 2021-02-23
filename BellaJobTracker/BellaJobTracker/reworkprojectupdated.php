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
	
	$statusquery = mysqli_query($connection, "SELECT a.jobid, b.jobname, a.templatedate, a.workorderdate, a.materialdate, a.sinkdate, a.fabdate, a.installeddate, a.billeddate
							from projectstatus a
							left join projectdetails b
							on a.jobid = b.jobid
							where a.jobid = '$jobid'");

	while ($result = mysqli_fetch_array($statusquery, MYSQLI_ASSOC)){
		
		$jobname = $result['jobname'];
		$templatedate = $result['templatedate'];
		$workorderdate = $result['workorderdate'];
		$materialdate = $result['materialdate'];
		$sinkdate = $result['sinkdate'];
		$fabdate = $result['fabdate'];
		$installeddate = $result['installeddate'];
		$billeddate = $result['billeddate'];
	}
	

	if (isset($_POST['templatebit'])){
		$templatebit = $_POST['templatebit'];
		if ($templatedate == NULL){
			$query = "UPDATE projectstatus SET templatedate = CURRENT_TIMESTAMP
										  WHERE jobid = '$jobid'";
			if (!mysqli_query($connection, $query)) {
				die('Error: ' . mysqli_error($connection));
			}
		}
		else {
			/*do nothing*/
		}
	}
	else {
		$templatebit = 0;
		$query = "UPDATE projectstatus SET templatedate = NULL
										  WHERE jobid = '$jobid'";
		if (!mysqli_query($connection, $query)) {
			die('Error: ' . mysqli_error($connection));
		}
	}




	if (isset($_POST['notes'])){
		$notes = $_POST['notes'];
		$query = "UPDATE projectdetails SET notes = '$notes'
										  WHERE jobid = '$jobid'";
		if (!mysqli_query($connection, $query)) {
			die('Error: ' . mysqli_error($connection));
		}
	}




	if (isset($_POST['workorderbit'])){
		$workorderbit = $_POST['workorderbit'];
		if ($workorderdate == NULL){
			$query = "UPDATE projectstatus SET workorderdate = CURRENT_TIMESTAMP
										  WHERE jobid = '$jobid'";
			if (!mysqli_query($connection, $query)) {
				die('Error: ' . mysqli_error($connection));
			}
		}
		else {
			/*do nothing*/
		}
	}
	else {
		$workorderbit = 0;
		$query = "UPDATE projectstatus SET workorderdate = NULL
										  WHERE jobid = '$jobid'";
		if (!mysqli_query($connection, $query)) {
			die('Error: ' . mysqli_error($connection));
		}
	}




	if (isset($_POST['materialbit'])){
		$materialbit = $_POST['materialbit'];
		if ($materialdate == NULL){
			$query = "UPDATE projectstatus SET materialdate = CURRENT_TIMESTAMP
										  WHERE jobid = '$jobid'";
			if (!mysqli_query($connection, $query)) {
				die('Error: ' . mysqli_error($connection));
			}
		}
		else {
			/*do nothing*/
		}
	}
	else {
		$materialbit = 0;
		$query = "UPDATE projectstatus SET materialdate = NULL
										  WHERE jobid = '$jobid'";
		if (!mysqli_query($connection, $query)) {
			die('Error: ' . mysqli_error($connection));
		}
	}




	if (isset($_POST['fabbit'])){
		$fabbit = $_POST['fabbit'];
		if ($fabdate == NULL){
			$query = "UPDATE projectstatus SET fabdate = CURRENT_TIMESTAMP
										  WHERE jobid = '$jobid'";
			if (!mysqli_query($connection, $query)) {
				die('Error: ' . mysqli_error($connection));
			}
		}
		else {
			/*do nothing*/
		}
	}
	else {
		$fabbit = 0;
		$query = "UPDATE projectstatus SET fabdate = NULL
										  WHERE jobid = '$jobid'";
		if (!mysqli_query($connection, $query)) {
			die('Error: ' . mysqli_error($connection));
		}
	}




	if (isset($_POST['installedbit'])){
		$installedbit = $_POST['installedbit'];
		$billedbit = 1;
		$sinkbit = 1;
		if ($installeddate == NULL){
			$query = "UPDATE projectstatus SET installeddate = CURRENT_TIMESTAMP
										  WHERE jobid = '$jobid'";
			if (!mysqli_query($connection, $query)) {
				die('Error: ' . mysqli_error($connection));
			}
		}
		else {
			/*do nothing*/
		}
	}
	else {
		$installedbit = 0;
		$query = "UPDATE projectstatus SET installeddate = NULL
										  WHERE jobid = '$jobid'";
		if (!mysqli_query($connection, $query)) {
			die('Error: ' . mysqli_error($connection));
		}
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


if (isset($_POST['completed'])){
	
?>

<body>

<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-black">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-1">
                    <div class="px-1">
					<h3>Sample Updated!</h3>
					<button type="button" class="btn btn-primary btn-lg" onClick="window.location.href='completeproject.php'">Completed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>

<?php
	
}
else{

?>

<body>

<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-black">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-1">
                    <div class="px-1">
					<h3>Project Updated!</h3>
					<button type="button" class="btn btn-primary btn-lg" onClick="window.location.href='status.php'">Opened</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>

<?php

}

?>