<?php
    error_reporting(E_ALL);
    require("password.php");
    require("init.php");
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $birthDate = $_POST["birthDate"];
    $password = $_POST["password"];
    
    function registerUser() {
        global $con, $name, $birthDate, $email, $password;
        $id = uniqid();
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $statement = mysqli_prepare($con, "INSERT INTO users (user_id, email, password, full_name, birth_date) 
            VALUES (?, ?, ?, ?, ?);");
        mysqli_stmt_bind_param($statement, "sssss", $id, $email, $passwordHash, $name, $birthDate);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
    }

    function emailAvailable() {
        global $con, $email;
        $statement = mysqli_prepare($con, "SELECT * FROM users WHERE email = ?;"); 
        mysqli_stmt_bind_param($statement, "s", $email);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $count = mysqli_stmt_num_rows($statement);
        mysqli_stmt_close($statement); 
        if ($count < 1){
            return true; 
        }else {
            return false; 
        }
    }
    
    $response = array();
    $response["success"] = false;
    if (emailAvailable()){
        $response["success"] = true;
        registerUser();
    }
    
   echo json_encode($response);
?>