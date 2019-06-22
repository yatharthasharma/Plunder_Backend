<?php
    // GET HUNTS ASSOCIATED WITH A SPECIFIC USER.
    error_reporting(0);
    require "init.php";
    
    $user_id = $_POST["user_id"];
    
    $response = array();
    
    $stmt = $con->prepare("SELECT hunt_id, hunt_name, date_created FROM hunts WHERE user_id = ?;");
    $stmt->bind_param('s', $user_id);
    $stmt->execute();
    $stmt->bind_result($col_id, $col_name, $col_date);
    while($stmt->fetch()){
        $bindResults = array("hunt_id" => $col_id,"hunt_name" => $col_name, "date_created" => $col_date);
        array_push($response, $bindResults);
    }
    $stmt->close();
    echo json_encode($response);
    
?>