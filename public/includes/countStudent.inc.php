<?php

session_start();
include '../config/db.php';

$success = '';
$error = '';

global $conn;
$query = "SELECT COUNT(*) as totalStudents FROM students";
$stmt = $conn->prepare($query);

$response = new stdClass();
$response->totalStudents = 0;

if($stmt->execute()){
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $response->totalStudents = $result['totalStudents'];
}else{
    $error = "Failed to retrieve total students.";
    $response->error = $error;
}

echo json_encode($response);
$conn = null;