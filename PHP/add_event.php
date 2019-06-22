<?php 
	error_reporting(E_ALL);
	require("password.php");
	require("init.php");
	
	$user_id = $_POST["user_id"];
	$name = $_POST["name"];
	$hunt_id = $_POST["hunt_id"];
	$start_date = $_POST["start_date"];
	$description = $_POST["description"];
	$prize = $_POST["prize"];
	$password = $_POST["password"];
	
	$get_location = mysqli_prepare($con, "SELECT latitude, longitude FROM waypoints WHERE hunt_id = ? AND waypoint_index = 1;");
	mysqli_stmt_bind_param($get_location, "s", $hunt_id);
	mysqli_stmt_execute($get_location);
	mysqli_stmt_bind_result($get_location, $col_start_lat, $col_start_lng);
	
	$event_id = uniqid();
	$passwordHash = null;
	if($password){
		$passwordHash = password_hash($password, PASSWORD_DEFAULT);
	}
	if(mysqli_stmt_fetch($get_location)){
		$start_lat = floatval($col_start_lat);
		$start_lng = floatval($col_start_lng);
	}
	mysqli_stmt_close($get_location);
	$statement = mysqli_prepare($con, "INSERT INTO events 
		(event_id, event_name, hunt_id, start_date, user_id, description, password, prize, start_lat, start_lng) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
	mysqli_stmt_bind_param
		($statement, "ssssssssdd", $event_id, $name, $hunt_id, $start_date, $user_id, $description, $passwordHash, $prize, $start_lat, $start_lng);
	mysqli_stmt_execute($statement);
	mysqli_stmt_close($statement); 
	
	$response["event_id"] = $event_id;
	echo json_encode($response);
	
?>