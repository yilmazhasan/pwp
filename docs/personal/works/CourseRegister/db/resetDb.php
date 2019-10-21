<?php

include('connectDb.php');

$sqlFile = "db.sql";

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($sqlFile);
// Loop through each line

$success = true;

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
        if ($conn->query($templine) != TRUE) {
        	$success = false;
	        echo "Error querying database: " . $conn->error;
        }
        // Reset temp variable to empty
        $templine = '';
    }
}

$conn->close();

if(!$success){
	echo " <br> <br> <a href = '../index.php'> Click to reset again.</a> ";
}
else{
	echo "Queries executed successfully";
	// sleep(2);
	header('refresh:0.5 url=../user/login.php');
}

?>