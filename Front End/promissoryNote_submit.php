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
  <title> STI Students | Submit Promissory Note </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">

  <script type="text/javascript" src="sweetalert.min.js"></script>
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
                            <br>
                            <?php $quarterResult = mysqli_query($db, "SELECT quarter FROM tbl_qs");?>
                            <form action="promissoryNote_submit.php" method="POST">
                              <div class="row">
                                <div class="col-lg-10">
                                  <h4 class="card-title"><i class="mdi mdi-pencil"></i> &nbsp; Promissory Note</h4>
                                  <h6 class="card-description" style="margin-left: 30px;"> To the Registrar's Office, </h6>
                                  <h6 class="card-description" style="margin-left: 30px;"> Good day! I am <?php echo $_SESSION['name']; ?>, student <?php echo $_SESSION['student_id']; ?>. I am submitting this promissory note as I was not able to pay for my current balance this 
                                  <?php while($row = mysqli_fetch_array($quarterResult)) { echo $row['quarter']; } ?> Quarter. I do hope for your kind consideration to approve this promissory note so that I may take the current quarter's exam.
                                  </h6>
                                  <h6 class="card-description" style="margin-left: 30px;"> Rest assured that I will clear my payment balances between the dates of:</h6>
                                  <div class="form-group row" style="margin-left: 30px;">
                                    <div class="col">
                                      <p>From:</p>
                                      <input class="form-control" type="date" name="from" value="" required="">
                                    </div>
                                    <div class="col">
                                      <p>Until:</p>
                                      <input class="form-control" type="date" name="until" value="" required="">
                                    </div>
                                  </div>
                                  <h6 class="card-description" style="margin-left: 30px;"> Thank you for your kind consideration.</h6>
                                  <br>
                                  <h6 class="card-description" style="margin-left: 30px;"> - <?php echo $_SESSION['name']; ?></h6>
                                </div>
                              </div>
                              <br>
                              <div class="form-group row">
                                <div class="col">
                                  <button class="btn btn-primary btn-lg" name="submitPromisoryNote" style="color: white; width: 100%; margin-bottom: 0;"> Submit Promissory Note </button>
                                </div>
                              </div>
                            </form>
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

        <?php

          // Database connection
          $db = mysqli_connect('localhost','root','','db_sepc') or die("Unable to connect to database");

          // Variables
          $success = array();

          // Add Registrar
          if (isset($_POST['submitPromisoryNote'])) {

            // Get input and modify input
            $student_id = $_SESSION['student_id'];
            $student_name = $_SESSION['name'];
            $from = $_POST['from'];
            $until = $_POST['until'];

            // Get Quarter
            $qs_result = mysqli_query($db,"SELECT quarter FROM tbl_qs") or die ("Failed to query database");
            $qs_row = mysqli_fetch_array($qs_result);
            $quarter = $qs_row['quarter'];

            $permitted_result = mysqli_query($db,"SELECT p_prelim, p_midterm, p_prefinal, p_final FROM tbl_students WHERE student_id = '$student_id'") or die ("Failed to query database");
            $permitted_row = mysqli_fetch_array($permitted_result);

            if ($quarter == "Prelim") {

              if ($permitted_row['p_prelim'] == 'y') {
                echo ('<script>swal("Permitted!", "You are permitted to take the exams for Prelim, there is no need to submit a promissory note until you are not permitted to take the exams.", "warning");</script>');
                //echo ('<script>confirm("You are permitted to take the exams for Prelim, there is no need to submit a promissory note until you are not permitted to take the exams.");</script>');
              } else if ($permitted_row['p_prelim'] == 'p'){
                echo ('<script>swal("Promissory Note Approved!", "Your submittion of promissory note has been approved by the registrars office, you are now permitted to take the exam.", "success");</script>');
                //echo ('<script>confirm("Your submittion of promissory note has been approved by the registrars office, you are now permitted to take the exam.");</script>');
              } else if ($permitted_row['p_prelim'] == 'n'){
                $duplicateResult = "SELECT * FROM tbl_promissory WHERE student_id='$student_id'";
                $duplicateResultC = mysqli_query($db, $duplicateResult);
                $duplicateResultCount = mysqli_num_rows($duplicateResultC);

                if ($duplicateResultCount > 0) {
                  echo ('<script>swal("Oops!", "You have already submitted a promissory note for this quarter. Please wait for your submittion to be processed by the registrars office.", "error");</script>');
                  //echo ('<script>confirm("You have already submitted a promissory note for this quarter. Please wait for your submittion to be processed by the registrars office.");</script>');
                } else {
                  // Add input to database
                  $submitPromissory = "INSERT INTO tbl_promissory (student_id, promissory_note, pay_from, pay_to, quarter) VALUES ('$student_id', 'To the Registrars Office, Good day! I am $student_name, student $student_id...', '$from', '$until', '$quarter')";
                  $submitPromissoryResult = mysqli_query($db, $submitPromissory);

                  if ($submitPromissoryResult) {
                    echo ('<script>swal("Submitted!", "You have successfully submitted a promissory note, please wait before updates.", "success");</script>');
                    //echo ('<script>confirm("You have successfully submitted a promissory note, please wait before updates.");</script>');
                  }
                }
              }

            } else if ($quarter == "Midterm") {

              if ($permitted_row['p_midterm'] == 'y') {
                echo ('<script>swal("Permitted!", "You are permitted to take the exams for Prelim, there is no need to submit a promissory note until you are not permitted to take the exams.", "warning");</script>');
                //echo ('<script>confirm("You are permitted to take the exams for Prelim, there is no need to submit a promissory note until you are not permitted to take the exams.");</script>');
              } else if ($permitted_row['p_midterm'] == 'p'){
                echo ('<script>swal("Promissory Note Approved!", "Your submittion of promissory note has been approved by the registrars office, you are now permitted to take the exam.", "success");</script>');
                //echo ('<script>confirm("Your submittion of promissory note has been approved by the registrars office, you are now permitted to take the exam.");</script>');
              } else if ($permitted_row['p_midterm'] == 'n'){
                $duplicateResult = "SELECT * FROM tbl_promissory WHERE student_id='$student_id'";
                $duplicateResultC = mysqli_query($db, $duplicateResult);
                $duplicateResultCount = mysqli_num_rows($duplicateResultC);

                if ($duplicateResultCount > 0) {
                  echo ('<script>swal("Oops!", "You have already submitted a promissory note for this quarter. Please wait for your submittion to be processed by the registrars office.", "error");</script>');
                  //echo ('<script>confirm("You have already submitted a promissory note for this quarter. Please wait for your submittion to be processed by the registrars office.");</script>');
                } else {
                  // Add input to database
                  $submitPromissory = "INSERT INTO tbl_promissory (student_id, promissory_note, pay_from, pay_to, quarter) VALUES ('$student_id', 'To the Registrars Office, Good day! I am $student_name, student $student_id...', '$from', '$until', '$quarter')";
                  $submitPromissoryResult = mysqli_query($db, $submitPromissory);

                  if ($submitPromissoryResult) {
                    echo ('<script>swal("Submitted!", "You have successfully submitted a promissory note, please wait before updates.", "success");</script>');
                    //echo ('<script>confirm("You have successfully submitted a promissory note, please wait before updates.");</script>');
                  }
                }
              }

            } else if ($quarter == "Prefinal") {

              if ($permitted_row['p_prefinal'] == 'y') {
                echo ('<script>swal("Permitted!", "You are permitted to take the exams for Prelim, there is no need to submit a promissory note until you are not permitted to take the exams.", "warning");</script>');
                //echo ('<script>confirm("You are permitted to take the exams for Prelim, there is no need to submit a promissory note until you are not permitted to take the exams.");</script>');
              } else if ($permitted_row['p_prefinal'] == 'p'){
                echo ('<script>swal("Promissory Note Approved!", "Your submittion of promissory note has been approved by the registrars office, you are now permitted to take the exam.", "success");</script>');
                //echo ('<script>confirm("Your submittion of promissory note has been approved by the registrars office, you are now permitted to take the exam.");</script>');
              } else if ($permitted_row['p_prefinal'] == 'n'){
                $duplicateResult = "SELECT * FROM tbl_promissory WHERE student_id='$student_id'";
                $duplicateResultC = mysqli_query($db, $duplicateResult);
                $duplicateResultCount = mysqli_num_rows($duplicateResultC);

                if ($duplicateResultCount > 0) {
                  echo ('<script>swal("Oops!", "You have already submitted a promissory note for this quarter. Please wait for your submittion to be processed by the registrars office.", "error");</script>');
                  //echo ('<script>confirm("You have already submitted a promissory note for this quarter. Please wait for your submittion to be processed by the registrars office.");</script>');
                } else {
                  // Add input to database
                  $submitPromissory = "INSERT INTO tbl_promissory (student_id, promissory_note, pay_from, pay_to, quarter) VALUES ('$student_id', 'To the Registrars Office, Good day! I am $student_name, student $student_id...', '$from', '$until', '$quarter')";
                  $submitPromissoryResult = mysqli_query($db, $submitPromissory);

                  if ($submitPromissoryResult) {
                    echo ('<script>swal("Submitted!", "You have successfully submitted a promissory note, please wait before updates.", "success");</script>');
                    //echo ('<script>confirm("You have successfully submitted a promissory note, please wait before updates.");</script>');
                  }
                }
              }

            } else if ($quarter == "Final") {

              if ($permitted_row['p_final'] == 'y') {
                echo ('<script>swal("Permitted!", "You are permitted to take the exams for Prelim, there is no need to submit a promissory note until you are not permitted to take the exams.", "warning");</script>');
                //echo ('<script>confirm("You are permitted to take the exams for Prelim, there is no need to submit a promissory note until you are not permitted to take the exams.");</script>');
              } else if ($permitted_row['p_final'] == 'p'){
                echo ('<script>swal("Promissory Note Approved!", "Your submittion of promissory note has been approved by the registrars office, you are now permitted to take the exam.", "success");</script>');
                //echo ('<script>confirm("Your submittion of promissory note has been approved by the registrars office, you are now permitted to take the exam.");</script>');
              } else if ($permitted_row['p_final'] == 'n'){
                $duplicateResult = "SELECT * FROM tbl_promissory WHERE student_id='$student_id'";
                $duplicateResultC = mysqli_query($db, $duplicateResult);
                $duplicateResultCount = mysqli_num_rows($duplicateResultC);

                if ($duplicateResultCount > 0) {
                  echo ('<script>swal("Oops!", "You have already submitted a promissory note for this quarter. Please wait for your submittion to be processed by the registrars office.", "error");</script>');
                  //echo ('<script>confirm("You have already submitted a promissory note for this quarter. Please wait for your submittion to be processed by the registrars office.");</script>');
                } else {
                  // Add input to database
                  $submitPromissory = "INSERT INTO tbl_promissory (student_id, promissory_note, pay_from, pay_to, quarter) VALUES ('$student_id', 'To the Registrars Office, Good day! I am $student_name, student $student_id...', '$from', '$until', '$quarter')";
                  $submitPromissoryResult = mysqli_query($db, $submitPromissory);

                  if ($submitPromissoryResult) {
                    echo ('<script>swal("Submitted!", "You have successfully submitted a promissory note, please wait before updates.", "success");</script>');
                    //echo ('<script>confirm("You have successfully submitted a promissory note, please wait before updates.");</script>');
                  }
                }
              }
            } 
          }
        ?>

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

