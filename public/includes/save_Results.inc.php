<?php

include '../config/db.php';

function save_Result_Data(){
    global $conn;
    $data = json_decode(file_get_contents('php://input', true));
    $name = $data->name;
    $matricNumber = $data->matricNumber;
    $department = $data->department;
    $faculty = $data->faculty;
    $level = $data->level;
    $semester = $data->semester;
    $academicSession = $data->academicSession;
    $courseCodes = json_encode($data->courseCodes); // Serialize arrays to JSON strings
    $courseUnits = json_encode($data->courseUnits);
    $scores = json_encode($data->scores);
    $grades = json_encode($data->grades);
    $cgp = $data->cgp;
    $currentDate = date('Y-m-d H:i:s');

    try {
        // Build SELECT query to check for existing data
        $checkQuery = "SELECT * FROM results WHERE student_Name = :name AND student_Matric_Number = :matricNumber AND student_Department = :department AND student_Faculty = :faculty AND student_Level = :level AND semester = :semester AND academic_Session = :examSession AND course_Codes = :courseCode AND course_Units = :courseUnit AND scores = :score AND grades = :grade AND cgp = :cgp";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bindParam(':name', $name);
        $checkStmt->bindParam(':matricNumber', $matricNumber);
        $checkStmt->bindParam(':department', $department);
        $checkStmt->bindParam(':faculty', $faculty);
        $checkStmt->bindParam(':level', $level);
        $checkStmt->bindParam(':semester', $semester);
        $checkStmt->bindParam(':examSession', $academicSession);
        $checkStmt->bindParam(':courseCode', $courseCodes);
        $checkStmt->bindParam(':courseUnit', $courseUnits);
        $checkStmt->bindParam(':score', $scores);
        $checkStmt->bindParam(':grade', $grades);
        $checkStmt->bindParam(':cgp', $cgp);
        $checkStmt->execute();

        // Check if any rows were returned
        if ($checkStmt->rowCount() > 0) {
            echo json_encode(['status' => 'error', 'message' => 'Duplicate Result Entry.']);
            return false;
        }

        // Insert new data
        $query = "INSERT INTO results(student_Name, student_Matric_Number, student_Department, student_Faculty, student_Level, semester, academic_Session, course_Codes, course_Units, scores, grades, cgp, created_at) VALUES(:name, :matricNumber, :department, :faculty, :level, :semester, :examSession, :courseCode, :courseUnit, :score, :grade, :cgp, :currentDate)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':matricNumber', $matricNumber);
        $stmt->bindParam(':department', $department);
        $stmt->bindParam(':faculty', $faculty);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':semester', $semester);
        $stmt->bindParam(':examSession', $academicSession);
        $stmt->bindParam(':courseCode', $courseCodes);
        $stmt->bindParam(':courseUnit', $courseUnits);
        $stmt->bindParam(':score', $scores);
        $stmt->bindParam(':grade', $grades);
        $stmt->bindParam(':cgp', $cgp);
        $stmt->bindParam(':currentDate', $currentDate);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Result Saved Successfully']);
            return true;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error Saving Result Data']);
            return false;
        }

    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo json_encode(['status' => 'error', 'message' => 'Duplicate Result Entry']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
        return false;
    }
}

save_Result_Data();

$conn = null;
