<?php
    error_reporting(E_ALL);
    require("password.php");
    require("init.php");
    
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $statement = mysqli_prepare($con, "SELECT user_id, password FROM users WHERE email = ?");
    mysqli_stmt_bind_param($statement, "s", $email);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $col_id, $col_password);
    
    $response = array();
    $response["success"] = false;
    
    while(mysqli_stmt_fetch($statement)){
        if (password_verify($password, $col_password)) {
            $response["success"] = true;  
            $response["user_id"] = $col_id;
        }
    }

    echo json_encode($response);
?>