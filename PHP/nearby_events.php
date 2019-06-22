<?php 
	error_reporting(0);
	require "init.php";
	
	$user_lat = $_POST["user_lat"];
	$user_lng = $_POST["user_lng"];
	$search_distance = $_POST["search_distance"];
	
	$coordinate_distance = $search_distance * 0.009009009009009009009;
	
	$statement = mysqli_prepare($con, "SELECT event_id, event_name, start_date FROM events WHERE (start_lat >= ? - ? AND start_lat <= ? + ?) 
		AND (start_lng >= ? - ? AND start_lng <= ? + ?);");
	mysqli_stmt_bind_param($statement, "dddddddd", $user_lat, $coordinate_distance, $user_lat, $coordinate_distance, 
			$user_lng, $coordinate_distance, $user_lng, $coordinate_distance);
	mysqli_stmt_execute($statement);
	mysqli_stmt_bind_result($statement, $col_id, $col_name, $col_date);
	
	$response = array();
	while(mysqli_stmt_fetch($statement)){
		$bindResults = array("event_id" => $col_id,"event_name" => $col_name, "start_date" => $col_date);
		array_push($response, $bindResults);
	}
	
	echo json_encode($response);
	
?>