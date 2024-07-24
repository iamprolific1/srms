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
    <link rel="stylesheet" href="./public/css/dash-board.css">
    <link rel="stylesheet" href="./public/css/mobile.css">
    <link rel="stylesheet" href="./public/css/dashboardResponsive.css">
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
                        <li class="active"><a href="/srms/dashboard" class="active">Dashboard</a></li>
                        <li><a href="/srms/add_student">Student Management</a></li>
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
                    <li><a href="/srms/dashboard" class="active">Dashboard</a></li>
                    <li><a href="/srms/add_student">Student Management</a></li>
                    <li><a href="/srms/add_results">Result Management</a></li>
                    <li><a href="#settings">Settings</a></li>
                </ul>
            </nav>

            <div class="footer">
                &copy; 2024 Student Result Management System. All rights reserved.
            </div>
        </aside>
        <main class="main-content">
            <header class="header shadow-sm">
                <h1>Welcome, <?php  echo $username ?></h1>
                <div class="logout">
                    <a href="/srms/logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </div>
                <div class="menu_bar" id="menuBtn"><i class="fa-solid fa-bars"></i></div>
            </header>
            <section id="dashboard" class="content-section">
                <h2>Dashboard</h2>
                <p>Here's a quick overview of your student result management system.</p>

                <div class="cardContainer">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Students</h5>
                                    <div class="card-subtitle mb-2 text-secondary">represents the total number of students registered.</div>
                                    <p class="card-text user">
                                        <i class="fa-solid fa-user"></i>
                                    </p>
                                    <p class="card-text" id="studentCount">
                                        0
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Results</h5>
                                    <div class="card-subtitle mb-2 text-secondary">represents the total number of results per student registered.</div>
                                    <p class="card-text user">
                                        <i class="fa-solid fa-square-poll-vertical"></i>
                                    </p>
                                    <p class="card-text">
                                        0
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card_Action_Container mt-3">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header"><h6>Quick Actions</h6></div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><a href="/srms/add_student">Add Students</a></li>
                                        <li class="list-group-item"><a href="/srms/add_results">Enter Results</a></li>
                                        <li class="list-group-item"><a href="#">Generate Result</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="activities-today mt-3">
                    <div class="row">
                        <div class="col">
                            <div class="recent_Activities">
                                <div class="card">
                                    <div class="card-header"><h6>Recent Activities</h6></div>
                                    <div class="card-body">
                                        <div class="btnCon"><button class="btn btn-link">Clear Activities</button></div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Entered results for new student X in course Y</li>
                                            <li class="list-group-item">Added new student: name surname </li>
                                            <li class="list-group-item">Generated result for X department, session 2022/23.</li>
                                            <li class="list-group-item">Updated Student record: name surname</li>
                                            <li class="list-group-item">Entered results for new student X in course Y</li>
                                            <li class="list-group-item">Added new student: name surname </li>
                                            <li class="list-group-item">Generated result for X department, session 2022/23.</li>
                                            <li class="list-group-item">Updated Student record: name surname</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="calendar_container">
                                <div class="card">
                                    <div class="card-header"><h6>Today</h6></div>
                                    <div class="card-body">
                                        <div id="calendar">
                                            <div id="calendar-header">
                                                <button id="prev-month">←</button>
                                                <h5 id="month-year"></h5>
                                                <button id="next-month">→</button>
                                            </div>
                                            <table id="calendar">
                                                <thead>
                                                    <tr>
                                                        <th>Sun</th>
                                                        <th>Mon</th>
                                                        <th>Tue</th>
                                                        <th>Wed</th>
                                                        <th>Thu</th>
                                                        <th>Fri</th>
                                                        <th>Sat</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="calendar-body">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    
                    
                </div>
            </section>

            <footer class="mobile__footer">
                &copy; 2024 Student Result Management System. All rights reserved.
            </footer>
            
        </main>
    </div>

    <script src="./public/js/Dashboard.js"></script>
</body>
</html>
