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

$code = $_POST["code"];
$codeErr = "*Code";

$result = $conn->query("SELECT * FROM offeredCourses");// or die(mysql_error());

if(!empty($_POST["code"]))
{
	$code = test_input($_POST["code"]);
	if (preg_match("/^[0-9]*$/",$code)) {
		$result = $conn->query("SELECT * FROM offeredCourses WHERE code=$code") or die(mysql_error());	
		if(!mysqli_num_rows($result)){
			$codeErr = "*Code: no such record";
		}
	}else{
		$codeErr = "*Code: only numbers allowed";
	}
}

echo '<h2>Students</h2>';

?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 		<input type="text" name = "code" size = "1" value="<?php echo $code;?>">	
      	<input type="submit" value="Search">
<br>
	 <span class="error">  <?php echo $codeErr;?> </span>
</form>
<?php
// display data in table
//echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
echo "<table border='1' cellpadding='1'>";
echo "<tr align='left'><th col width = '30'>#</th> <th>CODE</th> <th>Course name</th> <th>Faculty member</th> 
	<th>Classroom</th> <th colspan = 2>Action</th></tr>";

if(mysqli_num_rows($result)){
	$i = 0;
	while($row = $result->fetch_assoc()) {
		$i++;
		
		$courseName = $conn->query("SELECT name from courses where code= $row[courseCode]")->fetch_assoc()['name'];

		$row2 = $conn->query("SELECT name, lastname from facultyMembers where code= $row[facultyMemberCode]")->fetch_assoc();
		$facultyMember = $row2['name'] . " " . $row2['lastname'];

		$classroom = $conn->query("SELECT name from classrooms where code= $row[classroomCode]")->fetch_assoc()['name'];

		// echo out the contents of each row into a table
		echo "<tr>";

		echo '<td> <span style="font-weight:bold">' . $i . '</span> </th>';
		echo '<td>' . $row['code'] . '</td>';
		echo '<td>' . $courseName . '</td>';
		echo '<td>' . $facultyMember . '</td>';
		echo '<td>' . $classroom . '</td>';
		if($_SESSION['role'] > 0 && $_SESSION['role'] < 4 ){
			echo '<td><a href="edit.php?id=' . $row['id'] . '">Edit</a></td>';
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
<?php
	if($_SESSION['role'] > 0 && $_SESSION['role'] < 4 ){
		echo "<p><a href='new.php'>Add a new record</a></p>";
	}
?>

</body>

</html>