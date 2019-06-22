<?php
	error_reporting(0);
	require "init.php";
	
	// for hunts table
	$hunt_id = uniqid();
	$user_id = $_POST["admin"];
	$dateTime = date_create('now')->format('Y-m-d H:i:s');
	$date_created = strtotime($dateTime);
	$hunt_name = $_POST["name"]; 
	
	//$splitter = ",";
	// for waypoints table
	$waypoint_index = 0;
	$latitude = array($_POST["latitude"]);
	$longitude = array($_POST["longitude"]);
	$scan_code = array($_POST["scan_code"]);
	$clue = array($_POST["clue"]);
	
	// for result
	$response = array();
	$response["success"] = false;
	/*$latitude = array("10,11,12");
	$longitude = array("9,12,90");
	$scan_code = array("YOO,YUB,G");
	$clue = array("h,N,NJUUGHGUGGBJ");*/
	
	// populate hunts table
	$huntcreation = "INSERT INTO hunts (`hunt_id`, `hunt_name`, `user_id`, `date_created`) VALUES ('".$hunt_id."','".$hunt_name."','".$user_id."','".$date_created."');";
	
	if ($insert = mysqli_query($con, $huntcreation)) {
		// Success!
	} else {
		//die("Unable to connect to the database.");
	}
	foreach($latitude as $line){
		$record1 = substr($line, 0);
		$val1 = explode(chr(007),$record1);
	}
	foreach($longitude as $line){
		$record2 = substr($line, 0);
		$val2 = explode(chr(007),$record2);
		//echo json_encode($val2);
	}
	foreach($scan_code as $line){
		$record3 = substr($line, 0);
		$val3 = explode(chr(007),$record3);
		//echo json_encode($val3);
	}
	foreach($clue as $line){
		$record4 = substr($line, 0);
		$val4 = explode(chr(007),$record4);
		//echo json_encode($val4);
	}
	//echo "outisde for loop";
	// populate waypoints table
	for ($row = 0; $row < count($val1); $row++){
		//echo "inside for loop";
		$waypoint_index = $waypoint_index + 1;
		$lat = $val1[$row];
		$long = $val2[$row];
		$scan = $val3[$row];
		$cl = $val4[$row];
		$waypoints = "INSERT INTO waypoints (`hunt_id`, `waypoint_index`, `latitude`, `longitude`, `scan_code`, `clue`) VALUES ('".$hunt_id."','".$waypoint_index."','".$lat."','".$long."','".$scan."','".$cl."');";
				if ($insert = mysqli_query($con, $waypoints)) {
					// success
					$response["success"] = true;
					$response["hunt_id"] = $hunt_id;
				} else{
					//die("Unable to connect to the database.");
				}
	}
	echo json_encode($response);
?>