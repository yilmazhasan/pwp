<html>

<head>
<title>View Students</title>

<style>
.error {color: #FF0000;}
</style>

</head>

<body>


<?php

	// connect to the database
include('../db/connectDb.php');
include('../functions.php');

session_start();
try{
	$code = $_POST["code"];
	$codeErr = "*Course code";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

$result = $conn->query("SELECT DISTINCT R.id, C.code as cCode, C.name as cName, FM.name as iName, FM.lastname as iName2, S.code as sCode, S.name sName, S.lastname sName2
						from registrations R, offeredCourses O, courses C, facultyMembers FM, students S 
						where R.offeredCourseCode = O.code AND R.studentCode = S.code AND O.courseCode = C.code 
						AND O.facultyMemberCode = FM.code ORDER BY S.code;") or die(mysql_error());	

if(!empty($_POST["courseCode"]))
{
	$code = test_input($_POST["courseCode"]);
	if (preg_match("/^[0-9]*$/",$courseCode)) {
		$result = $conn->query("SELECT DISTINCT C.code as cCode, C.name as cName, FM.name as iName, FM.lastname as iName2, S.code as sCode, S.name sName, S.lastname sName2
								from registrations R, offeredCourses O, courses C, facultyMembers FM, students S 
								where R.offeredCourseCode = O.code AND R.studentCode = S.code AND O.courseCode = C.code 
								AND O.facultyMemberCode = FM.code AND C.code = $code ORDER BY S.code;") or die(mysql_error());	
		if(!mysqli_num_rows($result)){
			$codeErr = "*Code: no such record";
		}
	}else{
		$codeErr = "*Code: only numbers allowed";
	}
}

echo '<h2>Registration</h2>';

?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 		<input type="text" name = "courseCode" size = "1" value="<?php echo $courseCode;?>">	
      	<input type="submit" value="Filter">
<br>
	 <span class="error">  <?php echo $codeErr;?> </span>
</form>
<?php
// display data in table
//echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
echo "<table border='1' cellpadding='1'>";
echo "<tr align='left'><th></th> <th colspan=2>Course</th> <th>Instructor</th> <th colspan=2> Student</th></tr>";
echo "<tr align='left'><th>#</th> <th>Code</th> <th>Name</th> <th>Name</th> <th>Code</th><th>Name</th> <th>Action</th></tr>";

if(mysqli_num_rows($result)){
	$i = 0;
	while($row = $result->fetch_assoc()) {
		$i++;
		// echo out the contents of each row into a table
		echo "<tr>";

		echo '<td> <span style="font-weight:bold">' . $i . '</span> </th>';
		echo '<td>' . $row['cCode'] . '</td>';
		echo '<td>' . $row['cName'] . '</td>';
		echo '<td>' . $row['iName'] . ' ' . $row['iName2'] . '</td>';
		echo '<td>' . $row['sCode'] . '</td>';
		echo '<td>' . $row['sName'] . ' ' .$row['sName2'] . '</td>';
		if(($_SESSION['role'] > 0 && $_SESSION['role'] < 4) || $row['sCode'] == $_SESSION['userCode'] ){
			echo '<td><a href="delete.php?id=' . $row['id'] . '">Del</a></td>';
		}
		else{
			echo '<td>-</td>';
		}
		echo "</tr>";
	}
}
else{
		echo "<tr>";
		echo '<td colspan = 8>' . "No records" . '</span> </th>';
		echo "</tr>";
}
// close table>
echo "</table>";

?>
<p><a href="new.php">Add a new record</a></p>


</body>

</html>