<?php include '../includes/db.php';
session_start();
	 
	 if($_SESSION['user']!="hod")
	 {
		
		header("Location:../error.php");
	 }
$faculty_sr=$_POST['faculty'];
$st="select * from subject where Sr in 
(select subject_sr from faculty_assigned where faculty_sr='".$faculty_sr."');";
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../stylesheets/generalstylings.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/newtabledesign.css">

<link rel="stylesheet" type="text/css" href="../stylesheets/header_design.css">
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
View Faculty Subjects
</title>
</head>
<body>
<div class="wrapper">
<?php 
include '../includes/header.php';

 ?>
<div id="content" align= 'center'>
<h2>
<?php
	$st1="select * from teacher where id='".$faculty_sr."';";
	$res=mysqli_query($conn,$st1);
	while($result=mysqli_fetch_assoc($res))
	{
	echo '<center>
	<hr class="title-cover">
    <span class="caption">'.$result['faculty_code']." :: ".$result['faculty_name'].'</span>
	 <hr class="title-cover"></center>
	 ';
		
	}

?>

</h2>
<table class="wholetable" width="900px">
<tr>
	<th>Course
	<th>Branch
	<th>Sem
	<th>Sub Code
	<th>Sub Name
	<th>class type
	<th>Batch
	<th>Action
</tr>
<?php
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
		<td><button class="reset" name="reset" onclick="unassignfac('.$faculty_sr.','.$result['Sr'].')">Unassign</button>
	</tr>
	';
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