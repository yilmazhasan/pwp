 <?php
error_reporting(E_ERROR | E_PARSE); // to remove warnings and errors

$servernameLocal = "localhost";
$usernameLocal = "root";
$passwordLocal = "12345";
$databasenameLocal = "courseRegistration";

$servername = "remotemysql.com";
$username = "9Ab2tGi8ce";
$password = "hfXss7ix0B";
$portNumber = "3306";
$databasename = "9Ab2tGi8ce";


// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    //die("Connection failed: " . $conn->connect_error);
    
    echo "
        <script type=\"text/javascript\">
        window.alert(\"Database conection failed. " . $conn->connect_error . "\");
        </script>
        ";
    // die();
}

// echo 'connected mysql.<br>';

try{
	$conn->query("USE " . $databasename);
	//echo 'using ' . $databasename;
}
catch(Exception $e)
{
	//echo $e->getMessage();
}

?>



