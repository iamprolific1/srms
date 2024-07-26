<?php

session_start();
include '../config/db.php';

$success = '';
$error = '';

global $conn;
$query = "SELECT COUNT(*) as totalResults FROM results";
$stmt = $conn->prepare($query);

$response = new stdClass();
$response->totalResults = 0;

if($stmt->execute()){
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $response->totalResults = $result['totalResults'];
}else{
    $error = "Failed to retrieve total results.";
    $response->error = $error;
}

echo json_encode($response);
$conn = null;