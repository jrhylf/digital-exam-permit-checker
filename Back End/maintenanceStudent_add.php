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
  <title> STI Registrar | Add Student </title>
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

                    <div id="teacher_add">
                    <div class="col-lg-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Add Students</h4>
                          <?php include('successPrompt.php'); ?>
                          <?php include('errorPrompt.php'); ?>
                          <form action="maintenanceStudent_add.php" method="POST">
                            <div class="form-group row">
                              <div class="col">
                                <p>Student ID:</p>
                                <input class="form-control form-control-lg" type="number" name="studentID" placeholder="Student ID" value="" required="">
                              </div>

                              <div class="col">
                                <div class="form-group">
                                  <label>Course</label>
                                  <select class="js-example-basic-single w-100 select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" style="padding: 10px;" name="course" id="course" required>
                                    <option value="">-- Select Course --</option>
                                    <?php $courseResults = mysqli_query($db, "SELECT course_code, course_description FROM tbl_courses");?>
                                    <?php while($row = mysqli_fetch_array($courseResults)) { ?>
                                      <option value="<?php echo $row['course_code']; ?>"><?php echo $row['course_description']; ?>
                                      </option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>

                              <div class="col">
                                <div class="form-group">
                                  <label>Section</label>
                                  <select class="js-example-basic-single w-100 select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" style="padding: 10px;" name="section" id="section" required>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <div class="form-group row">
                              <div class="col">
                                <p>Last Name:</p>
                                <input class="form-control form-control-lg" type="text" name="lastName" placeholder="Last Name" value="" required="">
                              </div>
                              <div class="col">
                                <p>First Name:</p>
                                <input class="form-control form-control-lg" type="text" name="firstName" placeholder="First Name" value="" required="">
                              </div>
                              <div class="col">
                                <p>Middle Name:</p>
                                <input class="form-control form-control-lg" type="text" name="middleName" placeholder="Middle Name" value="">
                              </div>
                            </div>
                            
                            <div class="form-group row">
                              <div class="col">
                                <p>Password:</p>
                                <input class="form-control form-control-lg" type="password" name="password" placeholder="Password" value="" required="" id="password">
                              </div>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label text-muted">
                                <input type="checkbox" class="form-check-input" onclick="showPassword()">
                                Show Password
                              <i class="input-helper"></i></label>
                            </div>

                            <br>
                            <h4 class="card-title">Student Permit</h4>
                            <div class="form-group row">
                              <div class="col">
                                <label>Prelim</label>
                                  <select class="js-example-basic-single w-100 select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" style="padding: 10px;" name="prelim" required>
                                    <option value="n">No</option>
                                    <option value="p">Promisory</option>
                                    <option value="y">Yes</option>
                                  </select>
                              </div>
                              <div class="col">
                                <label>Midterm</label>
                                  <select class="js-example-basic-single w-100 select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" style="padding: 10px;" name="midterm" required>
                                    <option value="n">No</option>
                                    <option value="p">Promisory</option>
                                    <option value="y">Yes</option>
                                  </select>
                              </div>
                              <div class="col">
                                <label>Prefinal</label>
                                  <select class="js-example-basic-single w-100 select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" style="padding: 10px;" name="prefinal" required>
                                    <option value="n">No</option>
                                    <option value="p">Promisory</option>
                                    <option value="y">Yes</option>
                                  </select>
                              </div>
                              <div class="col">
                                <label>Final</label>
                                  <select class="js-example-basic-single w-100 select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" style="padding: 10px;" name="final" required>
                                    <option value="n">No</option>
                                    <option value="p">Promisory</option>
                                    <option value="y">Yes</option>
                                  </select>
                              </div>
                            </div>

                            <div class="form-group row">
                              <div class="col">
                                <button class="btn btn-primary btn-lg" name="addStudent" style="color: white; width: 100%; margin-bottom: 0;"> Add Student </button>
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
        <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon" style="background-color: white;position: fixed; bottom: 30px; right: 20px; z-index: 99; display: none;" id="topBtn" onclick="topFunction()">
          <i class="ti-stats-up text-success"></i>                          
        </button>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            $('#course').on('change', function(){
                var courseValue = this.value;
                if(courseValue){
                    $.ajax({
                        type:'POST',
                        url:'getDropdownValues.php',
                        data:'courseValue='+courseValue,
                        success:function(html){
                            $('#section').html(html);
                        }
                    }); 
                }else{
                    $('#section').html('<option value="">-- Select Section --</option>');
                }
            });

            var defaultOption = $('#course').find('option[value=""]');
            if(defaultOption.is(':selected')){
                $('#section').html('<option value="">-- Select Section --</option>');
            }
            
          });
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
  <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
    
    function showPassword() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
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

