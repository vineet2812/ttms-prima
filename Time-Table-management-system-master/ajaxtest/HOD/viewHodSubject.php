<?php include '../includes/db.php';
 session_start();

$course="";
$branch="";
$sem="";
	
	 if($_SESSION['user']!="hod")
	 {
		header("Location:../error.php");
	 }
	 else
	 {
		$branch=$_POST['branch'];
		$course=$_POST['course'];
		$sem=$_POST['sem'];
	 
	 }
	 
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../stylesheets/generalstylings.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/newtabledesign.css">

<link rel="stylesheet" type="text/css" href="../stylesheets/header_design.css">
<script type="text/javascript">
function remclass(sr)
{
	if(confirm("Removing the subject from main db may cause alteration in timetable of both faculty and student.Do you really wish to continue."))
	
	{
	var mydata=new XMLHttpRequest();
	mydata.open("GET","../includes/processAction.php?request_type=removeSubject&subject_sr="+sr,false);
	mydata.send(null);
	alert(mydata.responseText);
	}
}
</script>
<title>
View Student Subjects
</title>
</head>
<body>
<div class="wrapper">
<?php 
include '../includes/header.php'; ?>
<div id="content" align= 'center'>
<table class="wholetable" width="1000px">
<?php
if($course=='all')
{
		echo '<center>
	<hr class="title-cover">
    <span class="caption">Subjects</span>
	 <hr class="title-cover"></center>
	 ';
	echo '<tr>
	<th>Course
	<th>Branch
	<th>Sem
	<th>Subject Code
	<th>Subject Name
	<th>Class Type
	<th>Batch
	<th>Remove
	</tr>';
	$st="select * from subject order by batch;";
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
		<td>'.$result['subject_code'].'
		<td>'.$result['subject_name'].'
		<td>'.$result['class_type'].'
		<td>'.$batch.'
		<td><Button class="col2 btn btn-error" value="remove" onclick="remSubject('.$result['Sr'].')">Remove</Button>

	</tr>
	';
	}
	}
else if($branch=='all')
{
	echo '<center>
	<hr class="title-cover">
    <span class="caption">Subjects<br>Course: '.$course.'</span>
	 <hr class="title-cover"></center>
	 ';
	echo '<tr>
	<th>Branch
	<th>Sem
	<th>Subject Code
	<th>Subject Name
	<th>Class Type
	<th>Batch
	<th>Remove
	</tr>';
	$st="select * from subject where course='".$course."' order by batch;";
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
		<td>'.$result['subject_code'].'
		<td>'.$result['subject_name'].'
		<td>'.$result['class_type'].'
		<td>'.$batch.'
		<td><Button class="col2 btn btn-error" onclick="remclass('.$result['Sr'].')">Remove</Button>

	</tr>
	';
	}
}
else if($sem=='all')
{
	echo '<center>
	<hr class="title-cover">
    <span class="caption">Subjects<br>Course: '.$course.' Branch: '.$branch.'</span>
	 <hr class="title-cover"></center>
	 ';
	echo '<tr>
	<th>Sem
	<th>Subject Code
	<th>Subject Name
	<th>Class Type
	<th>Batch
	<th>Remove
	</tr>';
	$st="select * from subject where course='".$course."' and branch='".$branch."' order by batch;";
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
		<td>'.$result['subject_code'].'
		<td>'.$result['subject_name'].'
		<td>'.$result['class_type'].'
		<td>'.$batch.'
		<td><Button class="col2 btn btn-error" onclick="remclass('.$result['Sr'].')">Remove</Button>

	</tr>
	';}
}
else
{
	echo '<center>
	<hr class="title-cover">
    <span class="caption">Subjects<br>Course: '.$course.' Branch: '.$branch.' Sem: '.$sem.'</span>
	 <hr class="title-cover"></center>
	 ';
	echo '<tr>
	<th>Subject Code
	<th>Subject Name
	<th>Class Type
	<th>Batch
	<th>Remove
	</tr>';
	$st="select * from subject where course='".$course."' and branch='".$branch."' and sem='".$sem."' order by batch;";
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
		
		<td>'.$result['subject_code'].'
		<td>'.$result['subject_name'].'
		<td>'.$result['class_type'].'
		<td>'.$batch.'
		<td><Button onClick="remclass('.$result['Sr'].')" class="col2 btn btn-error">Remove</Button>

	</tr>
	';}
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