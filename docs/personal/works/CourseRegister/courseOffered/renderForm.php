<?php
function renderForm($id, $code, $courseCode, $facultyMemberCode, $classroomCode, $codeErr, $courseCodeErr, $facultyMemberCodeErr, $classroomCodeErr, $error)
{
?>

<!DOCTYPE HTML>  
<html>

<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  
<?php

// if there are any errors, display them
if ($error != '')
{
  echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
}

?>

<h2>Offer course</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <input type="hidden" name="id" value="<?php echo $id; ?>"/>    
      <td><input type="hidden" name="code" value="<?php echo $code;?>"> <td>
  <table>
  <tr> 
      <td>Course code <td>
      <td><input type="text" name="courseCode" value="<?php echo $courseCode;?>"> <td>
      <td><span class="error"> <?php echo $courseCodeErr;?></span><td>
  <tr>
  <tr> 
      <td>Faculty member code <td>
      <td><input type="text" name="facultyMemberCode" value="<?php echo $facultyMemberCode;?>"> <td>
      <td><span class="error"> <?php echo $facultyMemberCodeErr;?></span><td>
  <tr>
  <tr> 
      <td>Classroom code <td>
      <td><input type="text" name="classroomCode" value="<?php echo $classroomCode;?>"> <td>
      <td><span class="error"> <?php echo $classroomCodeErr;?></span><td>
  <tr>
  <tr> 
      <td> <td>
            <td>  <input type="submit" name="submit" value="Save">
            <a style = "text-decoration:none" href="view.php"> <input type="button" name="cancel" value="Cancel"/> </a><td>
  <tr>
  </table>
</form>


</body>
</html>

<?php
}
?>