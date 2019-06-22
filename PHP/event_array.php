<?php
    // GET ALL THE EVENTS ASSOCIATED WITH A SPECIFIC USER
    error_reporting(0);
    require "init.php";
    
    $user_id = $_POST["user_id"];
    
    $response = array();
    $stmt = $con->prepare("SELECT event_id, event_name, hunt_id, description FROM events WHERE user_id = ?;");
    $stmt->bind_param('s', $user_id);
    $stmt->execute();
    $stmt->bind_result($event_id, $event_name, $hunt_id, $description);
    while($stmt->fetch()){
        $bindResults = array("event_id" => $event_id, "event_name" => $event_name, "hunt_id" => $hunt_id, "description" => $description);
        array_push($response, $bindResults);
    }
    $stmt->close();
    echo json_encode($response);
    
?>