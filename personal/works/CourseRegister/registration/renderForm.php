<?php
function renderForm($id, $code, $studentCode, $offeredCourseCode, $codeErr, $studentCodeErr, $offeredCourseCodeErr, $error)
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

<h2>Registration</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <input type="hidden" name="id" value="<?php echo $id; ?>"/>    
  <table>
  <tr> 
      <td>Student code <td>
      <td><input type="text" name="studentCode" value="<?php echo $studentCode;?>"> <td>
      <td><span class="error"> <?php echo $studentCodeErr;?></span><td>
  <tr>
  <tr> 
      <td>Offered course code <td>
      <td><input type="text" name="offeredCourseCode" value="<?php echo $offeredCourseCode;?>"> <td>
      <td><span class="error"><?php echo $offeredCourseCodeErr;?></span> <td>
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