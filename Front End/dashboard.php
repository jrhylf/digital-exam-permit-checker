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
  <title> STI Students | Dashboard </title>
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

                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <!-- Banner -->
                        <div class="row flex-column">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded table-darkBGImg">
                              <div class="card-body">
                                <div class="col-sm-8">
                                  <h3 class="text-white upgrade-info mb-0">
                                    Enhance your <span class="fw-bold"> Education </span> for a brighter future ~
                                  </h3>
                                  <a href="https://www.sti.edu/" class="btn btn-info upgrade-btn"> Visit STI Official Page! </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- END OF Banner -->
                      </div>

                    <?php $studentCount = "SELECT * FROM tbl_students"?>
                    <!-- <?php $courseCount = "SELECT * FROM tbl_courses"?> -->
                    <?php $semesterResult = mysqli_query($db, "SELECT semester FROM tbl_qs");?>
                    <?php $quarterResult = mysqli_query($db, "SELECT quarter FROM tbl_qs");?>
                    <?php $syResult = mysqli_query($db, "SELECT year FROM tbl_qs");?>
                    <?php $courseCount = "SELECT * FROM tbl_courses"?>
                    <?php $proctorCount = "SELECT * FROM tbl_proctors"?>

                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row">
                          <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col">
                                    <img src="images/school.png" style="height: 80px; margin-left: 20px;" />
                                  </div>
                                  <div class="col" style="margin-top: 7px; margin-left: -60px;">
                                    <p class="statistics-title"> School Year </p>
                                    <?php while($row = mysqli_fetch_array($syResult)) { ?>
                                    <h3 class="rate-percentage">
                                      <?php echo $row['year']?>
                                    </h3>
                                    <?php } ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col">
                                    <img src="images/binder.png" style="height: 80px; margin-left: 20px;" />
                                  </div>
                                  <div class="col" style="margin-top: 7px; margin-left: -60px;">
                                    <p class="statistics-title"> Semester </p>
                                    <?php while($row = mysqli_fetch_array($semesterResult)) { ?>
                                    <h3 class="rate-percentage"> 
                                      <?php 
                                        if ($row['semester'] == 1) {
                                          echo $row['semester']."st";
                                        } else if ($row['semester'] == 2){
                                          echo $row['semester']."nd";
                                        }
                                      ?>
                                    Semester
                                    </h3>
                                    <?php } ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col">
                                    <img src="images/stationery.png" style="height: 80px; margin-left: 20px;" />
                                  </div>
                                  <div class="col" style="margin-top: 7px; margin-left: -60px;">
                                    <p class="statistics-title"> Quarter </p>
                                    <?php while($row = mysqli_fetch_array($quarterResult)) { ?>
                                    <h3 class="rate-percentage">
                                      <?php echo $row['quarter']?>
                                    </h3>
                                    <?php } ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- 2ND ROW -->

                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row">
                          <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col">
                                    <img src="images/education.png" style="height: 80px; margin-left: 20px;" />
                                  </div>
                                  <div class="col" style="margin-top: 7px; margin-left: -60px;">
                                    <p class="statistics-title"> Courses </p>
                                      <h3 class="rate-percentage">
                                        <?php if($courseCountResult = mysqli_query($db, $courseCount)){
                                            $courseCountRows = mysqli_num_rows( $courseCountResult );
                                            echo $courseCountRows;
                                        }?>
                                        Courses
                                      </h3>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col">
                                    <img src="images/graduation-hat.png" style="height: 80px; margin-left: 20px;" />
                                  </div>
                                  <div class="col" style="margin-top: 7px; margin-left: -60px;">
                                    <p class="statistics-title"> Students </p>
                                    <h3 class="rate-percentage">
                                      <?php if($studentCountResult = mysqli_query($db, $studentCount)){
                                          $studentCountRows = mysqli_num_rows( $studentCountResult );
                                          echo $studentCountRows;
                                      }?>
                                      Students
                                    </h3>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col">
                                    <img src="images/instructor.png" style="height: 80px; margin-left: 20px;" />
                                  </div>
                                  <div class="col" style="margin-top: 7px; margin-left: -60px;">
                                    <p class="statistics-title"> Proctors </p>
                                      <h3 class="rate-percentage">
                                        <?php if($proctorCountResult = mysqli_query($db, $proctorCount)){
                                            $proctorCountRows = mysqli_num_rows( $proctorCountResult );
                                            echo $proctorCountRows;
                                        }?>
                                        Proctors
                                      </h3>
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

