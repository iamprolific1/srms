<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result-Management-System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://kit.fontawesome.com/4918ebcd46.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="./public/css/styles.css">
</head>
<body>
    <main class="wrapper">
        <div class="message w-50 mx-auto mt-1" id="server-response"></div>
        <div class="header text-center text-uppercase mb-3 mt-1 fs-5 fw-medium text-dark">Student result management system - ( <span class="text-danger">Admin</span> )</div>


        <div class="container container-sm formContainer p-4 shadow-sm border border-secondary-subtle rounded">
            <h3 class="text-center mb-2 fw-semibold text-secondary ">Create an account</h3>
            <form action="./public/includes/signup.inc.php" id="form" method="POST" class="d-flex flex-column gap-3">
                <input class="form-control fs-6" type="text" name="username" placeholder="Username" required>
                <input class="form-control fs-6" type="email" name="email" placeholder="Email" required>
                <div class="input-group">
                    <input class="form-control fs-6" id="password" type="password" name="password" placeholder="Password" required>
                    <span class="input-group-text eye-icon"><i class="fa-solid fa-eye" id="eye-icon"></i></span>
                </div>
                <button class="btn btn-primary w-50 mx-auto mt-2" id="submit" type="submit">Create Account</button>
            </form>
            <div class="text-center text-secondary mt-3 not_registered">Already Registered?  <span class="text-link"><a href="/srms/">Login to account.</a></span></div>
        </div>

    </main>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/script.js"></script>
    <script src="./public/js/sign-up.js"></script>

</body>
</html>