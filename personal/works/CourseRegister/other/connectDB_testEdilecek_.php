 <?php
$servername = "localhost";
$username = "root";
$password = "12345";
$sqlFile = "db/db.sql";
$databaseName = 'COURSEREGISTRATION'; // Database name


// Connect to MySQL server
mysql_connect($servername, $username, $password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
mysql_select_db($databaseName) or die('Error selecting MySQL database: ' . mysql_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
	// Skip it if it's a comment
	if (substr($line, 0, 2) == '--' || $line == '')
	    continue;

	// Add this line to the current segment
	$templine .= $line;
	// If it has a semicolon at the end, it's the end of the query
	if (substr(trim($line), -1, 1) == ';')
	{
	    // Perform the query
	    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
	    // Reset temp variable to empty
	    $templine = '';
	}
}
 echo "Tables imported successfully";
?>



<?php
//mysql_connect not working?

// Database Variables (edit with your own server information)
//$server = 'localhost';
//$user = 'root';
//$pass = '12345';
//$db = 'COURSEREGISTRATION';


//mysql_connect($server, $user, $pass);
//mysql_connect($server, $user, $pass) or die('Error connecting to MySQL server: ' . mysql_error());

// Connect to Database

//$connection = mysql_connect($server, $user, $pass);

//or die ("Could not connect to server ... \n" . mysql_error ());

//mysql_select_db($db)

//or die ("Could not connect to database ... \n" . mysql_error ());

//echo mysql_error();
?>
