<head>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="apple-touch-icon" sizes="180x180" href="apple-icon.png">

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script type="text/javascript">

$(document).ready(function () {
    $("#sampleupdateform").submit(function () {
        $("#submitbtn").attr("disabled", true);
        return true;
    });
});

</script>

<div align="center" class="logo-image" id="spacetaker">
<a href="http://team.BellaStoneDesigns.com">
<img src="bella_logo.png" style="max-width:100%; height:auto !important;">
</a>
</div>
<title>Project Update</title>
<!--<link rel="stylesheet" type="text/css" href="style.css" />-->

</head>

<?php

require('connect.php');

$rcvdjobid = htmlspecialchars($_GET["jobid"]);

$statusquery = mysqli_query($connection, "SELECT a.*, b.*
							from projectstatus a
							left join projectdetails b
							on a.jobid = b.jobid
							where a.jobid = '$rcvdjobid'");

while ($result = mysqli_fetch_array($statusquery, MYSQLI_ASSOC)){
	
	$jobid = $result['jobid'];
	$jobname = $result['jobname'];

	$templatebit = $result['templatebit'];
	$templatedate = $result['templatedate'];

	$workorderbit = $result['workorderbit'];
	$workorderdate = $result['workorderdate'];

	$materialbit = $result['materialbit'];
	$materialdate = $result['materialdate'];

	$fabbit = $result['fabbit'];
	$fabdate = $result['fabdate'];

	$installedbit = $result['installedbit'];
	$installeddate = $result['installeddate'];

	$installdate = $result['installdate'];
	$formatdate = date("m-d-Y", strtotime($installdate));

	$notes = $result['notes'];
}

?>

<body>

<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-black">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-1">
                    <div class="px-1">
					<h3>Project Update - <?php echo $jobname ?> </h3>
						<div class="row">
							<div class="col"><h4>Install Date: </h4></div> <div class="col"><h4><?php echo $formatdate ?> </h4></div>
						</div>	
                        <form enctype="multipart/form-data" id="projectupdateform" action="reworkprojectupdated.php" method="post" class="justify-content-center">
							<p><input type="hidden" name="jobid" value="<?php echo $rcvdjobid ?>"/></p>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<label>Template Complete:</label>
									</div>	
								</div>
								<div class="col">
									<div class="form-group">
										<?php if ($templatebit == 1){ ?>
										<input type="checkbox" checked value="1" class="form-control" name="templatebit" id="templatebit">
										<?php }
										else { ?>
										<input type="checkbox" value="1" class="form-control" name="templatebit" id="templatebit">
										<?php } ?>
									</div>	
								</div>
								<div class="col">
									<?php echo $templatedate; ?>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<label>Work Order In Shop:</label>
									</div>	
								</div>
								<div class="col">
									<div class="form-group">
										<?php if ($workorderbit == 1){ ?>
										<input type="checkbox" checked value="1" class="form-control" name="workorderbit" id="workorderbit">
										<?php }
										else{ ?>
										<input type="checkbox" value="1" class="form-control" name="workorderbit" id="workorderbit">
										<?php } ?>
									</div>	
								</div>
								<div class="col">
									<?php echo $workorderdate; ?>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<label>Material On Hand:</label>
									</div>	
								</div>
								<div class="col">
									<div class="form-group">
										<?php if ($materialbit == 1){ ?>
										<input type="checkbox" checked value="1" class="form-control" name="materialbit" id="materialbit">
										<?php }
										else{ ?>
										<input type="checkbox" value="1" class="form-control" name="materialbit" id="materialbit">
										<?php } ?>
									</div>	
								</div>
								<div class="col">
									<?php echo $materialdate; ?>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<label>Fabrication Complete:</label>
									</div>	
								</div>
								<div class="col">
									<div class="form-group">
										<?php if ($fabbit == 1){ ?>
										<input type="checkbox" checked value="1" class="form-control" name="fabbit" id="fabbit">
										<?php }
										else{ ?>
										<input type="checkbox" value="1" class="form-control" name="fabbit" id="fabbit">
										<?php } ?>
									</div>	
								</div>
								<div class="col">
									<?php echo $fabdate; ?>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<label>Installed:</label>
									</div>	
								</div>
								<div class="col">
									<div class="form-group">
										<?php if ($installedbit == 1){ ?>
										<input type="checkbox" checked value="1" class="form-control" name="installedbit" id="installedbit">
										<?php }
										else{ ?>
										<input type="checkbox" value="1" class="form-control" name="installedbit" id="installedbit">
										<?php } ?>
									</div>	
								</div>
								<div class="col">
									<?php echo $installeddate; ?>
								</div>
							</div>
							<div class="form-group">
								<textarea rows="4" cols="50" name="notes" id="notes"><?php echo $notes;?></textarea>
							</div>
                            <button type="submit" style="background-color:rgb(209, 154, 14); border:none" id="submitbtn" class="btn btn-primary btn-lg">Update</button>
							<button type="button" style="background-color:rgb(209, 154, 14); border:none" class="btn btn-primary btn-lg" onClick="window.location.href='status.php'">Opened</button>
							<button type="button" class="btn btn-danger btn-lg" onClick="window.location.href='<?php echo "deleteproject.php?jobid=$rcvdjobid" ?>'">Delete</button>
                        </form>				
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>