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
session_start();
if(empty($_SESSION['courseExists']))
{
  // define variables and set to empty values
  $codeErr = $code = "";

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
      if (empty($_POST["code"])) {
        $codeErr = "Code is required";
      } else {
//          $code = test_input($_POST["code"]);
          // check if name only contains characters
          if (!preg_match("/^[0-9]*$/",$code)) {
            $code = "";
            $codeErr = "Only numbers allowed";
          }
        }
  }

  if(!empty($code)) 
  {
    $line = "SELECT * FROM COURSES WHERE CODE = '$code';" ;

    $conn = $GLOBALS['conn'];

    $conn = $GLOBALS['dbConnection']; // not working
    if(!$conn)
    {
      $conn = new mysqli('localhost', 'root', '12345'); // Create connection
      //$db = mysql_select_db('COURSEREGISTRATION', $conn);
      $conn->query("USE COURSEREGISTRATION"); // Select database
    }  
  if ($conn->query($line)->num_rows > 0) {
    echo $conn->query($line)->num_rows;
    $_SESSION['courseExists'] = true;
    //  header("Location: editCourse.php"); /* Redirect browser */
    // exit();
  } else {

      $codeErr = "No such course.";
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
        <td>Code <td>
        <td><input type="text" name="code" value="' . $code . '"> <td>
        <td><span class="error">' . $codeErr . '</span><td>
    <tr>
    <tr> 
        <td> <td>
        <td>  <input type="submit" name="edit" value="Edit"> <td>
    <tr>
    </table>
  </form> ';
}
else
{
  echo 'course exists';
  $_SESSION['courseExists'] = false;
}


//echo $_SESSION['courseExists'];
?>
</body>
</html>