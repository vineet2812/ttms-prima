<?php session_start();

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
<link rel="stylesheet" type="text/css" href="../stylesheets/header_design.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/allocation.css">	
<link rel="stylesheet" type="text/css" href="../stylesheets/generalstylings.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/newtabledesign.css">
<script src="../scripts/dataupdate.js" type="text/javascript">
</script>	
<title>
My page
</title>
<style>
table tr td
{
width:auto;
}

</style>
</head>
<body onload="updateOptions()">
<div class="wrapper" >
<?php 
include '../includes/header.php'; ?>
<?php
	echo '<center>
	<hr class="title-cover">
    <span class="caption">Set Time Table<br>Course: '.$course.' Branch: '.$branch.' Sem: '.$sem.'</span>
	 <hr class="title-cover"></center><br><bro>
	 ';
	echo '
<input type="hidden" id="branch" name="branch" value='.$branch.'>
<input type="hidden" id="course" name="course" value='.$course.'>
<input type="hidden" id="sem" name="sem" value='.$sem.'>
';
?>
<table cellspacing="20px">
<tr>
<th></th>
<th>9:30-10:20</th>
<th>10:20-11:10</th>
<th>11:10-12:00</th>
<th>12:00-12:50</th>
<th></th>
<th>2:00-2:50</th>
<th>2:50-3:40</th>
<th>3:40-4:30</th>
</tr>
<?php
$day=["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
$j=5;
for($i=0;$i<6;$i++)
{
	
	echo '<tr><th>'.$day[$i].'</th>';
	for($j=1;$j<=4;$j++)
	{
	echo '<td id='.($i+1).''.$j.'>
	</td>';
	}
	if($i==0 and $j==5)
		echo '<td rowspan="6">Lunch</td>';
	for($j=5;$j<=7;$j++)
	{
	echo '<td id='.($i+1).''.$j.'>
	</td>';
	}
	echo '</tr>';
}
?>
</table>	
</div>
<br>
<br>
<?php include '../includes/footer.php';?>
</body>
</html>			