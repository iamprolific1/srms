<?php

include '../config/db.php';



function search_Student_by_matric(){
    $data = json_decode(file_get_contents('php://input', true));
    $matricNumber = $data->matricNumber;
    global $conn;
    $query = "SELECT * FROM students WHERE matricNumber = :matricNumber";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':matricNumber', $matricNumber);
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    if($student){
        echo json_encode(['status'=>'success', 'message'=>'Matric Number '. $matricNumber .' found, results would be populated in the fields below.', 'data'=>$student]);
    }else{
        echo json_encode(['status'=>'error', 'message'=>'Student with matric number not found in the database.']);
    }
}


search_Student_by_matric();
$conn = null;