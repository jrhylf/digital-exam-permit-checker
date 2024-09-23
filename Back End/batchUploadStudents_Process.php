<!-- START OF BATCH UPLOAD FUNCTION -->
<?php include('conn.php'); ?>
<?php $db = mysqli_connect('localhost','root','','db_sepc') or die("Unable to connect to database"); ?>
<?php
	
	$studentSuccess = array();
	$invalidFileExtension = array();

	if(isset($_POST['import_excel'])){
    	$fileName = $_FILES['import_file']['name'];
    	$fileTmpName = $_FILES['import_file']['tmp_name'];
    	//Find the file extension
    	$fileExtension = pathinfo($fileName,PATHINFO_EXTENSION);
    	//Check the extension
    	//echo $fileExtension;

    	//Allowed extension
    	$allowedType = array('csv');
    	if (!in_array($fileExtension, $allowedType)) {
    		array_push($invalidFileExtension, "Invalid File Extension");
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

        		$run = "";

        		$queryInsert = "INSERT INTO tbl_students VALUES ('$student_id','$first_name','$middle_name','$last_name','$course','$section','$password','$p_prelim','$p_midterm','$p_prefinal','$p_final') ";
        		$run = mysqli_query($db, $queryInsert);
				if ($run) {
        			//$getSubjects = mysqli_query($db, "SELECT * FROM tbl_subjects WHERE section='$section'");
        			$getSubjects = "SELECT * FROM tbl_subjects WHERE FIND_IN_SET('$section',section)";
        			$getSubjectsResult = mysqli_query($db, $getSubjects);

    				// while($row = mysqli_fetch_array($getSubjects)) {
    				//   $subject = $row['subject_id'];
    				//   $createPermit = "INSERT INTO tbl_permits (student_id, subject_id) VALUES ('$student_id', '$subject')";
    				//   $createPermitResult = mysqli_query($db, $createPermit);
    				// }

    				while($row = mysqli_fetch_array($getSubjectsResult)) {
			            $subjectID = $row['subject_id'];
			            $subjectDescription = $row['subject_description'];

			            // Insert the student ID, subject ID and subject description into the tbl_permits table
			            $createPermit = "INSERT INTO tbl_permits (student_id, subject_id, section) VALUES ('$student_id', '$subjectID', '$section')";
			            $createPermitResult = mysqli_query($db, $createPermit);

			            mysqli_query($db, 
			              "UPDATE tbl_permits t1
			              JOIN tbl_permits t2
			              ON t2.section = '$section' AND t1.student_id = '$student_id' AND t1.subject_id = t2.subject_id
			              SET t1.pt_prelim = t2.pt_prelim,
			                  t1.pt_midterm = t2.pt_midterm,
			                  t1.pt_prefinal = t2.pt_prefinal,
			                  t1.pt_final = t2.pt_final");
			            
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
        	if (!$run) {
        		die("Error in uploading file".mysql_error());
        	} 
        	else { 
        		array_push($studentSuccess, "File Uploaded Successfully");
        	}
       	}
    }
?> <!-- END OF BATCH UPLOAD FUNCTION -->