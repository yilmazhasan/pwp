<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   
//   echo 'You have cleaned session';
   header('Refresh: 0; URL = login.php');
?>