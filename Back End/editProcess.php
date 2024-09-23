<?php 

	$db = mysqli_connect('localhost','root','','db_sepc');

	$success = array();
	$error = array();

	if (isset($_POST['setSY'])) {
		$from = $_POST['From'];
		$to = $_POST['To'];
		$sy = $from. "-" . $to;

		mysqli_query($db, "UPDATE tbl_qs SET year='$sy'");
		array_push($success, "Successfully updated school year.");
	}

	if (isset($_POST['setSem'])) {
		$sem = $_POST['sem'];

		mysqli_query($db, "UPDATE tbl_qs SET semester='$sem'");
		array_push($success, "Successfully updated semester.");
	}

	if (isset($_POST['setQuarter'])) {
		$quarter = $_POST['quarter'];

		mysqli_query($db, "UPDATE tbl_qs SET quarter='$quarter'");
		array_push($success, "Successfully updated quarter.");
	}

	if (isset($_POST['editRegistrar'])) {
		
		$rid = $_POST['rid'];
		$registrar_name = $_POST['registrar_name'];
		$registrar_username = $_POST['registrar_username'];
		$registrar_password = $_POST['registrar_password'];

	    mysqli_query($db, "UPDATE tbl_registrar SET registrar_name='$registrar_name', registrar_username='$registrar_username', registrar_password='$registrar_password' WHERE registrar_id=$rid");
		header('location: maintenanceRegistrar.php');
	}

	if (isset($_POST['editProctor'])) {
		
		$id = $_POST['id'];
		$lastName = $_POST['lastName'];
	    $firstName = $_POST['firstName'];
	    $middleName = $_POST['middleName'];
      	$initials = mb_substr($firstName, 0, 1). mb_substr($middleName, 0, 1). mb_substr($lastName, 0, 1);

		mysqli_query($db, "UPDATE tbl_proctors SET last_name='$lastName', first_name='$firstName', middle_name='$middleName', initials='$initials' WHERE proctor_id=$id");
		header('location: maintenanceProctor.php');
	}

	if (isset($_POST['editStudent'])) {
		
		$studentID = $_POST['studentID'];
		$course = $_POST['course'];
		$section = $_POST['section'];
	    $lastName = $_POST['lastName'];
	    $firstName = $_POST['firstName'];
	    $middleName = $_POST['middleName'];
	    $password = $_POST['password'];
	    $prelim = $_POST['prelim'];
	    $midterm = $_POST['midterm'];
	    $prefinal = $_POST['prefinal'];
	    $final = $_POST['final'];

	    // Update Student Information
		mysqli_query($db, "UPDATE tbl_students SET course = '$course', section = '$section', first_name='$firstName', middle_name='$middleName', last_name='$lastName', password='$password', p_prelim='$prelim', p_midterm='$midterm', p_prefinal='$prefinal', p_final='$final'  WHERE student_id=$studentID");

		// Delete Student Permit to create an updated
		mysqli_query($db, "DELETE FROM tbl_permits WHERE student_id=$studentID");

		// Get the subjects for the student based on their section
		$getSubjects = "SELECT * FROM tbl_subjects WHERE FIND_IN_SET('$section',section)";
        $getSubjectsResult = mysqli_query($db, $getSubjects);

        while($row = mysqli_fetch_array($getSubjectsResult)) {
            $subjectID = $row['subject_id'];
            //$subjectDescription = $row['subject_description'];

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
		header('location: maintenanceStudent.php');
	}

	if (isset($_POST['editCourse'])) {
		
		$id = $_POST['id'];
		$courseCode = $_POST['courseCode'];
      	$courseDescription = $_POST['courseDescription'];

		mysqli_query($db, "UPDATE tbl_courses SET course_code='$courseCode', course_description='$courseDescription' WHERE course_id=$id");
		header('location: maintenanceCourse.php');
	}

	if (isset($_POST['editSection'])) {
		
		$id = $_POST['id'];
		$course = $_POST['course'];
      	$sectionNumber = $_POST['sectionNumber'];
      	$section = $_POST['course'].$_POST['sectionNumber'];

		mysqli_query($db, "UPDATE tbl_sections SET course='$course', section_num='$sectionNumber', section='$section' WHERE section_id=$id");
		header('location: maintenanceSection.php');
	}

	if (isset($_POST['editSubject'])) {
		
		$id = $_POST['id'];
		$subjectCode = $_POST['subjectCode'];
      	$subjectDescription = $_POST['subjectDescription'];
      	$section = implode(',', $_POST['section']);

		include('phpqrcode/qrlib.php');
    
    	$path = "qrcodes/";
    
    	$fileName = $subjectDescription.'_'.$id.'.png';
    
    	$pngAbsoluteFilePath = $path.$fileName;
    	$urlRelativeFilePath = $path.$fileName;
    	$generatedImage = '<img src="'.$urlRelativeFilePath.'" />';
    
    	// generating
    	if (!file_exists($pngAbsoluteFilePath)) {
    	    QRcode::png($id, $pngAbsoluteFilePath);
    	    mysqli_query($db, "UPDATE tbl_subjects SET subject_code='$subjectCode', subject_description='$subjectDescription', section='$section', qr_code='$generatedImage' WHERE subject_id = '$id'");
    	} else {
    	    mysqli_query($db, "UPDATE tbl_subjects SET subject_code='$subjectCode', subject_description='$subjectDescription', section='$section', qr_code='$generatedImage' WHERE subject_id = '$id'");
    	}

		// Delete Subject from Permit to create an updated
		mysqli_query($db, "DELETE FROM tbl_permits WHERE subject_id='$id'");

		$sections = explode(',', $section);
		  foreach($sections as $s) {
		     $getStudentID = "SELECT student_id FROM tbl_students WHERE FIND_IN_SET('$s', section)";
		     $getStudentIDResult = mysqli_query($db, $getStudentID);
		     while($student_row = mysqli_fetch_array($getStudentIDResult)) {
		       $student_id = $student_row['student_id'];
		       $addToPermit = "INSERT INTO tbl_permits (subject_id, student_id, section) VALUES ('$id', '$student_id', '$s')";
		       $addToPermitResult = mysqli_query($db, $addToPermit);
		     }
		  }
		
		header('location: maintenanceSubject.php');
	}

	if (isset($_POST['editSubProctor'])) {
		
		$subject = $_POST['subject'];

		$subjectID = mysqli_query($db, "SELECT subject_id FROM tbl_subjects WHERE subject_description='$subject'");
		$row = mysqli_fetch_array($subjectID);
		$subject_id = $row['subject_id'];

      	$quarter = $_POST['quarter'];
      	$proctor = $_POST['proctor'];

      	if ($quarter == "Prelim") {
      		mysqli_query($db, "UPDATE tbl_permits SET pt_prelim='$proctor' WHERE subject_id='$subject_id'");
      	} else if ($quarter == "Midterm") {
      		mysqli_query($db, "UPDATE tbl_permits SET pt_midterm='$proctor' WHERE subject_id='$subject_id'");
      	} else if ($quarter == "Prefinal") {
      		mysqli_query($db, "UPDATE tbl_permits SET pt_prefinal='$proctor' WHERE subject_id='$subject_id'");
      	} else if ($quarter == "Final") {
      		mysqli_query($db, "UPDATE tbl_permits SET pt_final='$proctor' WHERE subject_id='$subject_id'");
      	}

		array_push($success, "Successfully set ". $proctor . " as a proctor for ". $subject);
	}
	
?>