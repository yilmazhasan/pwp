<?php
function renderForm($id, $code, $name, $parentCode, $isRoom, $codeErr, $nameErr, $parentCodeErr, $isRoomErr, $error)
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

<h2>Classroom</h2>
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
      <td>Parent code <td>
      <td><input type="parentCode" name="parentCode" value="<?php echo $parentCode;?>"> <td>
      <td><span class="error"><?php echo $parentCodeErr;?></span> <td>
  <tr>
  <tr> 
      <td>Type <td>
      <td><input type="radio" name="isRoom" <?php if ($isRoom == '1') echo "checked";?> value= '1'> Room 
        <input type="radio" name="isRoom" <?php if ($isRoom == '0') echo "checked";?> value= '0'> Floor <td>
      <td><span class="error"><?php echo $isRoomErr;?></span> <td>  <tr>
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