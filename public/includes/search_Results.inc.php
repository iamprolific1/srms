<?php

include '../config/db.php';

function search_Result_Data(){
    global $conn;
    $data = json_decode(file_get_contents('php://input'), true);
    $queryParams = [];
    $conditions = [];

    if(empty($data['matricNumber']) && empty($data['department']) && empty($data['level']) && empty($data['semester']) && empty($data['examinationYear'])){
        echo json_encode(['status'=>'error', 'message'=>'Please fill in one or all fields to search for result!']);
        return;
    }

    if (!empty($data['matricNumber'])) {
        $conditions[] = "student_Matric_Number = :matricNumber";
        $queryParams[':matricNumber'] = $data['matricNumber'];
    }
    if (!empty($data['department'])) {
        $conditions[] = "student_Department = :department";
        $queryParams[':department'] = $data['department'];
    }
    if (!empty($data['level'])) {
        $conditions[] = "student_Level = :level";
        $queryParams[':level'] = $data['level'];
    }
    if (!empty($data['semester'])) {
        $conditions[] = "semester = :semester";
        $queryParams[':semester'] = $data['semester'];
    }
    if (!empty($data['examinationYear'])) {
        $conditions[] = "academic_Session = :examinationYear";
        $queryParams[':examinationYear'] = $data['examinationYear'];
    }

    if (count($conditions) > 0) {
        $query = "SELECT student_Name, student_Matric_Number, student_Department, student_Faculty, student_Level, academic_Session, course_Codes, course_Units, scores, grades, cgp FROM results WHERE " . implode(' AND ', $conditions);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Please provide at least one search criteria.']);
        return;
    }

    try {
        $stmt = $conn->prepare($query);
        foreach ($queryParams as $param => $value) {
            $stmt->bindValue($param, $value);
        }
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
            echo json_encode(['status' => 'error', 'message' => 'No results found for the given search criteria.']);
        } else {
            echo json_encode(['status' => 'success', 'results' => $results]);
        }

    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
    }
}

search_Result_Data();

$conn = null;
?>
