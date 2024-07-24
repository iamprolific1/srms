<?php

route('/srms/', function(){
    require_once './public/view/login.php';
});

route('/srms/register', function(){
    require_once './public/view/signup.php';
});

// route('/srms/verify', function(){
//     require_once './public/view/verification.php';
// });

route('/srms/dashboard', function(){
    require_once './public/view/dashboard.php';
});

route('/srms/logout', function(){
    require_once './public/includes/logout.inc.php';
});

route('/srms/add_student', function(){
    require_once './public/view/addStudent.php';
});

route('/srms/add_results', function(){
    require_once './public/view/addResults.php';
});