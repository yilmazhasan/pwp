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
		$result = $conn->query("SELECT * FROM facultyMembers WHERE id=$id") or die($conn->error());
		$row = $result->fetch_assoc();
		if($row){
			// get data from db
			$code = $row['code'];
			$name = $row['name'];
			$lastname = $row['lastname'];
			$email = $row['email'];
			$startDate = $row['startDate'];
			renderForm($id, $code, $name, $lastname, $email, $startDate, "", "", "", "", "", ''); // show form
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
	$code = test_input($_POST['code']);
	$name = test_input($_POST['name']);
	$lastname = test_input($_POST['lastname']);
	$email = test_input($_POST['email']);
	$startDate = test_input($_POST['startDate']);

	$isReadyForDb = testCode($code, $codeErr) && testName($name, $nameErr) 
					&& testName($lastname, $lastnameErr) && testEmail($email, $emailErr)
					&& testDateYYYYMMDD($startDate, $startDateErr);

	if($isReadyForDb){
		// save the data to the database
		$line = "UPDATE facultyMembers SET code ='$code', name ='$name', lastname = 'lastname', 
				email = '$email', startDate = '$startDate' WHERE id='$id';";

		if($conn->query($line)){
			header("Location: view.php");
		}
		else{
			$error = $conn->error;
			renderForm($id, $code, $name, $lastname, $email, $startDate, $codeErr, $nameErr, $lastnameErr, $emailErr, $startDateErr, $error);
		}
	}
	else{
		//error, display form again
		renderForm($id, $code, $name, $lastname, $email, $startDate, $codeErr, $nameErr, $lastnameErr, $emailErr, $startDateErr, $error);
	}
}

?>
