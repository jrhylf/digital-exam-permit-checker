<?php include('phpqrcode/qrlib.php');
  
    // Database connection
    $db = mysqli_connect('localhost','root','','db_sepc') or die("Unable to connect to database");

    // Variables
    $success = array();
    $error = array();

    // Add Registrar
    if (isset($_POST['addRegistrar'])) {
      // Get input and modify input
      $registrarName = $_POST['registrarName'];
      $registrarUsername = $_POST['registrarUName'];
      $registrarPassword = $_POST['registrarPass'];

      $checkDuplicate = "SELECT registrar_username FROM tbl_registrar WHERE registrar_username='$registrarUsername'";
      $checkDuplicateResult = mysqli_query($db, $checkDuplicate);
      $duplicateCount = mysqli_num_rows($checkDuplicateResult);

      if ($duplicateCount > 0) {
        array_push($error, "Username ". $registrarUsername ." already exists in the database.");
      } else {
        // Add input to database
        $addToRegistrars = "INSERT INTO tbl_registrar (registrar_name, registrar_username, registrar_password) VALUES ('$registrarName', '$registrarUsername', '$registrarPassword')";
        $addToRegistrarsResult = mysqli_query($db, $addToRegistrars);

        if ($addToRegistrarsResult) {
          array_push($success, "Successfully added $registrarName to Database.");
        }
      }

    }

    // Add Proctor
    if (isset($_POST['addProctor'])) {
      // Get input and modify input
      $lastName = $_POST['lastName'];
      $firstName = $_POST['firstName'];
      $middleName = $_POST['middleName'];
      $initials = mb_substr($firstName, 0, 1). mb_substr($middleName, 0, 1). mb_substr($lastName, 0, 1);

      $checkDuplicate = "SELECT * FROM tbl_proctors WHERE last_name='$lastName' AND first_name='$firstName' AND middle_name='$middleName'";
      $checkDuplicateResult = mysqli_query($db, $checkDuplicate);
      $duplicateCount = mysqli_num_rows($checkDuplicateResult);

      if ($duplicateCount > 0) {
        array_push($error, "Proctor ". $firstName . " " . $lastName ." is already in Database - Proctors.");
      } else {
        // Add input to database
        $addToProctors = "INSERT INTO tbl_proctors (first_name, middle_name, last_name, initials) VALUES ('$firstName', '$middleName', '$lastName', '$initials')";
        $addToProctorssResult = mysqli_query($db, $addToProctors);

        if ($addToProctorssResult) {
          array_push($success, "Successfully added ". $firstName . " " . $lastName ." to Database - Proctors.");
        }
      }
    }

    // Add Student
    if (isset($_POST['addStudent'])) {
      // Get input and modify input
      $studentID = $_POST['studentID'];
      //$course = $_POST['course'];
      $section = $_POST['section'];
      $lastName = $_POST['lastName'];
      $firstName = $_POST['firstName'];
      $middleName = $_POST['middleName'];
      $password = $_POST['password'];
      $prelim = $_POST['prelim'];
      $midterm = $_POST['midterm'];
      $prefinal = $_POST['prefinal'];
      $final = $_POST['final'];

      $checkDuplicate = "SELECT student_id FROM tbl_students WHERE student_id='$studentID'";
      $checkDuplicateResult = mysqli_query($db, $checkDuplicate);
      $duplicateCount = mysqli_num_rows($checkDuplicateResult);

      if ($duplicateCount > 0) {
        array_push($error, "Student ". $studentID ." is already in Database - Students.");
      } else {
        // Get course from the section of the student
        $getCourseFromSections = mysqli_query($db, "SELECT course FROM tbl_sections WHERE section = '$section'");
        $getCourseFromSectionsResult = mysqli_fetch_array($getCourseFromSections);
        $getCourseFromSectionsResultA = $getCourseFromSectionsResult['course'];

        // Convert the acronym of the course into a full course description
        $getCourseDescFromCourses = mysqli_query($db, "SELECT course_description FROM tbl_courses WHERE course_code = '$getCourseFromSectionsResultA'");
        $getCourseDescFromCoursesResult = mysqli_fetch_array($getCourseDescFromCourses);
        $course = $getCourseDescFromCoursesResult['course_description'];

        // Add input to database
        $addToStudents = "INSERT INTO tbl_students (student_id, first_name, middle_name, last_name, course, section, password, p_prelim, p_midterm, p_prefinal, p_final) VALUES ('$studentID', '$firstName', '$middleName', '$lastName', '$course', '$section', '$password', '$prelim', '$midterm', '$prefinal', '$final')";
        $addToStudentsResult = mysqli_query($db, $addToStudents);

        if ($addToStudentsResult) {

          $getSubjects = "SELECT * FROM tbl_subjects WHERE FIND_IN_SET('$section',section)";
          $getSubjectsResult = mysqli_query($db, $getSubjects);

          while($row = mysqli_fetch_array($getSubjectsResult)) {
            $subjectID = $row['subject_id'];
            $subjectDescription = $row['subject_description'];

            // Insert the student ID, subject ID and subject description into the tbl_permits table
            $createPermit = "INSERT INTO tbl_permits (student_id, subject_id, section) VALUES ('$studentID', '$subjectID', '$section')";
            $createPermitResult = mysqli_query($db, $createPermit);

            mysqli_query($db, 
              "UPDATE tbl_permits t1
              JOIN tbl_permits t2
              ON t2.section = '$section' AND t1.student_id = '$studentID' AND t1.subject_id = t2.subject_id
              SET t1.pt_prelim = t2.pt_prelim,
                  t1.pt_midterm = t2.pt_midterm,
                  t1.pt_prefinal = t2.pt_prefinal,
                  t1.pt_final = t2.pt_final");
            
          }
          array_push($success, "Successfully added student ". $studentID ." to Database - Students.");
        }
      }
    }

    // Add Course
    if (isset($_POST['addCourse'])) {
      // Get input and modify input
      $courseCode = $_POST['courseCode'];
      $courseDescription = $_POST['courseDescription'];

      $checkDuplicate = "SELECT * FROM tbl_courses WHERE course_code='$courseCode' AND course_description='$courseDescription'";
      $checkDuplicateResult = mysqli_query($db, $checkDuplicate);
      $duplicateCount = mysqli_num_rows($checkDuplicateResult);

      if ($duplicateCount > 0) {
        array_push($error, "Course ". $courseDescription ." is already in Database - Courses.");
      } else {
        // Add input to database
        $addToCourses = "INSERT INTO tbl_courses (course_code, course_description) VALUES ('$courseCode', '$courseDescription')";
        $addToCoursesResult = mysqli_query($db, $addToCourses);

        if ($addToCoursesResult) {
          array_push($success, "Successfully added ". $courseDescription ." to Database - Courses.");
        }
      }
    }

    // Add Section
    if (isset($_POST['addSection'])) {
      // Get input and modify input
      $course = $_POST['course'];
      $sectionNumber = $_POST['sectionNumber'];
      $section = $_POST['course'].$_POST['sectionNumber'];

      $checkDuplicate = "SELECT section FROM tbl_sections WHERE section='$section'";
      $checkDuplicateResult = mysqli_query($db, $checkDuplicate);
      $duplicateCount = mysqli_num_rows($checkDuplicateResult);

      if ($duplicateCount > 0) {
        array_push($error, "Section ". $section ." is already in Database - Sections.");
      } else {
        // Add input to database
        $addToSections = "INSERT INTO tbl_sections (course, section_num, section) VALUES ('$course', '$sectionNumber', '$section')";
        $addToSectionsResult = mysqli_query($db, $addToSections);

        if ($addToSectionsResult) {
          array_push($success, "Successfully added ". $section ." to Database - Sections.");
        }
      }
    }

    // Add Subject
    if (isset($_POST['addSubject'])) {
      // Get input and modify input
      $subjectCode = $_POST['subjectCode'];
      $subjectDescription = $_POST['subjectDescription'];
      $section = implode(',', $_POST['section']);

      $checkDuplicate = "SELECT * FROM tbl_subjects WHERE subject_code='$subjectCode'";
      $checkDuplicateResult = mysqli_query($db, $checkDuplicate);
      $duplicateCount = mysqli_num_rows($checkDuplicateResult);

      if ($duplicateCount > 0) {
        array_push($error, "Subject ". $subjectCode ." is already in Database - Subjects.");
      } else {
        // Add input to database
        $addToSubjects = "INSERT INTO tbl_subjects (subject_code, subject_description, section) VALUES ('$subjectCode', '$subjectDescription', '$section')";
        $addToSubjectsResult = mysqli_query($db, $addToSubjects);

        if ($addToSubjectsResult) {

          // Get the added subject
          $getThatSubject = "SELECT subject_id FROM tbl_subjects WHERE subject_code='$subjectCode'";
          $getThatSubjectResult = mysqli_query($db, $getThatSubject);

          while($row = mysqli_fetch_array($getThatSubjectResult)) {

            $subject_id = $row['subject_id'];

            $sections = explode(',', $section);
            foreach($sections as $s) {
                $getStudentID = "SELECT student_id FROM tbl_students WHERE FIND_IN_SET('$s', section)";
                $getStudentIDResult = mysqli_query($db, $getStudentID);
                while($student_row = mysqli_fetch_array($getStudentIDResult)) {
                  $student_id = $student_row['student_id'];
                  $addToPermit = "INSERT INTO tbl_permits (subject_id, student_id, section) VALUES ('$subject_id', '$student_id', '$s')";
                  $addToPermitResult = mysqli_query($db, $addToPermit);
                }
            }
          } 

          // QR Code Generator          
          $subjectID = mysqli_query($db, "SELECT subject_id FROM tbl_subjects WHERE subject_description = '$subjectDescription'");
          $row = mysqli_fetch_array($subjectID);
          $subjectIdResult = $row['subject_id'];
      
          $path = "qrcodes/";
      
          $fileName = $subjectDescription.'_'.$subjectIdResult.'.png'; // ERROR
          
          $pngAbsoluteFilePath = $path.$fileName;
          $urlRelativeFilePath = $path.$fileName;
          $generatedImage = '<img src="'.$urlRelativeFilePath.'" />';
      
          // generating
          if (!file_exists($pngAbsoluteFilePath)) {
            //UPDATE QUERY DATABASE

              QRcode::png($subjectIdResult, $pngAbsoluteFilePath);

              mysqli_query($db, "UPDATE tbl_subjects SET qr_code='$generatedImage' WHERE subject_id = '$subjectIdResult'");
          } else {
              // mysqli_query($db, "UPDATE tbl_subjects SET qr_code='$generatedImage' WHERE subject_id = '$subjectIdResult'");
              array_push($error, "QR Code for ".$subjectDescription."_".$subjectIdResult." already exist. Existing QR Code applied.");
          }
          array_push($success, "Successfully added ". $subjectDescription ." to Database - Subjects.");
        }
      }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Batch Uploads

  // Batch Upload Student
  if(isset($_POST['btn_import_Students'])){
    $fileName = $_FILES['import_Students_file']['name'];
    $fileTmpName = $_FILES['import_Students_file']['tmp_name'];
    //Find the file extension
    $fileExtension = pathinfo($fileName,PATHINFO_EXTENSION);
    //Check the extension
    //echo $fileExtension;

    //Allowed extension
    $allowedType = array('csv');
    if (!in_array($fileExtension, $allowedType)) {
      array_push($error, "Invalid File Extension");
    } else {
        //UPLOADING OF CSV FILE
        $handle = fopen($fileTmpName, 'r'); //read mode 'r'
        while (($myData = fgetcsv($handle,255,',')) !== FALSE) {
          $student_id = $myData[0];
          $first_name = $myData[1];
          $middle_name = $myData[2];
          $last_name = $myData[3];
          $course = $myData[4];
          $section = $myData[5];
          $password = $myData[6];
          $p_prelim = $myData[7];
          $p_midterm = $myData[8];
          $p_prefinal = $myData[9];
          $p_final = $myData[10];

          $insertStudents = "INSERT INTO tbl_students (student_id, first_name, middle_name, last_name, course, section, password, p_prelim, p_midterm, p_prefinal, p_final) VALUES ('$student_id','$first_name','$middle_name','$last_name','$course','$section','$password','$p_prelim','$p_midterm','$p_prefinal','$p_final') ";
          $runStudent = mysqli_query($db, $insertStudents);

          // Add Student Permit after INSERT of Students
          if ($runStudent) {
            $getSubjects = mysqli_query($db, "SELECT * FROM tbl_subjects WHERE section='$section'");

            while($row = mysqli_fetch_array($getSubjects)) {
              $subject = $row['subject_id'];
              $createPermit = "INSERT INTO tbl_permits (student_id, subject_id, section) VALUES ('$student_id', '$subject', '$section')";
              $createPermitResult = mysqli_query($db, $createPermit);
            }
          }
            //FOR DUPLICATE ENTRY ERROR
            // if (isset($_POST['import_excel'])) {
            //   if (null !== ($_POST['$student_id'] == $_POST['$studentsResults']) ) {
            //     mysqli_query($db, "UPDATE tbl_students SET student_id='$student_id', first_name='$first_name', middle_name='$middle_name', last_name='$last_name', course='$course', section='$section', password='$password' WHERE student_id=$student_id");
            //   }
            // }
            //FOR DUPLICATE ENTRY ERROR
        }
        if (!$runStudent) {
          die("Error in uploading file".mysql_error());
        } 
        else { 
          array_push($success, "File Uploaded Successfully");
        }
      }
  }

  // Batch Upload Proctors
  if(isset($_POST['btn_import_Proctors'])){
    $fileName = $_FILES['import_Proctors_file']['name'];
    $fileTmpName = $_FILES['import_Proctors_file']['tmp_name'];
    //Find the file extension
    $fileExtension = pathinfo($fileName,PATHINFO_EXTENSION);
    //Check the extension
    //echo $fileExtension;

    //Allowed extension
    $allowedType = array('csv');
    if (!in_array($fileExtension, $allowedType)) {
      array_push($error, "Invalid File Extension");
    } else {
        //UPLOADING OF CSV FILE
        $handle = fopen($fileTmpName, 'r'); //read mode 'r'
        while (($myData = fgetcsv($handle,255,',')) !== FALSE) {
          $proctor_id = '';
          $first_name = $myData[0];
          $middle_name = $myData[1];
          $last_name = $myData[2];
          $initials = mb_substr($first_name, 0, 1). mb_substr($middle_name, 0, 1). mb_substr($last_name, 0, 1);

          $insertProctors = "INSERT INTO tbl_proctors VALUES ('$proctor_id','$first_name','$middle_name','$last_name','$initials') ";
          $runProctor = mysqli_query($db, $insertProctors);
        }
        if (!$runProctor) {
          die("Error in uploading file".mysql_error());
        } 
        else { 
          array_push($success, "File Uploaded Successfully");
        }
      }
  }

  // Batch Upload Sections
  if(isset($_POST['btn_import_Section'])){
    $fileName = $_FILES['import_Sections_file']['name'];
    $fileTmpName = $_FILES['import_Sections_file']['tmp_name'];
    //Find the file extension
    $fileExtension = pathinfo($fileName,PATHINFO_EXTENSION);
    //Check the extension
    //echo $fileExtension;

    //Allowed extension
    $allowedType = array('csv');
    if (!in_array($fileExtension, $allowedType)) {
      array_push($error, "Invalid File Extension");
    } else {
        //UPLOADING OF CSV FILE
        $handle = fopen($fileTmpName, 'r'); //read mode 'r'
        while (($myData = fgetcsv($handle,255,',')) !== FALSE) {
          $section_id = '';
          $course = $myData[0];
          $section_num = $myData[1];
          $section = $course.$section_num;

          $insertSections = "INSERT INTO tbl_sections VALUES ('$section_id','$course','$section_num','$section') ";
          $runSection = mysqli_query($db, $insertSections);
        }
        if (!$runSection) {
          die("Error in uploading file".mysql_error());
        } 
        else { 
          array_push($success, "File Uploaded Successfully");
        }
      }
  }

  // Batch Upload Subjects
  if(isset($_POST['btn_import_Subject'])){
    $fileName = $_FILES['import_Subjects_file']['name'];
    $fileTmpName = $_FILES['import_Subjects_file']['tmp_name'];
    //Find the file extension
    $fileExtension = pathinfo($fileName,PATHINFO_EXTENSION);
    //Check the extension
    //echo $fileExtension;

    //Allowed extension
    $allowedType = array('csv');
    if (!in_array($fileExtension, $allowedType)) {
      array_push($error, "Invalid File Extension");
    } else {
        //UPLOADING OF CSV FILE
        $handle = fopen($fileTmpName, 'r'); //read mode 'r'
        while (($myData = fgetcsv($handle,255,',')) !== FALSE) {
          $subject_id = '';
          $subject_code = $myData[0];
          $subject_description = $myData[1];
          $section = $myData[2];
          $qr = '';

          $insertSubjects = "INSERT INTO tbl_subjects VALUES ('$subject_id','$subject_code','$subject_description','$section','$qr') ";
          $runSubject = mysqli_query($db, $insertSubjects);

          if ($runSubject) {

            // Get the added subject
            $getThatSubject = "SELECT subject_id FROM tbl_subjects WHERE subject_code='$subject_code'";
            $getThatSubjectResult = mysqli_query($db, $getThatSubject);

            while($row = mysqli_fetch_array($getThatSubjectResult)) {

              $subject_id = $row['subject_id'];

              $sections = explode(',', $section);
              foreach($sections as $s) {
                $getStudentID = "SELECT student_id FROM tbl_students WHERE FIND_IN_SET('$s', section)";
                $getStudentIDResult = mysqli_query($db, $getStudentID);
                while($student_row = mysqli_fetch_array($getStudentIDResult)) {
                  $student_id = $student_row['student_id'];
                  $addToPermit = "INSERT INTO tbl_permits (subject_id, student_id, section) VALUES ('$subject_id', '$student_id', '$s')";
                  $addToPermitResult = mysqli_query($db, $addToPermit);
                }
              }
            } 

            // GENERATE QR AFTER INSERTING SUBJECT
            $subjectID = mysqli_query($db, "SELECT subject_id FROM tbl_subjects WHERE subject_description = '$subject_description'");
            $row = mysqli_fetch_array($subjectID);
            $subjectIdResult = $row['subject_id'];
    
            $path = "qrcodes/";
    
            $fileName = $subject_description.'_'.$subjectIdResult.'.png'; // ERROR
        
            $pngAbsoluteFilePath = $path.$fileName;
            $urlRelativeFilePath = $path.$fileName;
            $generatedImage = '<img src="'.$urlRelativeFilePath.'" />';
    
            // generating
            if (!file_exists($pngAbsoluteFilePath)) {
              //UPDATE QUERY DATABASE

              QRcode::png($subjectIdResult, $pngAbsoluteFilePath);

              mysqli_query($db, "UPDATE tbl_subjects SET qr_code='$generatedImage' WHERE subject_id = '$subjectIdResult'");
            } else {
                array_push($error, "QR Code for ".$subject_description."_".$subjectIdResult." already exist.");
            }
            header('location: maintenanceSubject.php');
          }
        }
        if (!$runSubject) {
          die("Error in uploading file".mysql_error());
        } 
        else { 
          array_push($success, "File Uploaded Successfully");
        }
      }
  }
?>