<?php session_start();?>

<html>
<head>
	<title>Faculty Portal</title>
	
	
	<link rel="stylesheet" type="text/css" href="../stylesheets/Faculty_control_panel_design.css">
	<link rel="stylesheet" type="text/css" href="../stylesheets/header_design.css">
	<link rel="stylesheet" type="text/css" href="../stylesheets/generalstylings.css">
	<link href="https://fonts.googleapis.com/css?family=Bungee Shade" rel="stylesheet">
  

</head>


<body>
<div class="wrapper">
	 <?php
	 include '../includes/header.php';
	 if($_SESSION['user']!="faculty")
	 {
		
		header("Location:../error.php");
	 }
	 ?>
     <center>
	<hr class="title-cover">
    <span class="caption">Faculty Control Panel</span>
	 <hr class="title-cover"></center>
	 <br>
	 <br>
<center>
<table cellspacing="30px">
	<tr>
		<td>
			<div class="container">
		<img class="image" src="../media/subjects.jpg" style="height:100%;width:100%;">
		<div class="middle">
		<button class="button" name="button" onclick="document.location.href='../faculty/viewFacultySubject.php'" >view Subjects</button>
		</div>
      </div>
		</td>
		<td width="100px"></td>
		<td>
			<div class="container">
		<img class="image" src="../media/timetable.jpg" style="height:100%;width:100%;">
		<div class="middle">
		<button class="button" name="button" onclick="document.location.href='../faculty/faculty_time_table.php'">view Timetable</button>
		</div>
      </div>
		</td>
	
		
	</tr>
	
</table>
</center>

</div>
<?php include '../includes/footer.php';?>
</body>
</html>