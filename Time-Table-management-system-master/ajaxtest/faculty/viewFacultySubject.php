<?php include '../includes/db.php';
session_start();

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../stylesheets/header_design.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/generalstylings.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/newtabledesign.css">
<title>
View Faculty Subjects
</title>
</head>
<body>
<div class="wrapper">
<?php 
include '../includes/header.php'; 
$faculty_sr;
if($_SESSION['user']=="faculty")
{
	$faculty_sr=$_SESSION['fsr'];
}
else
{
		header("Location:../error.php");
}
$st="select * from subject where Sr in 
(select subject_sr from faculty_assigned where faculty_sr='".$faculty_sr."');";
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
    <span class="caption">'.$result['faculty_code'].' :: '.$result['faculty_name'].'</span>
	 <hr class="title-cover"></center>
	 ';
		
	}

?>

</h2>
<table class="wholetable" width="700px">
<tr>
	<th>Course
	<th>Branch
	<th>Sem
	<th>Sub Code
	<th>Sub Name
	<th>class type
	<th>Batch
</tr>
<?php
	$res=mysqli_query($conn,$st);
	while($result1=mysqli_fetch_assoc($res))
	{
	$batch="";
	if($result1['batch']=='a')
		$batch="whole class";
	else if($result1['batch']=='p1')
		$batch="batch 1";
	else
		$batch="batch 2";
	echo '
	
	<tr>
		<td>'.$result1['course'].'
		<td>'.$result1['branch'].'
		<td>'.$result1['sem'].'
		<td>'.$result1['subject_code'].'
		<td>'.$result1['subject_name'].'
		<td>'.$result1['class_type'].'
		<td>'.$batch.'

	</tr>
	';
}
?>
</table>
</div>
</div>
<?php include '../includes/footer.php';?>
</body>
</html>