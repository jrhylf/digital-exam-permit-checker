<?php 
	
	// Database Connection
	$db = mysqli_connect('localhost','root','','db_sepc');

	// Variables
	$id; // ID

	// Delete Registrar
	if (isset($_GET['delRegistrar'])) {
		
		$id = $_GET['delRegistrar'];
		mysqli_query($db, "DELETE FROM tbl_registrar WHERE registrar_id=$id");
		header('location: maintenanceRegistrar.php');
	}

	// Delete Proctor
	if (isset($_GET['delProctor'])) {
		
		$id = $_GET['delProctor'];

        // $getProctorInitials = "SELECT initials FROM tbl_proctors WHERE proctor_id='$id'";
        // $getProctorInitialsResult = mysqli_query($db, $getProctorInitials);

		mysqli_query($db, "DELETE FROM tbl_proctors WHERE proctor_id=$id");
        header('location: maintenanceProctor.php');

        // while($row = mysqli_fetch_array($getProctorInitialsResult)) {
        // 	$proctorInitials = $row['initials'];

        // 	$checkPermitProctor_prelim = "SELECT s_prelim FROM tbl_permits WHERE s_prelim='$proctorInitials'";
        // 	$checkPermitProctor_prelimResult = mysqli_query($db, $checkPermitProctor_prelim);
	    //     $proctorSignRows_prelim = mysqli_num_rows($checkPermitProctor_prelimResult);

	    //     $checkPermitProctor_midterm = "SELECT s_midterm FROM tbl_permits WHERE s_midterm='$proctorInitials'";
        // 	$checkPermitProctor_midtermResult = mysqli_query($db, $checkPermitProctor_midterm);
	    //     $proctorSignRows_midterm = mysqli_num_rows($checkPermitProctor_midtermResult);

	    //     $checkPermitProctor_prefinal = "SELECT s_prefinal FROM tbl_permits WHERE s_prefinal='$proctorInitials'";
        // 	$checkPermitProctor_prefinalResult = mysqli_query($db, $checkPermitProctor_prefinal);
	    //     $proctorSignRows_prefinal = mysqli_num_rows($checkPermitProctor_prefinalResult);

	    //     $checkPermitProctor_final = "SELECT s_final FROM tbl_permits WHERE s_final='$proctorInitials'";
        // 	$checkPermitProctor_finalResult = mysqli_query($db, $checkPermitProctor_final);
	    //     $proctorSignRows_final = mysqli_num_rows($checkPermitProctor_finalResult);

	    //     if ($proctorSignRows_prelim > 0 && $proctorSignRows_midterm > 0 && $proctorSignRows_prefinal > 0 && $proctorSignRows_final > 0) {

	    //     	mysqli_query($db, "DELETE FROM tbl_proctors WHERE proctor_id=$id");
	    //     	header('location: maintenanceProctor.php');

	    //     } else if ($proctorSignRows_prelim > 0 && $proctorSignRows_midterm > 0 && $proctorSignRows_prefinal > 0 && $proctorSignRows_final == 0) {
	        	
	    //     	mysqli_query($db, "DELETE FROM tbl_proctors WHERE proctor_id=$id");
	    //     	mysqli_query($db, "UPDATE tbl_permits SET pt_final='' WHERE pt_final='$proctorInitials'");
	        	
	        	
	    //     } else if ($proctorSignRows_prelim > 0 && $proctorSignRows_midterm > 0 && $proctorSignRows_prefinal == 0 && $proctorSignRows_final == 0) {
	        	
	    //     	mysqli_query($db, "DELETE FROM tbl_proctors WHERE proctor_id=$id");
	    //     	mysqli_query($db, "UPDATE tbl_permits SET pt_final='', pt_prefinal='' WHERE pt_final='$proctorInitials' AND pt_prefinal='$proctorInitials'");
	    //     	header('location: maintenanceProctor.php');
	        	
	    //     } else if ($proctorSignRows_prelim == 0 && $proctorSignRows_midterm == 0 && $proctorSignRows_prefinal == 0 && $proctorSignRows_final == 0) {
	        	
	    //     	mysqli_query($db, "DELETE FROM tbl_proctors WHERE proctor_id=$id");
	    //     	mysqli_query($db, "UPDATE tbl_permits SET pt_final='', pt_prefinal='' WHERE pt_final='$proctorInitials' AND pt_prefinal='$proctorInitials'");
	    //     	header('location: maintenanceProctor.php');
	        	
	    //     }
       	// }
	}

	// Delete Student
	if (isset($_GET['delStudent'])) {
		
		$id = $_GET['delStudent'];
		mysqli_query($db, "DELETE FROM tbl_students WHERE student_id=$id");
		mysqli_query($db, "DELETE FROM tbl_permits WHERE student_id=$id");
		mysqli_query($db, "DELETE FROM tbl_promissory WHERE student_id=$id");
		mysqli_query($db, "DELETE FROM tbl_promissorya WHERE student_id=$id");
		header('location: maintenanceStudent.php');
	}

	// Delete Course
	if (isset($_GET['delCourse'])) {
		
		$id = $_GET['delCourse'];
		mysqli_query($db, "DELETE FROM tbl_courses WHERE course_id=$id");
		header('location: maintenanceCourse.php');
	}

	// Delete Section
	if (isset($_GET['delSection'])) {
		
		$id = $_GET['delSection'];
		mysqli_query($db, "DELETE FROM tbl_sections WHERE section_id=$id");
		header('location: maintenanceSection.php');
	}

	// Delete Subject
	if (isset($_GET['delSubject'])) {
		
		$id = $_GET['delSubject'];
		mysqli_query($db, "DELETE FROM tbl_subjects WHERE subject_id=$id");
		mysqli_query($db, "DELETE FROM tbl_permits WHERE subject_id=$id");
		header('location: maintenanceSubject.php');
	}

	// Approve Promisory Note
	if (isset($_GET['approvePromissory'])) {
		
		$id = $_GET['approvePromissory']; // Student ID

		$promissoryResults = mysqli_query($db, "SELECT * FROM tbl_promissory WHERE student_id='$id'");
		$row = mysqli_fetch_array($promissoryResults);
		$promissory_note = $row['promissory_note'];
		$pay_from = $row['pay_from'];
		$pay_to = $row['pay_to'];
		$quarter = $row['quarter'];
	
		$addToPromissoryA = "INSERT INTO tbl_promissorya (student_id, promissory_note, pay_from, pay_to, quarter) VALUES ('$id', '$promissory_note', '$pay_from', '$pay_to', '$quarter')";
      	$addToPromissoryAResult = mysqli_query($db, $addToPromissoryA);

      	if ($quarter == "Prelim") {
      		
      		mysqli_query($db, "UPDATE tbl_students SET p_prelim='p' WHERE student_id='$id'");

      	} else if ($quarter == "Midterm") {

      		mysqli_query($db, "UPDATE tbl_students SET p_midterm='p' WHERE student_id='$id'");

      	} else if ($quarter == "Prefinal") {

      		mysqli_query($db, "UPDATE tbl_students SET p_prefinal='p' WHERE student_id='$id'");

      	} else if ($quarter == "Final") {

      		mysqli_query($db, "UPDATE tbl_students SET p_final='p' WHERE student_id='$id'");

      	} 

		mysqli_query($db, "DELETE FROM tbl_promissory WHERE student_id=$id");
		header('location: promissoryManager.php');
	}

	// Complete Promisory Note
	if (isset($_GET['completePromisory'])) {
		
		$id = $_GET['completePromisory'];

		$promissoryaResults = mysqli_query($db, "SELECT quarter FROM tbl_promissorya WHERE student_id='$id'");
		$row = mysqli_fetch_array($promissoryaResults);
		$quarter = $row['quarter'];

		if ($quarter == "Prelim") {
      		
      		mysqli_query($db, "UPDATE tbl_students SET p_prelim='y' WHERE student_id='$id'");

      	} else if ($quarter == "Midterm") {

      		mysqli_query($db, "UPDATE tbl_students SET p_midterm='y' WHERE student_id='$id'");

      	} else if ($quarter == "Prefinal") {

      		mysqli_query($db, "UPDATE tbl_students SET p_prefinal='y' WHERE student_id='$id'");

      	} else if ($quarter == "Final") {

      		mysqli_query($db, "UPDATE tbl_students SET p_final='y' WHERE student_id='$id'");

      	} 

		mysqli_query($db, "DELETE FROM tbl_promissorya WHERE student_id=$id");
		header('location: promissoryManager.php');
	}

	if (isset($_GET['delAllStudents'])) {
		mysqli_query($db, "TRUNCATE TABLE tbl_students");
		mysqli_query($db, "TRUNCATE TABLE tbl_permits");
		header('location: maintenanceStudent.php');
	}

	if (isset($_GET['delAllProctors'])) {
		mysqli_query($db, "TRUNCATE TABLE tbl_proctors");
		header('location: maintenanceProctor.php');
	}

	if (isset($_GET['delAllSubjects'])) {
		mysqli_query($db, "TRUNCATE TABLE tbl_subjects");
		mysqli_query($db, "TRUNCATE TABLE tbl_permits");
		header('location: maintenanceSubject.php');
	}

	if (isset($_GET['delAllSections'])) {
		mysqli_query($db, "TRUNCATE TABLE tbl_sections");
		mysqli_query($db, "TRUNCATE TABLE tbl_students");
		mysqli_query($db, "TRUNCATE TABLE tbl_permits");
		header('location: maintenanceSection.php');
	}
?>