<?php

include('../db/connectDb.php');	// connect to the database
include('../functions.php');	// some helper funvtions
include('./renderForm.php');	// form for save and edit

// check if the form has been submitted. If it has, process the form and save it to the database
if (!isset($_POST['submit'])){
	// if the form hasn't been submitted, get the data from the db and display the form
	// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
	if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
		// check that the 'id' matches up with a row in the databse
		$id = $_GET['id'];
		$result = $conn->query("SELECT * FROM offeredCourses WHERE id=$id") or die($conn->error());
		$row = $result->fetch_assoc();
		if($row){
			// get data from db
			$code = $row['code'];
			$courseCode = $row['courseCode'];
			$facultyMemberCode = $row['facultyMemberCode'];
			$classroomCode = $row['classroomCode'];
			renderForm($id, $code, $courseCode, $facultyMemberCode, $classroomCode, "", "", "", "", ''); // show form
		}
		else{ // if no match, display result
			echo "No such course!";
		}
	}
	else{ // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
		echo 'Error!';
	}
}else{
	// get form data, making sure it is valid
	$id = $_POST['id'];
	$courseCode = test_input($_POST['courseCode']);
	$facultyMemberCode = test_input($_POST['facultyMemberCode']);
	$classroomCode = test_input($_POST['classroomCode']);
	$code = $courseCode . $facultyMemberCode . $classroomCode;

	$isReadyForDb = testCode($courseCode, $courseCodeErr) && testCode($facultyMemberCode, $facultyMemberCodeErr) && testCode($classroomCode, $classroomCodeErr);

	if($isReadyForDb){
		// save the data to the database
		$line = "UPDATE offeredCourses SET code ='$code', courseCode ='$courseCode', facultyMemberCode = '$facultyMemberCode'
				, classroomCode = '$classroomCode' WHERE id='$id';";

		if($conn->query($line)){
			header("Location: view.php");
		}
		else{
			$error = $conn->error;
		}
	}
	//error, display form
	renderForm($id, $code, $courseCode, $facultyMemberCode, $classroomCode, $codeErr, $courseCodeErr, $facultyMemberCodeErr, $classroomErr, $error);
}

?>
