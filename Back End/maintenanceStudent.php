<?php include('addProcess.php');?>
<?php 
  $db = mysqli_connect('localhost','root','','db_sepc') or die("Unable to connect to database");
  session_start();
  if (!isset($_SESSION['Username'])) {
    header("Location:login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> STI Registrar | Student Maintenance </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/TitleLogo.png" />
</head>
<body>
    <!-- Top Navigation Bar -->
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <!-- ??? -->
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <!-- Logo in desktop viewports -->
          <a class="navbar-brand brand-logo" href="dashboard.php">
            <img src="images/STILogo.png" alt="logo" style="height: 100%; margin-bottom: 4px;" />
          </a>
          <!-- Logo in mobile viewports -->
          <a class="navbar-brand brand-logo-mini" href="dashboard.php">
            <img src="images/TitleLogo.png" alt="logo" style="height: 38px;" />
          </a>
        </div>
      </div>
      <!-- END OF ??? -->
      <!-- Navigation bar in desktop viewports -->
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <!-- Greetings -->
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text"> Good Day, <span class="text-black fw-bold"> <?php echo $_SESSION['Registrar'];?> </span></h1>
            <h3 class="welcome-sub-text"> Displaying your statistical summary for this school year </h3>
          </li>
        </ul>
        <!-- END OF Greetings -->
        <ul class="navbar-nav ms-auto">
          <!-- Calendar -->
          
          <!-- END OF Calendar -->
          

          <!-- User Profile -->
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="images/adminProfile.png" alt="Profile image" style="width: 50px; height: 100%;"> </a>
            <!-- User Profile Content -->  
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="images/adminProfile.png" alt="Profile image" style="margin-top: 15px; height: 100px;">
                <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['Registrar'];?></p>
              </div>
              <a href="logout.php" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i> Sign Out </a>
            </div>
            <!-- END OF User Profile Content -->
          </li>
          <!-- END OF User Profile -->
        </ul>
        <!-- Menu Bar in smaller viewports -->
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
        <!-- END OF Menu Bar in smaller viewports -->
      </div>
    </nav>
    <!-- END OF Top Navigation Bar -->


    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <!-- Right and Left Navigation Bar and Menu on smaller and desktop viewports -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">

          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="mdi mdi-view-dashboard menu-icon"></i>
              <span class="menu-title"> Dashboard </span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="permitManager.php">
              <i class="mdi mdi-file-document menu-icon"></i>
              <span class="menu-title"> Permit Manager </span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="promissoryManager.php">
              <i class="mdi mdi-bookmark menu-icon"></i>
              <span class="menu-title"> Promissory Manager </span>
            </a>
          </li>

          <li class="nav-item nav-category"> Calendar </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#calendar" aria-expanded="false" aria-controls="icons">
              <i class="menu-icon mdi mdi-calendar-multiple"></i>
              <span class="menu-title"> Clndr General </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="calendar">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="calendarSchoolYear.php">Set School Year</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="calendarSemester.php">Set Semester</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="calendarQuarter.php">Set Quarter</a></li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item nav-category"> Maintenance </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#maintenance" aria-expanded="false" aria-controls="icons">
              <i class="menu-icon mdi mdi-server"></i>
              <span class="menu-title"> Mntnc General </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="maintenance">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="maintenanceRegistrar.php">Registrar Mntnc</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="maintenanceProctor.php">Proctor Mntnc</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="maintenanceStudent.php">Student Mntnc</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="maintenanceCourse.php">Course Mntnc</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="maintenanceSection.php">Section Mntnc</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="maintenanceSubject.php">Subject Mntnc</a></li>
              </ul>
              
            </div>
          </li>
          <li class="nav-item nav-category"> Actions </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">
              <i class="menu-icon mdi mdi-logout-variant"></i>
              <span class="menu-title"> Sign out </span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- END OF Right and Left Navigation Bar and Menu on smaller and desktop viewports -->

      <!-- Main Body -->
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <!-- Start Main Body -->
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 

                    <form method="POST" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Batch Upload</h4>
                              <?php include('successPrompt.php');?>
                              <?php include('errorPrompt.php');?>
                              <p class="card-description">
                                Registrar has the ability to upload batches of information to the Student Records. Please select .csv files to upload student information by batch.
                              </p>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="file" name="import_Students_file" class="form-control">
                                </div>
                                <div class="col-md-6">
                                  <button type="submit" name="btn_import_Students" class="btn btn-success btn-icon-text" style="color: white; width: 50%; float: left; margin-left: 0;">
                                    <i class="ti-upload btn-icon-prepend"></i> Upload 
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>

                    <?php 

                    if (isset($_POST['search'])) {
                      
                      $find_value = $_POST['find_value'];
                      $query = "SELECT * FROM tbl_students WHERE CONCAT(student_id, first_name, middle_name, last_name, course, section) LIKE '%".$find_value."%' ORDER BY student_id DESC";
                      $searchResult = filterTable($query);

                    } else {

                      $query = "SELECT * FROM tbl_students ORDER BY student_id DESC";
                      $searchResult = filterTable($query);

                    }

                    function filterTable($query){
                      $db = mysqli_connect('localhost','root','','db_sepc') or die("Unable to connect to database");
                      $filterResult = mysqli_query($db, $query);
                      return $filterResult;
                    }

                    ?>

                    <form action="maintenanceStudent.php" method="POST">
                      <div class="row">
                        <div class="col-lg-12 d-flex flex-column">
                          <div class="card">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-3">
                                  <h4 class="card-title">Manage Students</h4>
                                </div>
                                <div class="col-md-4">
                                  <div class="row">
                                    <div class="col-sm-2">
                                      <button type="submit" class="btn btn-inverse-dark btn-icon" name="search">
                                        <i class="mdi mdi-magnify"></i>
                                      </button>
                                    </div>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-md" placeholder="Search Student" aria-label="Search" style="float: right; margin-top: 2px;" name="find_value">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-5">
                                  <button type="button" class="btn btn-danger btn-icon" style="float: right; color: white;" onclick="deleteAllStudents('sti_registrar')">
                                    <i class="mdi mdi-delete"></i>
                                    All
                                  </button>
                                  <a href="maintenanceStudent_add.php"><button type="button" class="btn btn-icon-text btn-secondary" style="float: right;"><i class="btn-icon-prepend mdi mdi-plus"></i> Add Students </button></a>
                                </div>
                                
                              </div>
                              <p class="card-description">
                                Viewing all of data inside the database of Students. You are able to Edit and Delete or basically modify students within the Database of Students.
                              </p>
                              <div class="table-responsive" style="display: block; max-height: 600px; overflow-y: scroll">
                                <table class="table table-striped">
                                  <thead style="top: 0; z-index: 2; position: sticky; background-color: #fff;">
                                        <tr>
                                          <th>SID</th>
                                          <th>First Name</th>
                                          <th>Middle Name</th>
                                          <th>Last Name</th>
                                          <th>Course</th>
                                          <th>Section</th>
                                          <th>Password</th>
                                          <th>Permits</th>
                                          <th>Prelims</th>
                                          <th>Midterms</th>
                                          <th>Prefinals</th>
                                          <th>Finals</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php while($row = mysqli_fetch_array($searchResult)) { ?>
                                        <tr>
                                          <td><?php echo $row['student_id']; ?></td>
                                          <td><?php echo $row['first_name']; ?></td>
                                          <td><?php echo $row['middle_name']; ?></td>
                                          <td><?php echo $row['last_name']; ?></td>
                                          <td><?php echo $row['course']; ?></td>
                                          <td><?php echo $row['section']; ?></td>
                                          <td><?php echo $row['password']; ?></td>
                                          <td></td>
                                          <td><?php echo $row['p_prelim']; ?></td>
                                          <td><?php echo $row['p_midterm']; ?></td>
                                          <td><?php echo $row['p_prefinal']; ?></td>
                                          <td><?php echo $row['p_final']; ?></td>
                                          <td>
                                            <a href="maintenanceStudent_edit.php?editStudent=<?php echo $row['student_id']; ?>"><button type="button" class="btn btn-primary" style="color: white;">Edit</button></a>
                                            <button type="button" class="btn btn-danger" onclick="deleteStudent(<?php echo $row['student_id']; ?>)" style="color: white;">Delete</button></td>
                                        </tr>

                                        <script type="text/javascript">
                                          function deleteStudent(delID){
                                              if (confirm("Are you sure you want to delete student <?php echo $row['student_id'];?>? This will also delete the permit of the student. Continue?")) {
                                                  window.location.href='deleteProcess.php?delStudent='+ delID;
                                              }
                                          }
                                        </script>

                                        <?php } ?>
                                      
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon" style="background-color: white;position: fixed; bottom: 30px; right: 20px; z-index: 99; display: none;" id="topBtn" onclick="topFunction()">
          <i class="ti-stats-up text-success"></i>                          
        </button>

        <script type="text/javascript">
          function deleteAllStudents(pass){

            var password = prompt("Please enter your password to confirm deletion:");

            if (password == pass) {
              if (confirm("Are you sure you want to delete all records from Students at once? This will also delete all records from Permits. Please confirm if you approve of this decision.")) {
                window.location.href='deleteProcess.php?delAllStudents=true';
              }
            } else {
              alert("Incorrect password. Access to deletion denied.");
            }
          }
        </script>

        <script type="text/javascript">
          //Get the button:
          mybutton = document.getElementById("myBtn");

          // When the user scrolls down 20px from the top of the document, show the button
          window.onscroll = function() {scrollFunction()};

          function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
              topBtn.style.display = "block";
            } else {
              topBtn.style.display = "none";
            }
          }

          // When the user clicks on the button, scroll to the top of the document
          function topFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
          }
        </script>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"> STI Education Services Group, Inc. </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Copyright © 2022. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/jquery.cookie.js" type="text/javascript"></script>
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
  <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
  </script>
</body>

</html>

