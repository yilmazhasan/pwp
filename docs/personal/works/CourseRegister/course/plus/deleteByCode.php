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

include('../connectDb.php');

// define variables and set to empty values
$codeErr = $code = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["code"])) {
      $codeErr = "code is required";
    } else {
          $code = test_input($_POST["code"]);
        // check if name only contains characters
        if (!preg_match("/^[0-9]*$/",$code)) {
          $code = "";
          $codeErr = "Only numbers allowed";
        }
      }
}

if(!empty($code)) 
{
  $conn->query("DELETE FROM COURSES WHERE CODE = '$code'");
  
  if($conn->affected_rows > 0){
    echo 'Deleted course with Code:' . $code;
//    sleep(1);
    header("Location: view.php"); /* Redirect browser */
  }
  else{
    $codeErr = 'No such record';
  }

}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

echo '  <h2>Delete course</h2>
  <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' ">
    <table>
    <tr>
    <td><td>
      <td> <a href="viewCourse.php">Select from view list</a><td>
    <tr>
    <tr><td>&nbsp; <td><tr>
    <tr> 
        <td>Code <td>
        <td><input type="text" name="code" value="' . $code . '"> <td>
        <td><span class="error">' . $codeErr . '</span><td>
    <tr>
    <tr> 
        <td> <td>
        <td>  <input type="submit" name="delete" value="Delete"> <td>
    <tr>
    </table>
  </form> ';

?>
</body>
</html>