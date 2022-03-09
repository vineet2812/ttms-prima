<?php include '../includes/db.php';
session_start();
//include '../includes/header.php';
$branch="";
$course="";
$sem="";
if($_SESSION['user']=="student")
{
$branch=$_SESSION['branch'];
$course=$_SESSION['course'];
$sem=$_SESSION['sem'];
}
else
{
header("Location:../error.php");
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../stylesheets/header_design.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/generalstylings.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/newtabledesign.css">
<title>
View Faculty
</title>
</head>
<body>
<div class="wrapper">
<?php 
include '../includes/header.php'; ?>
<div id="content" align= 'center'>
<table class="wholetable" width="700px">
<?php
if($course=='all')
{
		echo '<center>
	<hr class="title-cover">
    <span class="caption">Faculty</span>
	 <hr class="title-cover"></center>
	 ';
	echo '<tr>
	<th>Faculty code
	<th>Faculty Name
	
	</tr>';
	$st="select * from teacher inner join faculty_assigned on teacher.id=faculty_assigned.faculty_sr
inner join subject on subject.Sr=faculty_assigned.subject_sr;";
	$res=mysqli_query($conn,$st);
	while($result=mysqli_fetch_assoc($res))
	{

	echo '
	
	<tr>
		
		<td>'.$result['faculty_code'].'
		<td>'.$result['faculty_name'].'
		
	</tr>
	';
	}
	}
else if($branch=='all')
{
		echo '<center>
	<hr class="title-cover">
    <span class="caption">Faculty<br>Course: '.$course.' </span>
	 <hr class="title-cover"></center>
	 ';
	echo '<tr>
	<th>Faculty code
	<th>Faculty Name
	
	</tr>';
	$st="select * distinct from teacher inner join faculty_assigned on teacher.id=faculty_assigned.faculty_sr
inner join subject on subject.Sr=faculty_assigned.subject_sr where course='".$course."';";
	$res=mysqli_query($conn,$st);
	while($result=mysqli_fetch_assoc($res))
	{

	echo '
	
	<tr>
		
		<td>'.$result['faculty_code'].'
		<td>'.$result['faculty_name'].'
		
	</tr>
	';
	}
	
}
else if($sem=='all')
{
		echo '<center>
	<hr class="title-cover">
    <span class="caption">Faculty<br>Course: '.$course.' Branch: '.$branch.'</span>
	 <hr class="title-cover"></center>
	 ';
	echo '<tr>
	<th>Faculty code
	<th>Faculty Name
	
	</tr>';
	$st="select * from teacher inner join faculty_assigned on teacher.id=faculty_assigned.faculty_sr
inner join subject on subject.Sr=faculty_assigned.subject_sr where course='".$course."' and branch='".$branch."';";
	$res=mysqli_query($conn,$st);
	while($result=mysqli_fetch_assoc($res))
	{

	echo '
	
	<tr>
		
		<td>'.$result['faculty_code'].'
		<td>'.$result['faculty_name'].'
		
	</tr>
	';
	}
	
}
else
{
		echo '<center>
	<hr class="title-cover">
    <span class="caption">Faculty<br>Course: '.$course.' Branch: '.$branch.' Sem: '.$sem.'</span>
	 <hr class="title-cover"></center>
	 ';
	echo '<tr>
	<th>Faculty code
	<th>Faculty Name
	
	</tr>';
	$st="select * from teacher inner join faculty_assigned on teacher.id=faculty_assigned.faculty_sr
inner join subject on subject.Sr=faculty_assigned.subject_sr where course='".$course."' and branch='".$branch."' and sem='".$sem."';";
	$res=mysqli_query($conn,$st);
	while($result=mysqli_fetch_assoc($res))
	{

	echo '
	
	<tr>
		
		<td>'.$result['faculty_code'].'
		<td>'.$result['faculty_name'].'
		
	</tr>
	';
	}
	
}

?>
</table>
</div>
</div>
<br>
<br>
<?php include '../includes/footer.php';?>
</body>
</html>