<?php
	error_reporting(0);

	$db_name = {DB_NAME};
    $mysql_user = {DB_USERNAME};
    $mysql_pass = {DB_PASS};
	$server_name = "homepages.cs.ncl.ac.uk";
	
	$con = mysqli_connect($server_name, $mysql_user, $mysql_pass, $db_name);

	if (!$con) {
		echo "Failed to connect: " . mysqli_connect_error();
	} else {
		//echo "Connection Successful";
	}
?>
