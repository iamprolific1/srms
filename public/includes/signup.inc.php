<?php 

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

include '../config/db.php';
require_once '../../vendor/autoload.php';
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

$success = '';
$error = '';

function createUser($username, $email, $verificationCode, $password){
    global $conn;
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $query = "INSERT INTO admin(username, email, verificationCode, password) VALUES(:username, :email, :verificationCode, :password)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':verificationCode', $verificationCode);
    $stmt->bindParam(':password', $hashedPassword);

    try {
        if($stmt->execute()){
            // sendVerificationCode($verific ationCode, $email);
            return "Registration Successful.";
        } else {
            return "Registration Failed";
        }
    } catch (PDOException $e) {
        if($e->getCode() == 23000){
            return "This user is already registered";
        } else {
            return "An error occurred: ". $e->getMessage();
        }
    }
}

function checkUserExist($username, $email){
    global $conn;
    $query = "SELECT * FROM admin WHERE username = :username OR email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result){
        return true;
    }else{
        return false;
    }
}

// function sendVerificationCode($verificationCode, $email){
//     $transport = Transport::fromDsn("smtp://abdulmalikabdulrahman76@gmail.com:ccewjsjziawwraie@smtp.gmail.com:587");
//     $mailer = new Mailer($transport);

//     $message = "Your verification code is: " . $verificationCode . "\n\n";
//     $message .= "This code will expire in 5 minutes. Please enter the code promptly to complete your verification.\n";
//     $message .= "If you did not request this code, please ignore this message.";

//     $emailObj = (new Email())
//         ->from('abdulmalikabdulrahman76@gmail.com')
//         ->to($email)
//         ->subject('Verification Code')
//         ->text($message);

//     try {
//         $mailer->send($emailObj);
//         error_log("Verification email sent to " . $email);
//     } catch (TransportExceptionInterface $e) {
//         global $conn;
//         $query = "DELETE FROM admin WHERE email = :email";
//         $stmt = $conn->prepare($query);
//         $stmt->bindParam(':email', $email);
//         $stmt->execute();
//         error_log("An error occurred while sending email: " . $e->getMessage());
//     }
// }

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $verificationCode = mt_rand(100000, 999999);

    if(!empty($username) && !empty($email) && !empty($password)){
        $userExists = checkUserExist($username, $email);

        if($userExists){
            $error = "This user is already registered";
            echo json_encode(['status' => 'error', 'message' => $error]);
        } else {
            $feedback = createUser($username, $email, $verificationCode, $password);
            if($feedback === "Registration Successful."){
                $success = $feedback;
                echo json_encode(['status' => 'success', 'message' => $success]);
            } else {
                $error = $feedback;
                echo json_encode(['status' => 'error', 'message' => $error]);
            }
        }
    } else {
        $error = "All fields are required!!";
        echo json_encode(['status' => 'error', 'message' => $error]);
    }
}

$conn = null;

?>
