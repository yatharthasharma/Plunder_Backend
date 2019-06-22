<?php
	// DELETE AN EVENT.
	error_reporting(0);
	require "init.php";

	$hunt_id = $_POST["id"];
	
	$del_waypoints = "DELETE FROM waypoints WHERE hunt_id = '$hunt_id'";
	
	if ($insert = mysqli_query($con, $del_waypoints)) {
		// success
	} else {
		die("Your request could not be processed, please try again.");
	}
	
	$del_hunt = "DELETE FROM hunts WHERE hunt_id = '$hunt_id'";
	
	if ($insert = mysqli_query($con, $del_hunt)) {
		echo "Deletion successful.";
	} else {
		die("Your request could not be processed, please try again.");
	}
	
	
	
?>