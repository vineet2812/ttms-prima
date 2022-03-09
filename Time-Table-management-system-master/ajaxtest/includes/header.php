<?php 

include 'db.php';
?>
<div id="header">
<div class="logo">
<img src="../media/logo.jpg" height="100%" width="100%">
</div>
<div id="title-line">
Shri Ramdeobaba College of Engineering and Management, Nagpur
</div>
<div id="right-content">
<?php

if($_SESSION['user']=="student")
{
	//echo 'Welcome Student<br>';
	echo 'Branch: '.$_SESSION['branch'].'<br>';
	echo 'Course: '.$_SESSION['course'].'<br>';
	echo 'Semester:'.$_SESSION['sem'].'<br>';
	echo '<button class="logout" value="Logout" onclick=document.location.href="../includes/processAction.php?request_type=logout">Log out</button>';
}
else if($_SESSION['user']=="faculty")
{
	$fid=$_SESSION['fid'];
	$st="select * from teacher where faculty_code='".$fid."';";
	$rs=mysqli_query($conn,$st);
	$fname="";
	$ftype="";
	$fdep="";
	while($re=mysqli_fetch_assoc($rs))
	{
		$fname=$re['faculty_name'];
		$ftype=$re['type'];
		$fdep=$re['department'];
	}
	echo 'Faculty ID:'.$fid.'<br>';
	echo 'Name: '.$fname.'<br>';
	echo 'Designation:'.$ftype.'<br>';
	echo 'Department:'.$fdep.'<br>';
	echo '<button class="logout" value="Logout" onclick=document.location.href="../includes/processAction.php?request_type=logout">Log out</button>';
}
else if($_SESSION['user']=="hod")
{
	echo 'Faculty ID:'.$_SESSION['hid'].'<br>';
	echo 'Name: '.$_SESSION['hname'].'<br>';
	echo 'Designation:Head of Department<br>';
	echo 'Department:'.$_SESSION['hdep'].'<br>';
	echo '<button class="logout" value="Logout" onclick=document.location.href="../includes/processAction.php?request_type=logout">Log out</button>';
}
else
{
	header("Location:../index.php");
}
?>
</div>
</div>