<?php
include('../db/connectDb.php');
include('../functions.php');
include('./renderForm.php');

if($_POST['submit'])  /* $_SERVER_ ['REQUEST'] == 'POST'??*/
{
  $code = test_input($_POST['code']);
  $name = test_input($_POST['name']);
  $parentCode = test_input($_POST['parentCode']);
  $isRoom = test_input($_POST['isRoom']);

  $isReadyForDb = testCode($code, $codeErr) && testClassName($name, $nameErr) 
          && testParentCode($parentCode, $parentCodeErr) && testIsRoom($isRoom, $isRoomErr);

  if($isReadyForDb){
    $line = "INSERT INTO classrooms (code, name, parentCode, isRoom) VALUES( '"
          . $code . "', '" . $name . "', '" . $parentCode . "', '" . $isRoom . "')";

    if($conn->query($line) == TRUE){
      usleep(200000);
      header('Location: view.php');      
    }
    else{
        $error = "Error: " . $conn->error;
        renderForm($id, $code, $name, $parentCode, $isRoom, $codeErr, $nameErr, $parentCodeErr, $isRoomErr, $error);
    }
  }
  else{
      renderForm($id, $code, $name, $parentCode, $isRoom, $codeErr, $nameErr, $parentCodeErr, $isRoomErr, $error);
  }
}
else{
      renderForm($id, $code, $name, $parentCode, $isRoom, $codeErr, $nameErr, $parentCodeErr, $isRoomErr, $error);
}
?>