<?php include('login_process.php') ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>STI Registrar | Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/feather/feather.css" />
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css" />
    <link rel="stylesheet" href="vendors/typicons/typicons.css" />
    <link
      rel="stylesheet"
      href="vendors/simple-line-icons/css/simple-line-icons.css"
    />
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css" />
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css" />
    <!-- endinject -->
    <link rel="shortcut icon" href="images/TitleLogo.png" />
  </head>

  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0" style="background-image: url(images/login_bg.jpg); background-size: cover">
          <div class="row w-100 mx-0" >
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                  <img src="images/STILogo.png" alt="logo" />
                </div>
                <h4>Hello! Welcome to STI Registrar</h4>
                <h6 class="fw-light">Sign in to continue.</h6>
                <?php include('errors.php'); ?>

                <form class="pt-3" action="login.php" method="POST" autocomplete="off">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control form-control-lg"
                      id="exampleInputEmail1"
                      name="user";
                      placeholder="Username"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <input
                      type="password"
                      class="form-control form-control-lg"
                      id="exampleInputPassword1"
                      name="pass"
                      placeholder="Password"
                      required
                    />
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input" onclick="showPassword()">
                        Show Password
                      <i class="input-helper"></i></label>
                    </div>
                  </div>
                  <div class="mt-3">
                    <input 
                    class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                    type="submit"
                    name="login"
                    value="SIGN IN">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <script>
      if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
      }

      function showPassword() {
        var x = document.getElementById("exampleInputPassword1");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>
  </body>
</html>

