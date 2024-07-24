<?php

session_start();
if(!isset($_SESSION['user_id'])){
    header('location: /srms/');
    exit;
}else{
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    $_SESSION['last_page'] = $_SERVER['REQUEST_URI'];
    // $last_page = isset($_SESSION['last_page'])? $_SESSION['last_page'] : '/srms/';
    if(isset($_SESSION['last_activity'])){
        $time_difference = time() - $_SESSION['last_activity'];
        if($time_difference > 600){
            session_unset();
            session_destroy();

            session_start();
            $_SESSION['inactiveError'] = "Your session has expired due to 10 minutes of inactivity. Please log in again.";
            $_SESSION['redirect_after_login'] = $_SESSION['last_page'];
            header('location: /srms/');
            exit;
        }else{
            $_SESSION['last_activity'] = time();
        }
    }
    $last_activity = $_SESSION['last_activity'];
}
