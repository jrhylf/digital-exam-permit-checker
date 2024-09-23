<?php include('addProcess.php');?>
<?php include('editProcess.php');?>
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
  <title> STI Registrar | Edit Registrar </title>
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
            <img src="images/STILogo.png" alt="logo" style="height: 20px; margin-bottom: 4px;" />
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
              <a href="adminProfiles.php" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Admin Profiles </a>
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

                    <?php $mainRegistrarResults = mysqli_query($db, "SELECT * FROM tbl_registrar WHERE registrar_id = '1'");?>
                    <?php $registrarResults = mysqli_query($db, "SELECT * FROM tbl_registrar WHERE registrar_id != '1'");?>

                    <?php 
                    $editRegistrar = $_GET['editRegistrar'];
                    $editRegistrarResults = mysqli_query($db, "SELECT * FROM tbl_registrar WHERE registrar_id = '$editRegistrar'");?>

                    <div class="row">
                      <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Edit Registrar</h4>
                            <?php include('successPrompt.php');?>
                            <?php include('errorPrompt.php');?>
                            <p class="card-description">
                            In this module, you would be able to edit registrars inside the database of registrars and view them at the tables beside.
                            </p>
                            <?php while ($rrow = mysqli_fetch_array($editRegistrarResults)){ ?>
                            <form class="forms-sample" action="maintenanceRegistrar_edit.php" method="POST" autocomplete="off">
                              <input type="hidden" name="rid" value="<?php echo $rrow['registrar_id']?>">
                              <div class="form-group">
                                <label for="exampleInputUsername1">Registrar Name</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Registrar Name" name="registrar_name" required value="<?php echo $rrow['registrar_name']?>">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Username" name="registrar_username" required value="<?php echo $rrow['registrar_username']?>">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="registrar_password" required value="<?php echo $rrow['registrar_password']?>">
                              </div>
                              <div class="form-check">
                                <label class="form-check-label text-muted">
                                  <input type="checkbox" class="form-check-input" onclick="showPassword()">
                                  Show Password
                                <i class="input-helper"></i></label>
                              </div>
                              <br>
                              <div class="row" style="margin-left: 20px;">
                                <button type="submit" class="btn btn-primary me-2" style="color: white; padding: 15px; width: 90%;" name="editRegistrar">Update Registrar</button>
                              </div>
                            </form>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">View Registrars</h4>
                            <p class="card-description">
                            Viewing all of data inside the database of Administrators. You are able to Edit and Delete or basically modify admins within the Database of Administrators.
                            </p>
                            <div class="table-responsive">
                              <table class="table table-hover" style="max-height: 320px; overflow-y: auto; display: block;">
                                <thead style="top: 0; z-index: 2; position: sticky; background-color: #fff;">
                                  <tr>
                                    <th>RID</th>
                                    <th>Registrar Name</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php while($row = mysqli_fetch_array($mainRegistrarResults)) { ?>
                                  <tr>
                                    <td><?php echo $row['registrar_id']; ?></td>
                                        <td><?php echo $row['registrar_name']; ?></td>
                                        <td><?php echo $row['registrar_username']; ?></td>
                                        <td><?php echo $row['registrar_password']; ?></td>
                                        <td>Main registrar cannot be modified.</td>
                                  </tr>
                                  <?php } ?>

                                  <?php while($row = mysqli_fetch_array($registrarResults)) { ?>
                                  <tr>
                                    <td><?php echo $row['registrar_id']; ?></td>
                                    <td><?php echo $row['registrar_name']; ?></td>
                                    <td><?php echo $row['registrar_username']; ?></td>
                                    <td><?php echo $row['registrar_password']; ?></td>
                                    <td>
                                      <a href="maintenanceRegistrar_edit.php?editRegistrar=<?php echo $row['registrar_id']; ?>"><button type="button" class="btn btn-primary" style="color: white;">Edit</button></a>
                                      <button type="button" class="btn btn-danger" onclick="deleteRegistrar(<?php echo $row['registrar_id']; ?>)" style="color: white;">Delete</button></td>
                                  </tr>
                                  <script type="text/javascript">
                                    function deleteRegistrar(delID){
                                        if (confirm("Are you sure you want to delete <?php echo $row['registrar_name'];?>?")) {
                                            window.location.href='deleteProcess.php?delRegistrar='+ delID;
                                        }
                                    }
                                  </script>
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
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"> STI Education Services Group, Inc. </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Copyright © 2021. All rights reserved.</span>
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

