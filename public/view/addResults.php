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
    <link rel="stylesheet" href="./public/css/add__Results.css">
    <link rel="stylesheet" href="./public/css/mobile.css">
</head>
<body>
    <section class="preview_result" id="preview_Result_Container">
        <div class="preview_form w-75 shadow-sm">
            <div class="preview_Result_Alert" id="preview_Result_Alert"></div>
            <!-- <div class="close_btn" id="close_btn"><i class="fa-solid fa-times"></i></div> -->
            <div class="header text-center">Please confirm the student's result before saving.</div>
            <div class="sub-header text-center">Kindly go back to correct the data if there are some mistakes.</div>
            <div class="cgp d-flex justify-content-end align-items-center gap-2">
                <div class="input-group w-25">
                    <span class="input-group-text" id="basic-addon1">CGP</span>
                    <input type="text" disabled="true" id="cgpInput" class="form-control fs-5" placeholder="0.0" aria-label="cgp" aria-describedby="basic-addon1">
                </div>
                <button class="btn btn-primary" id="calculateCGP">Calculate CGP</button>
            </div>

            <form action="#" class="w-100 p-2">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-secondary text-white" id="basic-addon1">Fullname</span>
                    <input type="text" class="form-control" disabled="true" placeholder="fullname" id="fullnamePreview" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-secondary text-white" id="basic-addon1">Matric Number</span>
                    <input type="text" class="form-control" disabled="true" placeholder="matricNumber" id="matricNumberPreview" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-secondary text-white" id="basic-addon1">Department</span>
                    <input type="text" class="form-control" disabled="true" placeholder="department" id="departmentPreview" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-secondary text-white" id="basic-addon1">Faculty</span>
                    <input type="text" class="form-control" disabled="true" placeholder="faculty" id="facultyPreview" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-secondary text-white" id="basic-addon1">Level</span>
                    <input type="text" class="form-control" disabled="true" placeholder="level" id="levelPreview" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-secondary text-white" id="basic-addon1">EXAMINATION YEAR</span>
                    <input type="text" class="form-control" disabled="true" placeholder="examination year" id="examinationYearPreview" aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="table_Container mt-2">
                    <table class="table" id="table">
                        <thead class="text-center">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Course Code</th>
                            <th scope="col">Course Unit</th>
                            <th scope="col">Score</th>
                            <th scope="col">Grade</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div class="btnContainer mt-2 d-flex justify-content-end gap-4">
                    <button class="btn btn-success" id='save_Results_Btn'>Save</button>
                    <button class="btn btn-danger" id="closePopUpBtn">Cancel</button>
                </div>
            </form>
        </div>
    </section>
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
                    <li><a href="/srms/add_student">Student Management</a></li>
                    <li><a href="/srms/add_results" class="active">Result Management</a></li>
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

            <section class="content-section" id="result-management">
                <div class="alert-messages w-100 text-center mb-2" id="alert_container"></div>
                <div class="search-filter-form mb-2">
                    <div class="search-input d-flex justify-content-end">
                        <div class="input-group w-50">
                            <input type="text"id="searchInput" class="form-control" placeholder="Search for a student using their matriculation number" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <button class="input-group-text btn btn-success search_student_btn" id="basic-addon2">Search</button>
                        </div>
                    </div>
                </div>
                <h2>Result Management</h2>
                <p>Use the form below to add a new result for a specific student. Please enter the correct details for each respective student.</p>

                <div class="formContainer">
                    <form id="form">
                        <div class="form-group">
                            <label for="studentName">Student Name:</label>
                            <input type="text" class="form-control" name="fullname" id="studentName" placeholder="Enter student's full name">
                        </div>
                        <div class="form-group">
                            <label for="studentName">Matric Number:</label>
                            <input type="text" class="form-control" name="matricNumber" id="matricNumber" placeholder="Enter student matric number">
                        </div>
                        <div class="form-group">
                            <label for="studentDepartment">Department:</label>
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
                            <label for="studentFaculty">Faculty:</label>
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
                            <label for="studentLevel">Level Of Study:</label>
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
                            <input type="text" name="academicSession" class="form-control" id="academicSession" placeholder="Enter the academic session for result e.g. 2021/22">
                        </div>

                        <div class="result-form-container">
                            <div class="result-header w-100 text-center"><h5>Please enter the result data for the respected student.</h5></div>

                            <div class="result-form mt-3">
                                <div class="add_form"><button type="button" class="btn btn-primary" id="addFieldsBtn">Add Fields <i class="fa-solid fa-plus"></i></button></div>
                                <div id="fieldsContainer">
                                    <div class="container text-center mt-2">
                                        <div class="row no_gutters text-center mt-1">
                                            <div class="col-3"><input type="text" class="form-control courseCode text-center" placeholder="Course Code"></div>
                                            <div class="col-2"><input type="text" class="form-control courseUnit text-center" placeholder="Course Unit"></div>
                                            <div class="col-2"><input type="number" class="form-control score text-center" placeholder="Score"></div>
                                            <div class="col-2"><input type="text" class="form-control grade text-center" placeholder="Grade" readonly></div>
                                            <div class="col-2"><input type="text" class="form-control gradePoint text-center" placeholder="Grade Points" readonly></div>
                                            <div class="col-1 d-flex align-items-center justify-content-center pe-auto"><i class="fa-solid fa-times text-danger fs-5 remove_row"></i></div>
                                        </div>
                                        
                                    
                                    </div>
                                </div>
                                <div class="action_btns">
                                    <div class="button"><button class="btn btn-primary" id="nextBtn">Preview Result <i class="fa-solid fa-caret-right"></i></button></div>
                                    <div class="button"><button class="btn btn-danger">Reset Form <i class="fa-solid fa-arrow-rotate-left" id="resetForm"></i></button></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>

    <script src="./public/js/add__Results.js"></script>
</body>
</html>