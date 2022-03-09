<?php
include '../includes/db.php';
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
else if($_SESSION['user']=="hod")
{
	$branch=$_POST['branch'];
	$course=$_POST['course'];
	$sem=$_POST['sem'];
}

else
{
header("Location:../error.php");
}
$days=["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
?>
<html>
<head>
<script type="text/javascript">
function myfunction()
{
		var field="";
		var mydata=new XMLHttpRequest();
		var course=document.getElementById('course').value;
		var branch=document.getElementById('branch').value;
		var sem=document.getElementById('sem').value;
		mydata.open("GET","../includes/fetchtimetable.php?user=student&branch="+branch+"&course="+course+"&sem="+sem,false);
		mydata.send(null);
		var jcontent=JSON.parse(mydata.responseText);
		for(var data in jcontent)
		{
			field=document.getElementById(jcontent[data].day+""+jcontent[data].shift);
			var batch=jcontent[data].batch;
			
			if (batch=='a')
				batch='';
			else
				batch='('+jcontent[data].batch+')';
			if(field.value==undefined)
			{
				alert("no data found at"+jcontent[data].day+" "+jcontent[data].shift+" "+field.value);
				//field.value="hello";
				field.value=(jcontent[data].subject_code+" "+(jcontent[data].shortform)+'('+jcontent[data].class_type+')'+batch+'<br>'+jcontent[data].faculty_code);
				alert("data inserted "+field.value+" at "+jcontent[data].day+" "+jcontent[data].shift);
				field.innerHTML=field.value;
			}
			else
			{
			alert("data found: "+field.value);
				field.innerHTML=field.value+'<hr>'+(jcontent[data].subject_code)+" "+(jcontent[data].shortform+'('+jcontent[data].class_type+')'+batch+'<br>'+jcontent[data].faculty_code);
			}
		}
		console.log(jcontent);
}

</script>
<style>
.cols
{
	font-size:12px;
	font-family:Calibri;
}
</style>
<link rel="stylesheet" type="text/css" href="../stylesheets/tabledesign.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/header_design.css">
<title>Time Table</title>
</head>
<body onload="myfunction();">
<input type="hidden" id="branch" value="<?php echo $branch;?>">
<input type="hidden" id="course" value="<?php echo $course;?>">
<input type="hidden" id="sem" value="<?php echo $sem;?>">
<center>
<h2>
Shri Ramdeobaba College of Engineering and Management<br>
Time Table <br>
<?php
echo 'Branch: '.$branch.' , Course: '.$course.' , Sem: '.$sem;
?>
</h2>
</center>
<div id="content">
<table cellspacing="10px">
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
$j=5;
for($i=0;$i<6;$i++)
{
	
	echo '<tr class="rows"><th>'.$days[$i].'</th>';
	for($j=1;$j<=4;$j++)
	{
	echo '<td class ="cols" id="'.($i+1).''.$j.'">
	</td>';
	}
	if($i==0 and $j==5)
		echo '<td rowspan="6" border="2px solid black">Lunch</td>';
	for($j=5;$j<=7;$j++)
	{
	echo '<td class="cols" id="'.($i+1).''.$j.'">
		
	</td>';
	}
	echo '</tr>';
}
?>
</table>
</div>
</body>
</html>