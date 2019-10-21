<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


function testId($id, & $idErr)
{
  if (empty($id)) {
    $idErr = "ID is required";
    return false;
  }
    // check if name only contains letters and whitespace
  if (!preg_match("/^[0-9]*$/",$id)) {
    $idErr = "Only numbers allowed"; 
    return false;
  }

  return true;
}

function testCode($code, &$codeErr)
{
  if (empty($code)) {
   $codeErr = "Code is required";
   return false;
  }
  if (!preg_match("/^[0-9]*$/",$code)) {
    $codeErr = "Only numbers allowed";
    return false;
  }

  return true;;
}

function testName($name, &$nameErr)
{	
	if (empty($name)) {
		$nameErr = "Name is required";
    return false;
	}
	if (!preg_match("/^[a-z A-Z]*$/",$name)) {
  	$nameErr = "Only characters allowed";
    return false;
  } 

  return true;;
}

function testIsMandatory($isMandatory, &$isMandatoryErr)
{
  if(empty($isMandatory)){
    $isMandatoryErr = "Select one.";
    return false;
  }
    return true;
}

function testDay($day, &$dayErr)
{
  if(empty($day) || ($day<=0 && $day>7)){
    $dayErr = "Select day.";
    return false;
  }
    return true;
}

function testHour($hourFrom, $hourTo, &$hourErr)
{
  //match any non-digit character except for ':' in middle ? \D\d: or \
  $removedColon = str_replace(':', '', $hourTo.$hourFrom);

  if (preg_match("/[\D]/", $removedColon)){
    $hourErr = "Only numbers allowed.";
    return false;
  }
  if (empty($hourFrom) || empty($hourTo)){
    $hourErr = "Hour is required";
    return false;
  }
  if (!preg_match("/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/",$hourFrom)
      || !preg_match("/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/",$hourTo)) {
        $hourErr = "Format hh:mm"; 
        return false;
  }

  return true;
}

function testEmail($email, &$emailErr){

  if (empty($email)) {
  //  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Email is required";
      return false;
  } 
  if (!preg_match("/^[a-z0-9._%+-]{5,20}@[a-z]{3,7}.com$/",$email)) {
      $emailErr = "Enter a valid address";
      return false;
  }

  return true;
}

function testDateYYYYMMDD($date, &$dateErr){
  
  if (empty($date)) {
      $dateErr = "Date is required, format: yyyymmdd";
      return false;
  }
  if (!preg_match("/^((?:19|20)\d\d)[- \/.]?(0[1-9]|1[012])[- \/.]?(0[1-9]|[12][0-9]|3[01])$/",$date)) {
      $dateErr = "Date is invalid, format: yyyymmdd"; 
      return false;
  }

  return true;
}

function getFormattedDate($date, $format){

  if(strtolower($format) == "yyymmdd")
   {
      $pattern   = "^([19|20]\d\d)[- \/.]?(0[1-9]|1[012])[- \/.]?(0[1-9]|[12][0-9]|3[01])$";
      if(preg_match_all($pattern, $date, $matches_out))
      {
        return $matches_out[1][0] . $matches_out[1][1] . $matches_out[1][2];
      }

    }
      return "";
}

function testClassName($name, &$nameErr)
{ 
  if (empty($name)) {
    $nameErr = "Name is required";
    return false;
  }

  return true;;
}

function testIsRoom($isRoom, &$isRoomErr)
{
  if($isRoom == "" || $isRoom == null){ //|| empty($isRoom) not working when selected 0 value radio button
    $isRoomErr = "Select one.";
    return false;
  }
    return true;
}

function testParentCode($code, &$codeErr)
{
  if (!preg_match("/^[0-9]*$/",$code)) {
    $codeErr = "Only numbers allowed";
    return false;
  }

  return true;;
}

?>