<?php

// creates the edit record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable

function renderForm($id, $code, $name, $surname, $email, $startDate, $error)
{

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">


<html>

<head>

<title>Edit faculty member</title>

</head>

<body>

<?php

// if there are any errors, display them

if ($error != '')
{
	echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
}

?>
<h2>Edit faculty member info</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    
	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
	<div>
	<p><strong>ID:</strong> <?php echo $id; ?></p>

  <table>
  <tr> 
      <td>Code <td>
      <td><input type="text" name="code" value="<?php echo $code;?>"> <td>
      <td><span class="error"> <?php echo $codeErr;?></span><td>
  <tr>
  <tr> 
      <td>Name <td>
      <td><input type="text" name="name" value="<?php echo $name;?>"> <td>
      <td><span class="error"><?php echo $nameErr;?></span> <td>
  <tr>
  <tr> 
      <td>Surname <td>
      <td><input type="text" name="surname" value="<?php echo $surname;?>"> <td>
      <td><span class="error"><?php echo $surnameErr;?></span> <td>
  <tr>
  <tr> 
      <td>Email <td>
      <td><input type="text" name="email" value="<?php echo $email;?>"> <td>
      <td><span class="error"><?php echo $emailErr;?></span> <td>
  <tr>
  <tr> 
      <td>Start date <td>
      <td><input type="text" name="startDate" value="<?php echo $startDate;?>"> <td>
      <td><span class="error"><?php echo $startDateErr;?></span> <td>
  <tr>
  <tr> 
      <td> <td>
      <td>  <input type="submit" name="submit" value="Save"/> 
      		<a style = "text-decoration:none" href="view.php"> <input type="button" name="cancel" value="Cancel"/> </a><td>

  <tr>
  </table>
</form>

</body>
</html>

<?php
}

// connect to the database
include('../connectDb.php');

// check if the form has been submitted. If it has, process the form and save it to the database
if (isset($_POST['submit']))
{
	// confirm that the 'id' value is a valid integer before getting the form data
	if (is_numeric($_POST['id']))
	{
		// get form data, making sure it is valid
		$id = $_POST['id'];
		$code = $_POST['code'];
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];
		$startDate = $_POST['startDate'];



		if ($code == '' || $name == '' || $mandatory == '' || $day == '' || $hourFrom == '' || $hourTo == '')
		{
			// generate error message
			$error = 'ERROR: Please fill in all required fields!';

			//error, display form
			renderForm($id, $code, $name, $mandatory, $day, $hourFrom, $hourTo, $error);
		}
		else
		{
			// save the data to the database
			$line = "UPDATE COURSES SET CODE ='$code', NAME ='$name', DAY = '$day', ISMANDATORY = '$mandatory', HOURFROM = '$hourFrom', HOURTO = '$hourTo' WHERE ID='$id';";
			if(!$conn->query($line))
			{
				$error = $conn->error;
				renderForm($id, $code, $name, $mandatory, $day, $hourFrom, $hourTo, $error);
			}
			else
			header("Location: view.php");
		}

	}
	else
	{
		// if the 'id' isn't valid, display an error
		echo 'Error1!';
	}

}
else
// if the form hasn't been submitted, get the data from the db and display the form
{
	// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
	if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
	{
		// query db
		$id = $_GET['id'];
		$result = $conn->query("SELECT * FROM COURSES WHERE ID=$id") or die($conn->error());
		$row = $result->fetch_assoc();
		// check that the 'id' matches up with a row in the databse
		if($row)
		{
			// get data from db
			$code = $row['CODE'];
			$name = $row['NAME'];
			$mandatory = $row['ISMANDATORY'];
			$day = $row['DAY'];
			$hourFrom = $row['HOURFROM'];
			$hourTo = $row['HOURTO'];

			// show form
			renderForm($id, $code, $name, $mandatory, $day, $hourFrom, $hourTo, '');
		}
		else
		// if no match, display result
		{

			echo "No results!";

		}
	}
	else
	// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
	{
		echo 'Error2!';
	}
}
?>