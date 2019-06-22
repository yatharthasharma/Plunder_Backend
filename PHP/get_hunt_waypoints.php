<?php
	// GET WAYPOINTS OF A SPECIFIC HUNT.
	error_reporting(0);
	require "init.php";

	$hunt_id = $_POST["id"];
	
	$response = array();
	
	$stmt = $con->prepare("SELECT * FROM waypoints WHERE hunt_id = ?;");
	$stmt->bind_param('s', $hunt_id);
	$stmt->execute();
	$stmt->bind_result($hunt_id, $waypoint_index, $latitude, $longitude, $scan_code, $clue);
	
	while($stmt->fetch()){
		$bindResults = array($hunt_id, $waypoint_index, $latitude, $longitude, $scan_code, $clue);
		array_push($response, $bindResults);
	}
	
	$stmt->close();
	
	echo json_encode($response);
	
?>