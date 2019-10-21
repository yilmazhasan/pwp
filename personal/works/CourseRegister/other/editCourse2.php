<!DOCTYPE HTML>  

<html>

<head>

</head>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$idErr = $codeErr = $nameErr = $mandatoryErr = $dayErr = $hourErr = "";
$id = $code = $name = $mandatory = $day= $hourFrom = $hourTo = "";
$saveable = false;

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $saveable = true;

  if (empty($_POST["id"])) {
    $idErr = "ID is required";
    $saveable = false;
  } else {
      $id = test_input($_POST["id"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[0-9]*$/",$id)) {
        $idErr = "Only numbers allowed"; 
        $saveable = false;
      }
    }

  if (empty($_POST["code"])) {
    $codeErr = "Code is required";
    $saveable = false;
  } else {
      $code = test_input($_POST["code"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[0-9]*$/",$code)) {
        $codeErr = "Only numbers allowed"; 
        $saveable = false;
      }
    }

  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
    $saveable = false;
  } else {
      $name = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z]*$/",$name)) {
        $nameErr = "Only characters allowed"; 
        $saveable = false;
      }
    }

  if(empty($_POST["mandatory"]))
  {
    $mandatoryErr = "Select one.";
    $saveable = false;
  }
  else
  {
   // $mandatory = $_POST["mandatory"] == "true" ? true : false;    //not working
    $mandatory = $_POST["mandatory"];    

  }

  $day = $_POST["day"];    

  if (empty($_POST["hourFrom"]) || empty($_POST["hourTo"])){
    $saveable = false;
    $hourErr = "Hour is required";
  } else {
      $hourFrom = test_input($_POST["hourFrom"]);
      $hourTo = test_input($_POST["hourTo"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/",$hourFrom) || !preg_match("/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/",$hourTo)) {
        $hourErr = "Only numbers allowed, format hh:mm"; 
        $saveable = false;
      }
    }
}



  
 /*
 if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }

}
*/

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Add course</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <table>
  <tr> 
      <td>ID <td>
      <td><input type="text" name="id" value="<?php echo $id;?>"> <td>
      <td><span class="error"> <?php echo $idErr;?></span> <td>
  <tr>
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
      <td>Mandatory <td>
      <td><input type="radio" name="mandatory" <?php if (isset($mandatory) && $mandatory=="true") echo "checked";?> value="true"> Yes 
        <input type="radio" name="mandatory" <?php if (isset($mandatory) && $mandatory=="false") echo "checked";?> value="false"> No <td>
      <td><span class="error"><?php echo $mandatoryErr;?></span> <td>  <tr>
  <tr> 
      <td>Day <td>
      <td>
        <select name = "day" class="selectpicker show-tick">
        <option value="1">Sunday</option>
        <option value="2">Monday</option>
        <option value="3">Tuesday</option>
        <option value="4">Wednesday</option>
        <option value="5">Thursday</option>
        <option value="6">Friday</option>
        <option value="7">Saturday</option>
        </select>
      <td>
  <tr>
  <tr> 
      <td>Hour (hh:mm) <td>
      <td> <input type="text" name="hourFrom" value="<?php echo $hourFrom;?>" size="7"> to
          <input type="text" name="hourTo" value="<?php echo $hourTo;?>" size="7"><td>
      <td><span class="error"> <?php echo $hourErr;?></span> <td>
  <tr>
  <tr> 
      <td> <td>
      <td>  <input type="submit" name="save" value="Save"> <td>

  <tr>
  </table>
</form>

<?php

  if($saveable)
  {
//    $mandatory = $mandatory == "true" ? true : false;  //selecting false value in form not working
//    $mandatoryBool = $mandatory == "true" ? true : false;  //selecting false value in form not working
    $mandatory = $mandatory == "true" ? 1 : 0;  //when writed true and false instead 1 and 0, false value in form not working
    $line = "INSERT INTO COURSES VALUES( '"
          . $id . "', '" . $code . "', '" . $name . "', '" . $mandatory
          . "', '" . $day . "', '" . $hourFrom . "', '" . $hourTo . "');";


  $conn = $GLOBALS['dbConnection']; // not working
  if(!$conn)
  {
    $conn = new mysqli('localhost', 'root', '12345'); // Create connection
    //$db = mysql_select_db('COURSEREGISTRATION', $conn);
    $conn->query("USE COURSEREGISTRATION"); // Select database
  }  


if ($conn->query($line) == TRUE) {
    echo "Successful.";
} else {
    echo "Error: " . $line . "<br>" . $conn->error;
    die();
  }

    echo "<h3>Course saved:</h3>";
    echo $id . " ";
    echo $code . " ";
    echo $name . " ";
    if($mandatory == true)
      echo "mandatory ";
    else
      echo "selective ";     
    echo $day . ".day: ";
    echo $hourFrom . " to ";
    echo $hourTo . " ";
  }
?>

</body>
</html>
