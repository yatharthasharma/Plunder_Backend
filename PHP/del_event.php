<?php
    // DELETE AN EVENT.
    error_reporting(0);
    require "init.php";

    $event_id = $_POST["id"];
    
    $statement = "DELETE FROM events WHERE event_id = '$event_id'";
    
    if ($insert = mysqli_query($con, $statement)) {
        echo "You've deleted the event, matey!";
    } else {
        echo 'MySQL Error: ' . mysql_error($con);
    }
    
?>