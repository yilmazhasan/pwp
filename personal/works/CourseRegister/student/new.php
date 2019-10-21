<?php
include('../db/connectDb.php');
include('../functions.php');
include('./renderForm.php');

if($_POST['submit'])  /* $_SERVER_ ['REQUEST'] == 'POST'??*/
{
  $code = test_input($_POST['code']);
  $name = test_input($_POST['name']);
  $lastname = test_input($_POST['lastname']);

  $isReadyForDb = testCode($code, $codeErr) && testName($name, $nameErr) && testName($lastname, $lastnameErr);

  if($isReadyForDb){
    $line = "INSERT INTO students (code, name, lastname) VALUES( '"
          . $code . "', '" . $name . "', '" . $lastname . "')";

    if($conn->query($line) == TRUE){
      usleep(200000);
      header('Location: view.php');      
    }
    else{
        $error = "Error: " . $conn->error;
        renderForm($id, $code, $name, $lastname, $codeErr, $nameErr, $lastnameErr, $error);
    }
  }
  else{
      renderForm($id, $code, $name, $lastname, $codeErr, $nameErr, $lastnameErr, $error);
  }
}
else{
      renderForm($id, $code, $name, $lastname, $codeErr, $nameErr, $lastnameErr, $error);
}
?>