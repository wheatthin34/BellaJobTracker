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

function deleteProject(){
	return confirm("Are you sure you want to delete this project?");
}

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

$statusquery = mysqli_query($connection, "SELECT a.*, b.*, c.*
							from projectstatus a
							left join projectdetails b
							on a.jobid = b.jobid
							left join images c
							on a.jobid = c.jobid
							where a.jobid = '$rcvdjobid'");

while ($result = mysqli_fetch_array($statusquery, MYSQLI_ASSOC)){

	$reworkflag = $result['reworkflag'];
	
	$jobid = $result['jobid'];
	$jobname = $result['jobname'];

	$templatebit = $result['templatebit'];
	$templatedate = $result['templatedate'];

	$workorderbit = $result['workorderbit'];
	$workorderdate = $result['workorderdate'];

	$materialbit = $result['materialbit'];
	$materialdate = $result['materialdate'];

	$sinkbit = $result['sinkbit'];
	$sinkdate = $result['sinkdate'];

	$fabbit = $result['fabbit'];
	$fabdate = $result['fabdate'];

	$installedbit = $result['installedbit'];
	$installeddate = $result['installeddate'];

	$installdate = $result['installdate'];
	$formatdate = date("m-d-Y", strtotime($installdate));

	$billedbit = $result['billedbit'];
	$billeddate = $result['billeddate'];

	$notes = $result['notes'];
}

$imagequery = mysqli_query($connection, "SELECT imageid, imagename, imageflag
										 FROM images
										 WHERE jobid = '$rcvdjobid'");


$pagetitle = "projectcompleteupdate";
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
                        <form enctype="multipart/form-data" id="projectupdateform" action=<?php if ($reworkflag == 1){ echo '"reworkprojectupdated.php""'; } else {echo '"projectupdated.php"';} ?> method="post" class="justify-content-center">
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
							<div class="row" <?php if ($reworkflag == 1){ echo 'style="display:none;"'; } ?>>
								<div class="col">
									<div class="form-group">
										<label>Sink On Hand:</label>
									</div>	
								</div>
								<div class="col"> 
									<div class="form-group">
										<?php if ($sinkbit == 1){ ?>
										<input type="checkbox" checked value="1" class="form-control" name="sinkbit" id="sinkbit">
										<?php }
										else{ ?>
										<input type="checkbox" value="1" class="form-control" name="sinkbit" id="sinkbit">
										<?php } ?>
									</div>	
								</div>
								<div class="col">
									<?php echo $sinkdate; ?>
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
							<div class="row"  <?php if ($reworkflag == 1){ echo 'style="display:none;"'; } ?>>
								<div class="col">
									<div class="form-group">
										<label>Billed:</label>
									</div>	
								</div>
								<div class="col">
									<div class="form-group">
										<?php if ($billedbit == 1){ ?>
										<input type="checkbox" checked value="1" class="form-control" name="billedbit" id="billedbit">
										<?php }
										else{ ?>
										<input type="checkbox" value="1" class="form-control" name="billedbit" id="billedbit">
										<?php } ?>
									</div>	
								</div>
								<div class="col">
									<?php echo $billeddate; ?>
								</div>
							</div>
							<div class="form-group">
								<textarea rows="4" cols="50" name="notes" id="notes"><?php echo $notes;?></textarea>
							</div>
                            <button type="submit" style="background-color:rgb(207, 146, 43); border:none" id="submitbtn" class="btn btn-primary btn-lg">Update</button>
							<button type="button" style="background-color:rgb(207, 146, 43); border:none" class="btn btn-primary btn-lg" onClick="window.location.href='completeproject.php'">Completed</button>
							<button type="button" class="btn btn-secondary btn-lg" onClick="window.location.href='<?php echo "reworkproject.php?jobid=$rcvdjobid" ?>'">Rework</button>
							<a href='<?php echo "deleteproject.php?jobid=$rcvdjobid" ?>' type="button" class="btn btn-danger btn-lg" onClick="return deleteProject()">Delete</a>
							<br>
							<p class="btn btn-lg" style="margin: 0px 0px 0px 0px; cursor: default">Upload Image(s):</p>
									<div class="form-group">
										<input style="padding: 0px" type="file" class="form-control btn btn-lg" name="imageflag" id="imageflag" multiple>
										<?php 
										while ($imageresult = mysqli_fetch_array($imagequery, MYSQLI_ASSOC)){
										$imageid = $imageresult['imageid'];
										$imageflag = $imageresult['imageflag'];
										$imagename = $imageresult['imagename'];
										$imgsrc = 'imagename/' . $imagename;
										if ($imageflag == 1){?>
										<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
										<img src="<?php echo $imgsrc; ?>" class="img-thumbnail" alt="job image">
										<button style="margin: 5px 0px 20px 0px"type="button" id="delbtn" class="btn btn-danger lg" onClick="window.location.href='<?php echo 'deleteImage.php?imageid=' . $imageid . '&jobid=' . $rcvdjobid . '&pagetitle=' . $pagetitle ?> '"> Delete Image </button>
										<?php }
										else{ ?>
										<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
										<input style="padding: 0px" type="file" class="form-control btn btn-lg" name="imageflag" id="imageflag" multiple>
										<?php }} ?>
                        </form>					
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>