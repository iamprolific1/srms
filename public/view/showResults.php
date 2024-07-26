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
    <link rel="stylesheet" href="./public/css/mobile.css">
    <link rel="stylesheet" href="./public/css/view__Results.css">
</head>
<body>
    <div class="main__container">

        <div class="display_Result_Container">
            <div class="result shadow-sm">
                <table class="table">
                    
                </table>
            </div>
        </div>

        <div class="mobile-Sidebar-Container">
            <div class="sidebar-mobile">
                <div class="logo">
                    <h3>Admin Panel</h3>
                </div>

                <div class="menuContainer">
                    <ul>
                        <li class="active"><a href="/srms/dashboard" class="active">Dashboard</a></li>
                        <li><a href="/srms/add_student">Student Management</a></li>
                        <li><a href="#viewStudents">View Students</a></li>
                        <li><a href="/srms/add_results">Result Management</a></li>
                        <li><a href="/srms/view_results">View Results</a></li>
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
                    <li><a href="#viewStudents">View Students</a></li>
                    <li><a href="/srms/add_results">Result Management</a></li>
                    <li><a href="/srms/view_results" class="active">Search Results</a></li>
                    <li><a href="#settings">Settings</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header shadow-sm">
                <h1>Welcome, <?php  echo $username ?></h1>
                <div class="logout">
                    <a href="/srms/logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </div>
                <div class="menu_bar" id="menuBtn"><i class="fa-solid fa-bars"></i></div>
            </header>

            <section id="view_Results" class="content-section">
                <h2>Search & Print Results</h2>
                <p>Here is the total overview of all the results stored in the database. You can filter results based on prefered search.</p>

                <div class="container">
                    <div class="alertContainer w-75 mx-auto" id="alertContainer"></div>
                    <form class="form mt-2 p-2" id="searchForm">
                        <span class="text-center text-success d-flex justify-content-center align-items-center">Please search result using the form provided below. Use all or prefered field for search.</span>
                        <div class="row w-50 mx-auto shadow-sm p-3 flex flex-column">
                            <div class="col mb-2">
                                <input type="text" name="matricNumber" class="form-control text-center" placeholder="Search result by matric number">
                            </div>
                            <div class="col mb-2">
                                <select name="department" class="form-control text-center" id="studentDepartment">
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
                            <div class="col mb-2">
                                <select name="level" id="studentLevel" class="form-control text-center">
                                    <option value="">Select Level</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="300">300</option>
                                    <option value="400">400</option>
                                </select>
                            </div>
                            <div class="col mb-2">
                                <select name="semester" id="semester" class="form-control text-center">
                                    <option value="">Select Semester</option>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                </select>
                            </div>
                            <div class="col mb-2">
                                <input type="text" name="examinationYear" class="form-control text-center" placeholder="Search result by examination year e.g 2021/22">
                            </div>

                            <div class="col mt-3 mb-1 text-center">
                                <button class="btn btn-primary w-75" type="submit" id="submitBtn">Get Result</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>

    <script src="./public/js/search__Results.js"></script>
</body>
</html>