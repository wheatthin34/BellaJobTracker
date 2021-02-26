<head>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="apple-touch-icon" sizes="180x180" href="apple-icon.png">

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<div align="center" class="logo-image" id="spacetaker">
<a href="http://team.BellaStoneDesigns.com">
<img src="bella_logo.png" style="max-width:100%; height:auto !important;">
</a>
</div>

<title>Project Status</title>
<!--<link rel="stylesheet" type="text/css" href="style.css" />-->
<script type="text/javascript">

$(document).ready(function () {
  $('#projectstatustbl').DataTable({
	"order": []
  });
});

</script>

</head>
<body>
<h1 align="center">Open Projects</h1>

<div class="container">  
	<table id="projectstatustbl" class="table table-bordered">
		<thead>
			<tr>
				<th>Project</th>
				<th>Install Date</th>
				<th>Progress</th>
			</tr>
		</thead>
		<tbody>

			<?php
			require('connect.php');

			$statusquery = mysqli_query($connection, "SELECT a.jobid, b.jobname, a.templatebit, a.workorderbit, a.materialbit, a.sinkbit, a.fabbit, a.installedbit, a.billedbit, b.installdate, b.reworkflag, b.jobflag,
														SUM(a.billedbit + a.templatebit + a.workorderbit + a.materialbit + a.sinkbit + a.fabbit + a.installedbit) AS Total
														from projectstatus a
														left join projectdetails b
														on a.jobid = b.jobid
														where  b.jobflag = 1
														GROUP BY a.jobid
														HAVING Total < 7");

			while ($result = mysqli_fetch_array($statusquery, MYSQLI_ASSOC)){
				
				$sumstatus = 0;
				$statuspercent = 0;

				$installdate = $result['installdate'];
				$formatdate = date("m-d-Y", strtotime($installdate));

				$jobid = $result['jobid'];
				$jobname = $result['jobname'];
				$templatebit = $result['templatebit'];
				$workorderbit = $result['workorderbit'];
				$materialbit = $result['materialbit'];
				$sinkbit = $result['sinkbit'];
				$fabbit = $result['fabbit'];
				$installedbit = $result['installedbit'];
				$billedbit = $result['billedbit'];
				$reworkflag = $result['reworkflag'];
				$jobflag = $result['jobflag'];


				if($reworkflag == 1 and $jobflag == 1){
					$var = 'reworkupdate.php?jobid=';
					$sumstatus = $templatebit + $workorderbit + $materialbit + $fabbit + $installedbit;
					if ($sumstatus > 0) {
						$statuspercent = round(($sumstatus/5)*100);
					}
					else {
						$statuspercent = 0;
					}
				}
				else{
					$var = 'projectupdate.php?jobid=';
					$sumstatus = $templatebit + $workorderbit + $materialbit + $sinkbit + $fabbit + $installedbit + $billedbit;
					if ($sumstatus > 0) {
						$statuspercent = round(($sumstatus/7)*100);
					}
					else {
						$statuspercent = 0;
					}
				}

				echo '<tr>';	
				echo '<td>';	
				?>
				<h3 align="center"><a href = "<?php echo $var . $jobid ?>"><?php echo $jobname ?></a></h3>
				<?php
				echo '</td>';
				echo '<td>';
				?>
				<h5 align="center" style="margin: 8px 0px 0px 0px"><?php echo $formatdate?></h5>
				<?php
				echo '</td>';
				echo '<td>';
				?>
				<div class="progress" style="height: 30px">
					<div class="progress-bar" role="progressbar" style="width: <?php echo $statuspercent ?>%;" aria-valuenow="<?php echo $statuspercent ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $statuspercent ?>%</div>
				</div>

				<?php
				echo '</td>';
				echo '</tr>';
				
			} 

				?>
		</tbody>
	</table>
</div>

<div align="center">
<button type="button" style="background-color:rgb(207, 146, 43); border:none" class="btn btn-primary btn-lg" onClick="window.location.href='index.html'">Home</button>
</div>


<?php	

//echo date("Y-m-d H:i:sa");

?>
			
</body>