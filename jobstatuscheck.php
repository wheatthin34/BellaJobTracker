<head>
</head>

<body>
</body>

<?php
require('connect.php');

$statusquery = mysqli_query($connection, "SELECT a.*, b.*
							from projectstatus a
							left join projectdetails b
							on a.jobid = b.jobid
							where jobflag = 1 and billedbit = 0
							order by b.installdate");

$emailbody = "";
$nodatebody = "";

while ($result = mysqli_fetch_array($statusquery, MYSQLI_ASSOC)){
	
	$jobid = $result['jobid'];
	$jobname = $result['jobname'];
	$installdate = $result['installdate'];
	$templatebit = $result['templatebit'];
	$workorderbit = $result['workorderbit'];
	$materialbit = $result['materialbit'];
	$sinkbit = $result['sinkbit'];
	$fabbit = $result['fabbit'];
	$installedbit = $result['installedbit'];
	$billedbit = $result['billedbit'];
	$jobflag = $result['jobflag'];
	$reworkflag = $result['reworkflag'];

	date_default_timezone_set("America/New_York");
	$curdate = date("Y-m-d");
	$tarinstall = date("Y-m-d", strtotime($installdate));
	$days = strtotime($curdate) - strtotime($tarinstall);

	$days = round($days/86400, 0);

	if($installdate == NULL){
		$nodatebody .= $jobname . " \n";
	}

	else {
		if($days > -9){
			if($days >= -7 and $templatebit == 0){
				$emailbody .= $days . " days - " . $jobname . ": Template Late \n";
				continue;
			}
			if($days >= -5 and $workorderbit == 0){
				$emailbody .= $days . " days - " . $jobname . ": Work Order Late \n";
				continue;
			}
			if($days >= -5 and $materialbit == 0){
				$emailbody .= $days . " days - " . $jobname . ": Material Late \n";
				continue;
			}
			if($days >= -5 and $sinkbit == 0 and $reworkflag != 1){
				$emailbody .= $days . " days - " . $jobname . ": Sink Late \n";
				continue;
			}
			if($days >= -2 and $fabbit == 0){
				$emailbody .= $days . " days - " . $jobname . ": Fabrication Late \n";
				continue;
			}
			if($days >= 1 and $installedbit == 0){
				$emailbody .= $days . " days - " . $jobname . ": Installation Late \n";
				continue;
			}
			if($days >= 7 and $billedbit == 0 and $reworkflag != 1){
				$emailbody .= $days . " days - " . $jobname . ": Billing Late \n";
			}
		}
	}	

}

echo $emailbody;
echo "<br>";
echo $nodatebody;

	mysqli_close($connection);

if((strlen($emailbody) >= 1)){
//*********************************************EMAIL ALERT CONFIG HERE***********************************
	require_once "Mail.php";

	$from = "bellaupdates@bellastonedesigns.com";
	$to = 'mwheatley@venosaprecast.com, emernst@venosaprecast.com, bellaprojectupdates@bellastonedesigns.com';
	//$to = 'mwheatley@venosaprecast.com';

	$host = "smtp.office365.com";
	$port = "587";
	$username = 'bellaupdates@bellastonedesigns.com';
	$password = 'Bella2021!';

	$subject = "Late Projects";
	$body = "Outstanding projects:\n\n" . $emailbody . "\n\n Projects without install dates: \n\n" . $nodatebody . "\nPlease go here to view open orders: http://team.bellastonedesigns.com/status.php";

	$headers = array ('From' => $from, 'To' => $to,'Subject' => $subject);
	$smtp = Mail::factory('smtp',
	  array ('host' => $host,
		'port' => $port,
		'auth' => true,
		'username' => $username,
		'password' => $password));

	$mail = $smtp->send($to, $headers, $body);

	if (PEAR::isError($mail)) {
	  echo($mail->getMessage());
	} else {
	  //echo("Message successfully sent!\n");
	}
//*********************************************END OF EMAIL ALERT CONFIG HERE*********************************** 
}
?>