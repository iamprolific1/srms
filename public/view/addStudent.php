<?php 
    require_once './public/includes/sessionManagement.inc.php';
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
    <link rel="stylesheet" href="./public/css/addStudents.css">
    <link rel="stylesheet" href="./public/css/mobile.css">
</head>
<body>
    <div class="main__container">
        <div class="mobile-Sidebar-Container">
            <div class="sidebar-mobile">
                <div class="logo">
                    <h3>Admin Panel</h3>
                </div>

                <div class="menuContainer">
                    <ul>
                        <li><a href="/srms/dashboard">Dashboard</a></li>
                        <li class="active"><a href="/srms/add_student" >Student Management</a></li>
                        <li><a href="/srms/add_results">Result Management</a></li>
                        <li><a href="#settings">Settings</a></li>
                    </ul>
                </div>
            </div>
            <div class="sidebar-overlay">
                <div class="close-sidebar">
                    <i class="fa-solid fa-times" id="closeMenu"></i>
                </div>
    
            </div>
        </div>
        <aside class="sidebar">
            <div class="logo">
                <h2>Admin Panel</h2>
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="/srms/dashboard">Dashboard</a></li>
                    <li><a href="/srms/add_student" class="active">Student Management</a></li>
                    <li><a href="#viewStudents">View Students</a></li>
                    <li><a href="/srms/add_results">Result Management</a></li>
                    <li><a href="/srms/view_results">Search Results</a></li>
                    <li><a href="#settings">Settings</a></li>
                </ul>
            </nav>

            <div class="footer">
                &copy; 2024 Student Result Management System. All rights reserved.
            </div>
        </aside>
        <main class="main-content">
            <header class="header shadow-sm">
                <h1>Welcome, <?php  echo $username?></h1>
                <div class="logout">
                    <a href="/srms/logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </div>
                <div class="menu_bar" id="menuBtn"><i class="fa-solid fa-bars"></i></div>
            </header>

            <div class="message w-100 mt-1" id="server-response"></div>

            <section id="student-management" class="content-section">
                <h2>Add New Student</h2>
                <p>Use the form below to add a new student to the system.</p>

                <div class="formContainer">
                    <form id="form" action="./public/includes/add_New_Student.inc.php" method="post">
                        <div class="form-group">
                            <label for="studentName">Student Name</label>
                            <input type="text" class="form-control" name="fullname" id="studentName" placeholder="Enter student's full name">
                        </div>
                        <div class="form-group">
                            <label for="studentMatric">Matric Number</label>
                            <input type="text" name="matricNumber" class="form-control" id="studentMatric" placeholder="Enter student matric number">
                        </div>
                        <div class="form-group">
                            <label for="studentDepartment">Student Department</label>
                            <select name="department" class="form-control" id="studentDepartment">
                                <option value="">Select Department</option>
                                <option value="Electrical Engineering">Electrical Engineering</option>
                                <option value="Computer Engineering">Computer Engineering</option>
                                <option value="International Relations & Diplomacy">International Relations & Diplomacy</option>
                                <option value="Public Administration">Public Administration</option>
                                <option value="Criminology, Intelligence & Security Studies">Criminology, Intelligence & Security Studies</option>
                                <option value="Political Science">Political Science</option>
                                <option value="Economics">Economics</option>
                                <option value="Mass Communication">Mass Communication</option>
                                <option value="French Language & Communication">
                                    French Language & Communication
                                </option>
                                <option value="Law">Law</option>
                                <option value="Accounting">Accounting</option>
                                <option value="Business Administration & Management">
                                    Business Administration & Management
                                </option>
                                <option value="Marketing">Marketing</option>
                                <option value="Project Management">Project Management</option>
                                <option value="Transport & Logistics Management">
                                    Transport & Logistics Management
                                </option>
                                <option value="Tourism & Hospitality Management">
                                    Tourism & Hospitality Management
                                </option>
                                <option value="Human Resource Management">
                                    Human Resource Management
                                </option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Management & Information Technology">
                                    Management & Information Technology
                                </option>
                                <option value="Estate Management">Estate Management</option>
                                <option value="Microbiology">Microbiology</option>
                                <option value="Biochemistry">Biochemistry</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="studentFaculty">Student Faculty</label>
                            <select name="faculty" id="studentFaculty" class="form-control">
                                <option value="">Select Faculty</option>
                                <option value="Engineering">Engineering</option>
                                <option value="Social Science">Social Science</option>
                                <option value="Education, Arts & Humanities.">
                                    Education, Arts & Humanities.
                                </option>
                                <option value="Management Science">Management Science</option>
                                <option value="Pure & Applied Science">
                                    Pure & Applied Science
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="studentLevel">Level Of Study</label>
                            <select name="level" id="studentLevel" class="form-control">
                                <option value="">Select Level</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="300">300</option>
                                <option value="400">400</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="academicSession">Academic Session</label>
                            <input type="text" name="academicSession" class="form-control" id="academicSession" placeholder="Enter the academic session e.g. 2021/22">
                        </div>
                        <button class="mt-3 w-25 btn btn-primary" id="submit" type="submit">Submit</button>
                    </form>
                </div>
            </section>
            <footer class="mobile__footer">
                &copy; 2024 Student Result Management System. All rights reserved.
            </footer>
        </main>

    </div>

    <script src="./public/js/add-Students.js"></script>
</body>
</html>