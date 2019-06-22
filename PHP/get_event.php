<?php
	// GET THE SPECIFIC EVENT'S DETAILS.
	error_reporting(0);
	require "init.php";
	
	$event_id = $_POST["id"];

	$stmt = $con->prepare("SELECT * FROM events WHERE event_id = ?;");
	$stmt->bind_param('s', $event_id);
	$stmt->execute();
	$stmt->bind_result($event_id, $event_name, $hunt_id, $start_date, $user_id, $description, $password, $prize);
	
	while($stmt->fetch()){
		$bindResults = array($event_id, $event_name, $hunt_id, $start_date, $user_id, $description, $password, $prize);
	}
	
	$stmt->close();
	
	echo json_encode($bindResults);
?>