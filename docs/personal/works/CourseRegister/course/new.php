<?php
include('../db/connectDb.php');
include('../functions.php');
include('./renderForm.php');

if($_POST['submit'])  /* $_SERVER_ ['REQUEST'] == 'POST'??*/
{
  $code = test_input($_POST['code']);
  $name = test_input($_POST['name']);
  $isMandatory = $_POST['isMandatory'];
  $day = $_POST['day'];
  $hourFrom = test_input($_POST['hourFrom']);
  $hourTo = test_input($_POST['hourTo']);

  $isReadyForDb = testCode($code, $codeErr) && testName($name, $nameErr) && testIsMandatory($isMandatory, $isMandatoryErr)
             && testDay($day, $dayErr) && testHour($hourFrom, $hourTo, $hourErr);  

  if($isReadyForDb){
    $line = "INSERT INTO courses (code, name, isMandatory, day, hourFrom, hourTo) VALUES( '"
          . $code . "', '" . $name . "', '" . $isMandatory . "', '" . $day . "', '" . $hourFrom . "', '" . $hourTo . "')";

    if($conn->query($line) == TRUE){
      usleep(200000);
      header('Location: view.php');      
    }
    else{
        $error = "Error: " . $conn->error;
    }
  }
}
    renderForm($id, $code, $name, $isMandatory, $day, $hourFrom, $hourTo, $codeErr, $nameErr, $isMandatoryErr, $dayErr, $hourErr, $error);

?>