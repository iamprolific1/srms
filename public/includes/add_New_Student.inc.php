<?php

include '../config/db.php';

function addNewStudent($studentName, $studentMatric, $department, $faculty, $level, $academicSession){
    global $conn;
    $currentDate = date('Y-m-d H:i:s');
    try {
        $query = "INSERT INTO students(fullname, matricNumber, department, faculty, level, academicSession, created_at) VALUES(:fullname, :matricNumber, :department, :faculty, :level, :academicSession, :created_at)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':fullname', $studentName);
        $stmt->bindParam(':matricNumber', $studentMatric);
        $stmt->bindParam(':department', $department);
        $stmt->bindParam(':faculty', $faculty);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':academicSession', $academicSession);
        $stmt->bindParam(':created_at', $currentDate);
        if($stmt->execute()){
            return "Student added successfully.";
        }else{
            return "Failed to add student.";
        }

    } catch (PDOException $e) {
        if($e->getCode() == 23000){
            return "Student with this matric number is already registered.";
        }else{
            return "An error occurred: ". $e->getMessage();
        }
        
    }
}

function checkAlreadyRegistered(){
    global $conn;
    $query = "SELECT * FROM students WHERE matricNumber = :matricNumber";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':matricNumber', $studentMatric);
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    if($student){
        return true;
    } else{
        return false;
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $studentName = $_POST['fullname']?? '';
    $studentMatric = $_POST['matricNumber']?? '';
    $department = $_POST['department']?? '';
    $faculty = $_POST['faculty']?? '';
    $level = $_POST['level']?? '';
    $academicSession = $_POST['academicSession']?? '';

    if(!empty($studentName) && !empty($studentMatric) && !empty($department) && !empty($faculty) && !empty($level) && !empty($academicSession)){
        if(checkAlreadyRegistered()){
            echo json_encode(['status' => 'error','message' => 'Student with this matric number is already registered.']);
            exit();
        }else{
            $feedback = addNewStudent($studentName, $studentMatric, $department, $faculty, $level, $academicSession);
            if($feedback === 'Student added successfully.'){
        
                echo json_encode(['status' => 'success', 'message' => $feedback]);
            }else{
                echo json_encode(['status' => 'error', 'message' => $feedback]);
            }
        }
    }else{
        echo json_encode(['status' => 'error', 'message' => 'All fields are required!']);
    }
}

$conn = null;