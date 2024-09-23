<?php
    // Start Session
    session_start();

    // Database connection
    $db = mysqli_connect('localhost','root','','db_sepc') or die("Unable to connect to database");

    // Variables
    $username = "";
    $password = "";
    $errors = array();


    // Administrator Login
    if (isset($_POST['login'])) {

      // Get admin input and modify input
      $username = mysqli_real_escape_string($db, $_POST['user']);
      $password = mysqli_real_escape_string($db, $_POST['pass']);
      $username = trim($username);
      $username = trim($username);
      $username = stripcslashes($username);
      $password = stripcslashes($password);
      
      // Check if the input was in the database records
      $result = mysqli_query($db,"SELECT * FROM tbl_registrar WHERE registrar_username = '$username' AND registrar_password = '$password'") or die ("Failed to query database");
      $row = mysqli_fetch_array($result);

      // If the input is a correct combination
      if (isset($row)){
        $_SESSION['Username'] = $row['registrar_username'];
        $_SESSION['Registrar'] = $row['registrar_name'];
        // Redirect to dashboard page
        header("location:dashboard.php");
      } else {
        array_push($errors, "Incorrect Username and Password combination");
      }
    }
?>