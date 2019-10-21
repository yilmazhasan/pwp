<?php
include('../db/connectDb.php');
include('../functions.php');
include('./renderForm.php');

if($_POST['submit'])  /* $_SERVER_ ['REQUEST'] == 'POST'??*/
{
  $studentCode = test_input($_POST['studentCode']);
  $offeredCourseCode = test_input($_POST['offeredCourseCode']);
  $code = $studentCode . $offeredCourseCode;

  $isReadyForDb = testCode($studentCode, $studentCodeErr) && testCode($offeredCourseCode, $offeredCourseCodeErr);

  if($isReadyForDb){
    $line = "INSERT INTO registrations (code, studentCode, offeredCourseCode) VALUES( '"
          . $code . "', '" . $studentCode . "', '" . $offeredCourseCode . "')";

    if($conn->query($line) == TRUE){
      header('Location: view.php');      
    }
    else{
        $error = "Error: " . $conn->error;
    }
  }
}

renderForm($id, $code, $studentCode, $offeredCourseCode, $codeErr, $studentCodeErr, $offeredCourseCodeErr, $error)

?>