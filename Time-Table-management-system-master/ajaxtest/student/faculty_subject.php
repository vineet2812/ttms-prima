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
<script>
function unassignfac(fid,subid)
{
	if(confirm("Unassigning the subject may lead to data loss in timeslots assigned to faculty for particulatr subject it also affects the students timetable. Do you really wish to continue"))
	var mydata=new XMLHttpRequest();
	mydata.open("GET","../includes/processAction.php?request_type=unassignsub&facid="+fid+"&subid="+subid+"",false);
	mydata.send(null);
	
	alert(mydata.responseText);
	
}
</script>
<title>
Faculty-Subject
</title>
</head>
<body>
<div class="wrapper">
<?php 
include '../includes/header.php'; ?>
<div id="content" align= 'center'>
<table class="wholetable" width="900px">
<?php
if($course=='all')
{
		echo '<center>
	<hr class="title-cover">
    <span class="caption">Faculty<-->Subjects</span>
	 <hr class="title-cover"></center>
	 ';
	echo '<tr>
	<th>Course
	<th>Branch
	<th>Sem
	<th>Faculty Code
	<th>Faculty Name
	<th>Subject Code
	<th>Subject Name
	<th>Class type
	<th>Batch
	
	</tr>';
	$st="select distinct * from teacher inner join faculty_assigned on teacher.id=faculty_assigned.faculty_sr
inner join subject on subject.Sr=faculty_assigned.subject_sr;";
	$res=mysqli_query($conn,$st);
	while($result=mysqli_fetch_assoc($res))
	{
	$batch="";
	if($result['batch']=='a')
		$batch="whole class";
	else if($result['batch']=='p1')
		$batch="batch 1";
	else
		$batch="batch 2";
	echo '
	
	<tr>
		<td>'.$result['course'].'
		<td>'.$result['branch'].'
		<td>'.$result['sem'].'
		<td>'.$result['faculty_code'].'
		<td>'.$result['faculty_name'].'
		<td>'.$result['subject_code'].'
		<td>'.$result['subject_name'].'
		<td>'.$result['class_type'].'
		<td>'.$batch.'
		<td>Action
	</tr>
	';
	}
	}
else if($branch=='all')
{
echo '<center>
	<hr class="title-cover">
    <span class="caption">Faculty<-->Subjects<br>Course: '.$course.'</span>
	 <hr class="title-cover"></center>
	 ';
	echo '<tr>

	<th>Branch
	<th>Sem
	<th>Faculty Code
	<th>Faculty Name
	<th>Subject Code
	<th>Subject Name
	<th>Class type
	<th>Batch
	
	</tr>';
	$st="select * from teacher inner join faculty_assigned on teacher.id=faculty_assigned.faculty_sr
inner join subject on subject.Sr=faculty_assigned.subject_sr where course='".$course."';";
	$res=mysqli_query($conn,$st);
	while($result=mysqli_fetch_assoc($res))
	{
	$batch="";
	if($result['batch']=='a')
		$batch="whole class";
	else if($result['batch']=='p1')
		$batch="batch 1";
	else
		$batch="batch 2";
	echo '
	
	<tr>
		
		<td>'.$result['branch'].'
		<td>'.$result['sem'].'
		<td>'.$result['faculty_code'].'
		<td>'.$result['faculty_name'].'
		<td>'.$result['subject_code'].'
		<td>'.$result['subject_name'].'
		<td>'.$result['class_type'].'
		<td>'.$batch.'
		<td><button class="reset" name="reset" onclick="unassignfac('.$result['faculty_sr'].','.$result['Sr'].')">Unassign</button>
	</tr>
	';
	}
}
else if($sem=='all')
{
	echo '<center>
	<hr class="title-cover">
    <span class="caption">Faculty<-->Subjects<br>Course: '.$course.' Branch: '.$branch.'</span>
	 <hr class="title-cover"></center>
	 ';
	echo '<tr>
	<th>Sem
	<th>Faculty Code
	<th>Faculty Name
	<th>Subject Code
	<th>Subject Name
	<th>Class type
	<th>Batch
	<th>Action
	
	</tr>';
	$st="select * from teacher inner join faculty_assigned on teacher.id=faculty_assigned.faculty_sr
inner join subject on subject.Sr=faculty_assigned.subject_sr where course= '".$course."' and branch='".$branch."';";
	$res=mysqli_query($conn,$st);
	while($result=mysqli_fetch_assoc($res))
	{
	$batch="";
	if($result['batch']=='a')
		$batch="whole class";
	else if($result['batch']=='p1')
		$batch="batch 1";
	else
		$batch="batch 2";
	echo '
	
	<tr>
	
		<td>'.$result['sem'].'
		<td>'.$result['faculty_code'].'
		<td>'.$result['faculty_name'].'
		<td>'.$result['subject_code'].'
		<td>'.$result['subject_name'].'
		<td>'.$result['class_type'].'
		<td>'.$batch.'
		<td><button class="reset" name="reset" onclick="unassignfac('.$result['faculty_sr'].','.$result['Sr'].')">Unassign</button>
	</tr>
	';
	}
}
else
{
	echo '<center>
	<hr class="title-cover">
    <span class="caption">Faculty<-->Subjects<br>Course: '.$course.' Branch: '.$branch.' Sem: '.$sem.'</span>
	 <hr class="title-cover"></center>
	 ';
	echo '<tr>
	<th>Faculty Code
	<th>Faculty Name
	<th>Subject Code
	<th>Subject Name
	<th>Class type
	<th>Batch
	
	
	</tr>';
	$st="select * from teacher inner join faculty_assigned on teacher.id=faculty_assigned.faculty_sr
inner join subject on subject.Sr=faculty_assigned.subject_sr where
course='".$course."' and branch='".$branch."' and sem='".$sem."';";
	$res=mysqli_query($conn,$st);
	while($result=mysqli_fetch_assoc($res))
	{
	$batch="";
	if($result['batch']=='a')
		$batch="whole class";
	else if($result['batch']=='p1')
		$batch="batch 1";
	else
		$batch="batch 2";
	echo '
	
	<tr>
		
		<td>'.$result['faculty_code'].'
		<td>'.$result['faculty_name'].'
		<td>'.$result['subject_code'].'
		<td>'.$result['subject_name'].'
		<td>'.$result['class_type'].'
		<td>'.$batch.'
		
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