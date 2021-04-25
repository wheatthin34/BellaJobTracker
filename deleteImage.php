<head>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="apple-touch-icon" sizes="180x180" href="apple-icon.png">

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<div align="center" class="logo-image" id="spacetaker">
<img src="bella_logo.png" style="max-width:100%; height:auto !important;">
</div>
<title>Image Removed!</title>
<!--<link rel="stylesheet" type="text/css" href="style.css" />-->

</head>
<body>
<h1 align="center">Image Removed Successfully!</h1>
<div align="center">
<button type="button" class="btn btn-primary btn-lg" onClick="window.location.href='status.php'">Main Menu</button>
</div>

</body>


<?php
require('connect.php');


if (isset($_GET["imageid"])){
	$imageid = $_GET["imageid"];
	$jobid = $_GET["jobid"];
	$pagetitle = $_GET["pagetitle"];
}


echo $imageid;
echo $jobid;
echo $pagetitle;


$delete = "DELETE FROM images WHERE imageid = '$imageid'";

if ($pagetitle == "projectupdate"){
	if (!mysqli_query($connection, $delete)) {
		die('Error: ' . mysqli_error($connection));
		}
	else {
		mysqli_close($connection);
		header('location:projectupdate.php?jobid=' . $jobid);
		exit;
	}
}

if ($pagetitle == "projectcompleteupdate"){
	if (!mysqli_query($connection, $delete)) {
		die('Error: ' . mysqli_error($connection));
		}
	else {
		mysqli_close($connection);
		header('location:projectcompleteupdate.php?jobid=' . $jobid);
		exit;
	}
}

if ($pagetitle == "reworkupdate"){
	if (!mysqli_query($connection, $delete)) {
		die('Error: ' . mysqli_error($connection));
		}
	else {
		mysqli_close($connection);
		header('location:reworkupdate.php?jobid=' . $jobid);
		exit;
	}
}


?>

