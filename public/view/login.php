<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result-Management-System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/4918ebcd46.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./public/css/styles.css">
    <link rel="stylesheet" href="./public/css/mobile.css">
</head>
<body>
    <main class="wrapper">
        <?php
        
            if(isset($_SESSION['inactiveError'])){
                echo '<div class="alert text-center alert-danger alert-dismissible fade show inactive-error-alert" role="alert">'
            . $_SESSION['inactiveError'] .'</div>';
                unset($_SESSION['inactiveError']);
            }

        ?>
        <div class="message w-50 mx-auto mt-1" id="server-response"></div>
        <div class="header text-center text-uppercase mb-3 mt-1 fw-medium text-dark">Student result management system - ( <span class="text-danger">Admin</span> )</div>
        <div class="container container-sm formContainer p-4 shadow-sm border border-secondary-subtle rounded">
            <h3 class="text-center mb-2 fw-semibold text-secondary ">Login</h3>
            <form action="./public/includes/login.inc.php" id="form" method="POST" class="d-flex flex-column gap-3">
                <input class="form-control fs-6" type="text" name="username" placeholder="Username" required>
                <div class="input-group">
                    <input class="form-control fs-6" id="password" type="password" name="password" placeholder="Password" required>
                    <span class="input-group-text eye-icon"><i class="fa-solid fa-eye" id="eye-icon"></i></span>
                </div>
                <button class="btn btn-primary w-50 mx-auto mt-2" id="submit" type="submit">Login</button>
            </form>
            <div class="text-center text-secondary mt-3 not_registered">Not Registered?  <span class="text-link"><a href="/srms/register">Create an account.</a></span></div>
            <div class="text-center text-secondary mt-3 not_registered fs-6"><span class="text-link"><a href="#">Reset Password.</a></span></div>
        </div>
    </main>

    <script>
        const errorAlert = document.querySelector('.inactive-error-alert');
        setTimeout(() => {
            errorAlert.style.display = 'none';
        }, 7000);
    </script>
    <script src="./public/js/script.js"></script>
    <script src="./public/js/log-in.js"></script>
</body>
</html>