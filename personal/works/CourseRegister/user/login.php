<?php
include("../db/connectDb.php");

   ob_start();
   session_start();
?>

<?
//wHAT IS THIS BLOCK??

   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>


<html lang = "en">

   <head>
      <title>Course registration demo</title>
      <link href = "https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-bootstrap/0.5pre/assets/css/bootstrap.min.css" rel = "stylesheet">
      <!-- <script src = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
      <!-- <link href = "css/bootstrap.min.css" rel = "stylesheet"> -->

      <style>
         body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #ADABAB;
         }

         .form-signin {
		    text-align: center;
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            color: #017572;
         }

         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
         }

         .form-signin .checkbox {
            font-weight: normal;
         }

         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            margin : 1px;
            font-size: 16px;
         }

         .form-signin .form-control:focus {
            z-index: 2;
         }

         .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#017572;
         }

         .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-color:#017572;
         }

		   a{
         	color:#017572;
         }

         h2{
            text-align: center;
            color: #017572;
         }
      </style>

   </head>

   <body>

      <h2>Course Registration Demo</h2>
      <div class = "container form-signin">

         <?php
            $msg = '';

            if (isset($_POST['login']) && !empty($_POST['username'])
               && !empty($_POST['password'])) {

// did not work?
//               $username = mysqli_real_escape_string($conn, $_POST['username']);
//               $password = crypt(mysqli_real_escape_string($conn, $_POST['password']), 'md5');

               $username = $_POST['username'];
               $password = md5($_POST['password']); //Change hash function to crypt function

               // Query
               $query = sprintf("SELECT * FROM users WHERE username='%s' AND password='%s'",
                        $username, $password);

               $result = $conn->query($query);

               if(mysqli_num_rows($result)){
					$result = $result->fetch_assoc();
					$_SESSION['username'] = $result['username'];
					$_SESSION['userCode'] = $result['code'];
					$_SESSION['role'] = $result['role'];

					$_SESSION['logged'] = true;
					$_SESSION['valid'] = true;
					$_SESSION['timeout'] = time();

					header('Location: ../index.php');
               }else {
                  $msg = 'Wrong username or password';
               }
            }
         ?>
      </div> <!-- /container -->

      <div class = "container">

         <form class = "form-signin" role = "form"
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" style="margin-bottom:1em;"
               name = "username" placeholder = "username"
               required autofocus>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password" required> <br>
            <button class = "btn btn-primary" type = "submit"
               name = "login">Login</button>
         </form>

         <p align="middle">
            Click here to clean <a href = "logout.php" tite = "Logout" color:"#017572"> session. </a>
         </p>
      </div>
   </body>
</html>
