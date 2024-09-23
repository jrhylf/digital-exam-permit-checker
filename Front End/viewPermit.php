<?php 
  $db = mysqli_connect('localhost','root','','db_sepc') or die("Unable to connect to database");
  session_start();
  if (!isset($_SESSION['student_id'])) {
    header("Location:login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> STI Students | Exam Permit </title>
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
            <img src="images/STILogos.png" alt="logo" style="height: 100%; margin-bottom: 4px;" />
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
            <h1 class="welcome-text"> Good Day, <span class="text-black fw-bold"> <?php echo $_SESSION['name'];?> </span></h1>
            <h3 class="welcome-sub-text"> Welcome to STI College's exam permit checker! </h3>
          </li>
        </ul>
        <!-- END OF Greetings -->
        <ul class="navbar-nav ms-auto">
          <!-- Calendar -->
          
          <!-- END OF Calendar -->
          

          <!-- User Profile -->
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="images/user.png" alt="Profile image" style="width: 40px; height: 100%;"> </a>
            <!-- User Profile Content -->  
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="images/user.png" alt="Profile image" style="margin-top: 20px; height: 90px;">
                <br>
                <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['name'];?></p>
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
            <a class="nav-link" href="viewPermit.php">
              <i class="mdi mdi-file-document menu-icon"></i>
              <span class="menu-title"> View Permit </span>
            </a>
          </li>

          <li class="nav-item nav-category"> Tools </li>
          <li class="nav-item">
            <a class="nav-link" href="permitChecker.php">
              <i class="menu-icon mdi mdi-qrcode-scan"></i>
              <span class="menu-title"> Permit Checker </span>
            </a>
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
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="row">
                              <div class="col-md-6">
                                <h4 class="card-title"><i class="mdi mdi-file-document"></i> &nbsp;View Exam Permit</h4>
                              </div>
                              <div class="col-md-6">
                                <a href="promissoryNote_status.php"><button id="triggerModal" class="btn btn-icon-text btn-secondary" style="float: right;"><i class="btn-icon-prepend mdi mdi-eye"></i> View Promissory Note Status </button></a>
                                <a href="promissoryNote_submit.php"><button id="triggerModal" class="btn btn-icon-text btn-secondary" style="float: right;"><i class="btn-icon-prepend mdi mdi-pencil"></i> Submit Promissory Note </button></a>
                              </div>
                            </div>
                            <p class="card-description">Students are able to view a digital copy of their Exam Permit in this page. This is where they would also see the signed subjects of their proctors once they have finished an exam. Students without permit to take exams will not have their exams signed by the proctors.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                    <?php $syResult = mysqli_query($db, "SELECT year, quarter FROM tbl_qs");?>
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6 flex-column">
                            <h4>Exam Attendance Form</h4>
                            <h6>Tertiary</h6>
                          </div>
                          <div class="col-md-6 flex-column">
                            <h6>STI College Alabang</h6>
                            <?php while($row = mysqli_fetch_array($syResult)) { ?>
                            <h6> SY and Term: 
                              <?php echo $row['year']. " / " . $row['quarter']?>
                            </h3>
                            <?php } ?>
                          </div>
                        </div>
                          <?php 
                            $student_id = $_SESSION['student_id'];
                            $student = mysqli_query($db, "SELECT * FROM tbl_students WHERE student_id = '$student_id'");
                          ?>
                          <?php while($row = mysqli_fetch_array($student)) { ?>
                            <p class="card-description">Name: &emsp;&emsp;&emsp;&emsp;<?php echo $row['last_name'].", ".$row['first_name']." ".$row['middle_name']; ?>
                            <br>
                            Student No.: &emsp;0<?php echo $_SESSION['student_id']?>
                            <br>
                            Program: &emsp;&emsp;&nbsp;&nbsp;&nbsp;<?php echo $row['course']?>
                            </p>
                          <?php } ?>

                        <?php 
                          $student_id = $_SESSION['student_id'];
                          $permit = mysqli_query($db, "SELECT * FROM tbl_permits WHERE student_id = '$student_id'");
                        ?>
                        <div class="col-lg-12 flex-column">
                          <div class="table-responsive">
                            <table class="table table-striped">
                              <thead style="top: 0; z-index: 2; position: sticky; background-color: #fff;">
                                <tr>
                                  <th>Course Title</th>
                                  <th>Section</th>
                                  <th>Prelim</th>
                                  <th>Midterms</th>
                                  <th>Prefinals</th>
                                  <th>Finals</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php while($row = mysqli_fetch_array($permit)) { 
                                    $subject_id = $row['subject_id'];
                                    $subjectResult = mysqli_query($db, "SELECT subject_description FROM tbl_subjects WHERE subject_id='$subject_id'");
                                    $student_id = $row['student_id'];
                                    $section = mysqli_query($db, "SELECT section FROM tbl_students WHERE student_id='$student_id'");
                                ?>
                                <tr>
                                  <?php while($subrow = mysqli_fetch_array($subjectResult)) { ?>
                                    <td><?php echo $subrow['subject_description']; ?></td>
                                  <?php } ?>
                                  <?php while($secrow = mysqli_fetch_array($section)) { ?>
                                    <td><?php echo $secrow['section']; ?></td>
                                  <?php } ?>
                                  <td><?php echo $row['s_prelim']; ?></td>
                                  <td><?php echo $row['s_midterm']; ?></td>
                                  <td><?php echo $row['s_prefinal']; ?></td>
                                  <td><?php echo $row['s_final']; ?></td>
                                </tr>
                                <?php } ?>
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
          </div>
        </div>
        <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon" style="background-color: white;position: fixed; bottom: 30px; right: 20px; z-index: 99; display: none;" id="topBtn" onclick="topFunction()">
          <i class="ti-stats-up text-success"></i>                          
        </button>

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
</body>

</html>

