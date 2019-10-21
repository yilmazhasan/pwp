<?php

// creates the new record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($code, $name, $lastname, $email, $startDate, $codeErr, $nameErr, $lastnameErr, $emailErr, $startDateErr)
{

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
<title>New Faculty Member</title>
</head>

<body>

<h2>Add faculty member</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
      <td>Lastname <td>
      <td><input type="text" name="lastname" value="<?php echo $lastname;?>"> <td>
      <td><span class="error"><?php echo $lastnameErr;?></span> <td>
  <tr>
  <tr> 
      <td>Email <td>
      <td><input type="email" name="email" value="<?php echo $email;?>"> <td>
      <td><span class="error"><?php echo $emailErr;?></span> <td>
  <tr>
  <tr> 
      <td>Startdate <td>
      <td><input type="date" name="startDate" value="<?php echo $startDate;?>"> <td>
      <td><span class="error"><?php echo $startDateErr;?></span> <td>
  <tr>
  <tr> 
      <td> <td>
      <td>  <input type="submit" name="save" value="Save"> <td>

  <tr>
  </table>
</form>

</body>
</html>

<?php
}
// connect to the database
include('../connectDb.php');
$saveable = false;

// check if the form has been submitted. If it has, start to process the form and save it to the database
if (isset($_POST['save']))//|| $_SERVER["REQUEST_METHOD"] == "POST")
{
  $saveable = true;

  if($saveable){
    if (!empty($_POST["code"])) {
      $code = mysqli_real_escape_string(htmlspecialchars($_POST['code']));
      // check if name only contains letters and whitespace
      if (!preg_match("/^[0-9]*$/",$code)) {
        $codeErr = "Only numbers allowed"; 
        $saveable = false;
      }
    }else {
        $codeErr = "CODE is required";
        $saveable = false;
      }
  }
//700 50 50 70 15 = 885/3=295 + 35 = 330
  if($saveable){
    if(!empty($_POST["name"])) {
      $name = mysqli_real_escape_string(htmlspecialchars($_POST['name']));
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z]*$/",$name)) {
        $nameErr = "Only characters allowed"; 
        $saveable = false;
      }
    }else {
        $nameErr = "Name is required";
        $saveable = false;
      }
  }

  if($saveable){
    if (!empty($_POST["surname"])) {
      $lastname = mysqli_real_escape_string(htmlspecialchars($_POST['lastname']));
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z]*$/",$lastname)) {
        $lastnameErr = "Only characters allowed"; 
        $saveable = false;
      }
    }else {
        $lastnameErr = "Lastname is required";
        $saveable = false;
      }
  }

  if($saveable){
    if (!empty($_POST["email"])) {
      $email = mysqli_real_escape_string(htmlspecialchars($_POST['email']));
      // check if name only contains letters and whitespace
  //  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  //    $emailErr = "Invalid email format"; }
      if (!preg_match("/^[a-z0-9._%+-]{5,20}@[a-z]{5,7}.com$/",$email)) {
        $emailErr = "enter a valid address"; 
        $saveable = false;
      }
    }else {
        $emailErr = "Email is required";
        $saveable = false;
      }
  } 

  if($saveable){
        echo 'submitted and saveable';

    // save the data to the database

//    $conn->query("INSERT players SET firstname='$firstname', lastname='$lastname';")

//    or die(mysql_error());

    // once saved, redirect back to the view page

    header("Location: view.php");
  }
  else{
    // if either field is blank, display the form again
    echo 'ssubmitted but erroneous';
    renderForm($code, $name, $lastname, $email, $startDate, $codeErr, $nameErr, $lastnameErr, $emailErr, $startDateErr);

  }
}
else
// if the form hasn't been submitted, display the form
{
  renderForm('','','','','yyyymmdd','','','','','');
}

?>