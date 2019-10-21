<?php
include('../db/connectDb.php');
include('../functions.php');
include('./renderForm.php');

if($_POST['submit'])  /* $_SERVER_ ['REQUEST'] == 'POST'??*/
{
  $courseCode = test_input($_POST['courseCode']);
  $facultyMemberCode = test_input($_POST['facultyMemberCode']);
  $classroomCode = test_input($_POST['classroomCode']);
  $code = $courseCode . $facultyMemberCode . $classroomCode;

  $isReadyForDb = testCode($courseCode, $courseCodeErr) && testCode($facultyMemberCode, $facultyMemberCodeErr) && testCode($classroomCode, $classroomCodeErr);

  if($isReadyForDb){
    $line = "INSERT INTO offeredCourses (code, courseCode, facultyMemberCode, classroomCode) VALUES( '"
          . $code . "', '" . $courseCode . "', '" . $facultyMemberCode . "', '" . $classroomCode . "')";

    if($conn->query($line) == TRUE){
      header('Location: view.php');      
    }
    else{
      $error = "Error: " . $conn->error;
    }
  }
}
  renderForm($id, $code, $courseCode, $facultyMemberCode, $classroomCode, $codeErr, $courseCodeErr, $facultyMemberCodeErr, $classroomErr, $error);

?>