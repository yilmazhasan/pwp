<html>

<head>
<title>View Course</title>
</head>

<body>

<?php

// connect to the database
include('CourseRegister/db/connectDb.php');

// get results from database
//$result = mysql_query("SELECT * FROM COURSES") or die(mysql_error());
$result = $conn->query("SELECT * FROM COURSES") or die(mysql_error());

// display data in table
//echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
echo '<h2>View courses</h2>';
echo "<table border='1' cellpadding='1'>";

echo "<tr><th>#</th> <th>ID</th> <th>CODE</th> <th>Name</th> <th>Mandatory</th> 
	<th>Day</th><th>Start Hour</th><th>End Hour</th> <th colspan = 2>Edit/Delete</th></tr>";

// loop through results of database query, displaying them in the table
//while($row = mysql_fetch_array( $result ) /*$row = $result->fetch_assoc()*/) {

$i = 0;
while($row = $result->fetch_assoc()) {
$i++;
// echo out the contents of each row into a table
echo "<tr>";

echo '<td> <span style="font-weight:bold">' . $i . '</span> </th>';
echo '<td>' . $row['ID'] . '</td>';
echo '<td>' . $row['CODE'] . '</td>';
echo '<td>' . $row['NAME'] . '</td>';
echo '<td>' . ($row['ISMANDATORY'] == 'y' ? 'Yes' : 'No') . '</td>';
echo '<td>' . getDay($row['DAY']) . '</td>';
echo '<td>' . $row['HOURFROM'] . '</td>';
echo '<td>' . $row['HOURTO'] . '</td>';
echo '<td><a href="editCourse.php?id=' . $row['ID'] . '">Edit</a></td>';
echo '<td><a href="deleteCourse.php?code=' . $row['CODE'] . '">Delete</a></td>';

echo "</tr>";

}

// close table>
echo "</table>";


function getDay($day) {
	switch ($day) {
		case '1':
		case 1:
			return 'Monday';
		case '2':
		case 2:
			return 'Tuesday';
		case '3':
		case 3:
			return 'Wednesday';
		case '4':
		case 4:
			return 'Thursday';
		case '5':
		case 5:
			return 'Friday';
		case '6':
		case 6:
			return 'Saturday';
		case '7':
		case 7:
			return 'Sunday';
		
		default:
			return $day;
	}
}

?>

<p><a href="addCourse.php">Add a new record</a></p>


</body>

</html>