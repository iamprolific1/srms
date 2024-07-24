<?php
session_start();
include '../config/db.php';

$success = '';
$error = '';

function authenticateUser($username, $password){
    global $conn;
    $query = "SELECT * FROM admin WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['last_activity'] = time();

        
        return $user;
    } else {
        return false;
    }
}

function checkUser($username){
    global $conn;
    $query = "SELECT * FROM admin WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? true : false;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if(!empty($username) && !empty($password)){
        $userExists = checkUser($username);
        
        if(!$userExists){
            $error = "This user does not exist.";
            echo json_encode(['status' => 'error', 'message' => $error]);
        } else {
            $user = authenticateUser($username, $password);
            if($user){
                $success = "Login successful.";
                echo json_encode(['status' => 'success', 'message' => $success, $user]);
            
                if(isset($_SESSION['redirect_after_login'])){
                    $redirect_url = $_SESSION['redirect_after_login'];
                    unset($_SESSION['redirect_after_login']);
                    header("location: $redirect_url");
                    exit;
                    echo json_encode(['status' => 'redirect_success', 'message' => $redirect_url]);
                }
            } else {
                $error = "Invalid credentials.";
                echo json_encode(['status' => 'error', 'message' => $error]);
            }
        }
    } else {
        $error = "All fields are required.";
        echo json_encode(['status' => 'error', 'message' => $error]);
    }
}

$conn = null;
?>
