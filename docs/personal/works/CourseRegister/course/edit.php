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
		$result = $conn->query("SELECT * FROM courses WHERE id=$id") or die($conn->error());
		$row = $result->fetch_assoc();
		if($row){
			// get data from db
			$code = $row['code'];
			$name = $row['name'];
			$isMandatory = $row['isMandatory'];
			$day = $row['day'];
			$hourFrom = $row['hourFrom'];
			$hourTo = $row['hourTo'];
			renderForm($id, $code, $name, $isMandatory, $day, $hourFrom, $hourTo, "", "", "", "", "", '');	// show form
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
		$isMandatory = $_POST['isMandatory'];
		$day = $_POST['day'];
		$hourFrom = test_input($_POST['hourFrom']);
		$hourTo = test_input($_POST['hourTo']);

	  	$isReadyForDb = testCode($code, $codeErr) && testName($name, $nameErr) && testIsMandatory($isMandatory, $isMandatoryErr)
             		&& testDay($day, $dayErr) && testHour($hourFrom, $hourTo, $hourErr);  

		if($isReadyForDb)
		{
			// save the data to the database
			$line = "UPDATE courses SET code ='$code', name ='$name', day = '$day', 
					isMandatory = '$isMandatory', hourFrom = '$hourFrom', hourTo = '$hourTo' WHERE id='$id';";

			if($conn->query($line)){
				header("Location: view.php");	//Redirect
			}
			else{
				$error = $conn->error;
			}
		}
		//error, display form again with errors
		renderForm($id, $code, $name, $isMandatory, $day, $hourFrom, $hourTo, $codeErr, $nameErr, $isMandatoryErr, $dayErr, $hourErr, '');
	}

?>
