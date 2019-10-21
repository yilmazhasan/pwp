<?php

// connect to the database
include('../db/connectDb.php');

// check if the 'id' variable is set in URL, and check that it is valid
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
	// get id value
	$id = $_GET['id'];

	// delete the entry
	$result = $conn->query("DELETE FROM courses WHERE id=$id") or die(mysql_error());

	// redirect back to the view page
	header("Location: view.php");
}

?>