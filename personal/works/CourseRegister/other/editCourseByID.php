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

include('../db/connectDb.php');

// define variables and set to empty values
$idErr = $id = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["id"])) {
      $idErr = "ID is required";
    } else {
          $id = test_input($_POST["id"]);
        // check if name only contains characters
        if (!preg_match("/^[0-9]*$/",$id)) {
          $id = "";
          $idErr = "Only numbers allowed";
        }
      }
}

if(!empty($id)) 
{
  $line = "SELECT * FROM COURSES WHERE ID = '$id';" ;

  if ($conn->query($line)->num_rows > 0) {
    header("Location: editCourse.php?id=$id"); /* Redirect browser */
  } else {
      $idErr = "No such course.";
    }
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

echo '  <h2>Edit course</h2>
  <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' ">
    <table>
    <tr>
    <td><td>
      <td> <a href="viewCourse.php">Select from view list</a><td>
    <tr>
    <tr><td>&nbsp; <td><tr>
    <tr> 
        <td>ID <td>
        <td><input type="text" name="id" value="' . $id . '"> <td>
        <td><span class="error">' . $idErr . '</span><td>
    <tr>
    <tr> 
        <td> <td>
        <td>  <input type="submit" name="edit" value="Edit"> <td>
    <tr>
    </table>
  </form> ';

?>
</body>
</html>