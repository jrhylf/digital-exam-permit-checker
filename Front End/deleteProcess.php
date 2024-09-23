<?php 
	
	// Database Connection
	$db = mysqli_connect('localhost','root','','db_sepc');

	// Variables
	$id; // ID

	// Delete Registrar
	if (isset($_GET['delPromissorySubmittion'])) {
		
		$id = $_GET['delPromissorySubmittion'];
		mysqli_query($db, "DELETE FROM tbl_promissory WHERE promissory_id=$id");
		header('location: promissoryNote_status.php');
	}

?>