<?php include '../includes/db.php';
session_start();
$course="";
$branch="";
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
$st="select * from subject where course='".$course."' and branch='".$branch."' and sem='".$sem."' order by batch;";
?>
<html>
<head>
<title>
View Student Subjects
</title>
</head>
<link rel="stylesheet" type="text/css" href="../stylesheets/header_design.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/generalstylings.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/newtabledesign.css">
<body>
<div class="wrapper">
<?php 
include '../includes/header.php'; ?>
<div id="content" align= 'center'>
<h2 align="center">
<?php
echo '<center>
	<hr class="title-cover">
    <span class="caption">Course: '.$course.' Branch: '.$branch.' Sem: '.$sem.'</span>
	 <hr class="title-cover"></center>
	 ';
?>

</h2>
<table class="wholetable" width="700px">
<tr>
	<th>Subject Code
	<th>Subject Name
	<th>Class Type
	<th>Batch
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
		
		<td>'.$result['subject_code'].'
		<td>'.$result['subject_name'].'
		<td>'.$result['class_type'].'
		<td>'.$batch.'

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