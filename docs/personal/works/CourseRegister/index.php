<?php
include('./db/connectDb.php');
//include('../util.php');


session_start();

?>

<!DOCTYPE html>

<script>
function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}

function changeInnerHtml(url, element)
{
	document.getElementById("element").innerHTML = httpGet(url);
}

</script>

<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title> Course registration system </title>

        <link href="css/layout.css" type="text/css" rel="stylesheet">
        <link href="css/menu.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <header>
            <a href = "index.php"> <h2 style="color:white"> Course registration</h2>  </a>
            <a href = "#"> <h3 style="color:white"> <?php echo $_SESSION['username']; ?></h3> </a>
            <a href = "./user/logout.php" tite = "Logout" color:"#017572"> <h4 style="color:white"> logout </h4> </a>

        </header>

<!--        <div class="container"> -->
<!--                <div class="innerContainer" id="innerContainer">

                </div>
-->

            <ul id="nav">

<?php
	switch(true) 
	{

		case $_SESSION['role'] < 1: //norole: 0
			echo 'You don\'t have role';
		break;

		case $_SESSION['role'] == 1: //admin: 1
?>
		        <li>
		            <a href="#">Utils</a>
		            <a href="db/resetDb.php">Reset db</a>
		        </li>
<?php
		case $_SESSION['role'] == 2: //studentAffairs: 2
?>
                <li>
                    <a href="classroom/index.php">Classrooms</a>
                    <a href="classroom/new.php">Add</a>
                    <a href="classroom/view.php">View</a>
                </li>
	            <li>
	                <a href="facultyMember/index.php">Faculty Members</a>
	                <a href="facultyMember/new.php">Add</a>
	                <a href="facultyMember/view.php">View</a>
	            </li>
	            <li>
	                <a href="#" onClick="changeInner('course/index.php', 'innerContainer')">Courses</a>
	                <a href="course/new.php">Add</a>
	                <a href="course/view.php">View</a>
	            </li>
	            <li>
	                <a href="student/index.php">Students</a>
	                <a href="student/new.php">Add</a>
	                <a href="student/view.php">View</a>
	            </li>
<?php
		case $_SESSION['role'] == 4:	//student: 4
?>
                <li>
                    <a href="registration/index.php">Registration</a>
                    <a href="registration/new.php">Add</a>
                    <a href="registration/view.php">View</a>
                </li>                
<?php
		case $_SESSION['role'] == 3:	//faculty Members: 3
?>
                <li>
                    <a href="courseOffered/index.php">Courses offered</a>
                    <?php if($_SESSION['role'] != 4) echo"<a href='courseOffered/new.php' >Add</a>";?>
                    <a href="courseOffered/view.php">View</a>
                </li>
<?php
			if($_SESSION['role'] == 3){
?>	
                <li>
                    <a href="classroom/index.php">Classroom</a>
                    <a href="classroom/new.php" >Add</a>
                    <a href="classroom/view.php">View</a>
                </li>

	            <li>
	                <a href="#" onClick="changeInner('course/index.php', 'innerContainer')">Course</a>
	                <a href="course/view.php">View</a>
	            </li>
<?php
			}
			break;

		default:
			echo 'You don\'t have role';
			break;
	}
?>       
            </ul>

<!--        </div> -->


    </body>
</html>
