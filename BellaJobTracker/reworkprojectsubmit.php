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
<title>Project Submitted!</title>
<!--<link rel="stylesheet" type="text/css" href="style.css" />-->

</head>
<body>
<h1 align="center">Project Submitted Successfully!</h1>
<div align="center">
<button type="button" class="btn btn-primary btn-lg" style="background-color:rgb(207, 146, 43); border:none" onClick="window.location.href='status.php'">Status</button>
</div>

</body>

<?php
require('connect.php');

if ($_POST['project']) {
	
	$project = mysqli_real_escape_string($connection, $_POST['project']);
	$notes = mysqli_real_escape_string($connection, $_POST['notes']);
	$installdate = $_POST['installdate'];
	$originaljobid = $_POST['originaljobid'];


	// Insert project information into project details
	$Sql = "INSERT INTO projectdetails (jobflag, deleteflag, reworkflag, jobname, originaljobid, installdate, notes) 
			VALUES ('1', '0', '1', '$project', '$originaljobid', '$installdate', '$notes');";
					
	
	if (!mysqli_query($connection, $Sql)) {
	die('Error: ' . mysqli_error($connection));
	}

	
	// Insert jobid most recent jobid into project status
	$last_id = $connection->insert_id;
	$Sql2 = "INSERT INTO projectstatus (jobid)
			 VALUES ($last_id);";
	
	if (!mysqli_query($connection, $Sql2)) {
		die('Error: ' . mysqli_error($connection));
	} 

	mysqli_close($connection);	
}

?>