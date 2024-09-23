<?php
    // Start Session
    session_start();

    // Database connection
    $db = mysqli_connect('localhost','root','','db_sepc') or die("Unable to connect to database");

    // Variables
    $student_id = "";
    $password = "";
    $errors = array();


    // Administrator Login
    if (isset($_POST['login'])) {

      // Get admin input and modify input
      $student_id = mysqli_real_escape_string($db, $_POST['student_id']);
      $password = mysqli_real_escape_string($db, $_POST['pass']);
      $student_id = trim($student_id);
      $student_id = trim($student_id);
      $student_id = stripcslashes($student_id);
      $password = stripcslashes($password);
      
      // Check if the input was in the database records
      $result = mysqli_query($db,"SELECT * FROM tbl_students WHERE student_id = '$student_id' AND password = '$password'") or die ("Failed to query database");
      $row = mysqli_fetch_array($result);

      // If the input is a correct combination
      if (isset($row)){
        $_SESSION['student_id'] = $row['student_id'];
        $_SESSION['name'] = $row['first_name']." ".$row['last_name'];
        // Redirect to dashboard page
        header("location:dashboard.php");
      } else {
        array_push($errors, "Incorrect Student ID and Password combination");
      }
    }
?>