<?php
function renderForm($id, $code, $name, $isMandatory, $day, $hourFrom, $hourTo, $codeErr, $nameErr, $isMandatoryErr, $dayErr, $hourErr, $error)
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

<h2>Course</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <input type="hidden" name="id" value="<?php echo $id; ?>"/>    
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
      <td>Type <td>
      <td><input type="radio" name="isMandatory" <?php if ($isMandatory == 'y') echo "checked";?> value= 'y'> Mandatory 
        <input type="radio" name="isMandatory" <?php if ($isMandatory == 'n') echo "checked";?> value= 'n'> Elective <td>
      <td><span class="error"><?php echo $isMandatoryErr;?></span> <td>  <tr>
  <tr> 
      <td>Day <td>
      <td>
        <select name = "day" class="selectpicker show-tick">
        <option <?php if($day == 0) echo "selected" ?> value="0">- Select -</option>
        <option <?php if($day == 1) echo "selected" ?> value="1">Monday</option>
        <option <?php if($day == 2) echo "selected" ?> value="2">Tuesday</option>
        <option <?php if($day == 3) echo "selected" ?> value="3">Wednesday</option>
        <option <?php if($day == 4) echo "selected" ?> value="4">Thursday</option>
        <option <?php if($day == 5) echo "selected" ?> value="5">Friday</option>
        <option <?php if($day == 6) echo "selected" ?> value="6">Saturday</option>
        <option <?php if($day == 7) echo "selected" ?> value="7">Sunday</option>
        </select>
      <td>
      <td><span class="error"> <?php echo $dayErr;?></span> <td>
  <tr>
  <tr> 
      <td>Hour (hh:mm) <td>
      <td> <input type="text" name="hourFrom" value="<?php echo $hourFrom;?>" size="7"> to
          <input type="text" name="hourTo" value="<?php echo $hourTo;?>" size="7"><td>
      <td><span class="error"> <?php echo $hourErr;?></span> <td>
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