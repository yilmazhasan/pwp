<?php
function renderForm($id, $code, $name, $lastname, $codeErr, $nameErr, $lastnameErr, $error)
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

<h2>Student</h2>
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
      <td>Lastname <td>
      <td><input type="text" name="lastname" value="<?php echo $lastname;?>"> <td>
      <td><span class="error"><?php echo $lastnameErr;?></span> <td>
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