<?php
include('../db/connectDb.php');
include('../functions.php');
include('./renderForm.php');

if($_POST['submit'])  /* $_SERVER_ ['REQUEST'] == 'POST'??*/
{
  $code = test_input($_POST['code']);
  $name = test_input($_POST['name']);
  $lastname = test_input($_POST['lastname']);
  $email = test_input($_POST['email']);
  $startDate = test_input($_POST['startDate']);

  $isReadyForDb = testCode($code, $codeErr) && testName($name, $nameErr) 
          && testName($lastname, $lastnameErr) && testEmail($email, $emailErr)
          && testDateYYYYMMDD($startDate, $startDateErr);

  if($isReadyForDb){
    $line = "INSERT INTO facultyMembers (code, name, lastname, email, startDate) VALUES( '"
          . $code . "', '" . $name . "', '" . $lastname . "', '" . $email . "', '" . $startDate . "')";

    if($conn->query($line) == TRUE){
      usleep(200000);
      header('Location: view.php');      
    }
    else{
        $error = "Error: " . $conn->error; $error .= $line;
        renderForm($id, $code, $name, $lastname, $email, $startDate, $codeErr, $nameErr, $lastnameErr, $emailErr, $startDateErr, $error);
    }
  }
  else{
      renderForm($id, $code, $name, $lastname, $email, $startDate, $codeErr, $nameErr, $lastnameErr, $emailErr, $startDateErr, $error);
  }
}
else{
      renderForm($id, $code, $name, $lastname, $email, $startDate, $codeErr, $nameErr, $lastnameErr, $emailErr, $startDateErr, $error);
}
?>