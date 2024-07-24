<?php

$db_name = "mysql:host=localhost;dbname=srms";
$username = "root";
$password = "";

try{
    $conn = new PDO($db_name, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connection Successful";

}catch(PDOException $e){
    echo "Connection failed" . $e->getMessage();
}

