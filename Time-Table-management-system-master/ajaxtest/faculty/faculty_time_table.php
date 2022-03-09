<?php
include '../includes/db.php';
session_start();
$faculty_sr;
if($_SESSION['user']=="faculty")
{
	$faculty_sr=$_SESSION['fsr'];
}
else if($_SESSION['user']=="hod")
{
	$faculty_sr=$_POST['faculty'];
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
		var faculty_sr=document.getElementById('faculty_sr').value;
		mydata.open("GET","../includes/fetchtimetable.php?user=faculty&faculty_sr="+faculty_sr,false);
		mydata.send(null);
		var jcontent=JSON.parse(mydata.responseText);
		for(var data in jcontent)
		{
			field=document.getElementById(jcontent[data].day+""+jcontent[data].shift);
			var batch=jcontent[data].batch;
			if (batch=='a')
				batch='';
			else
				batch='('+jcontent[data].batch;+')';

			field.innerHTML=(jcontent[data].subject_code+" "+jcontent[data].subject_name+'('+jcontent[data].class_type+')'+batch+'<br>'+jcontent[data].course+" "+jcontent[data].branch+" "+jcontent[data].sem);
		}
		console.log(jcontent);
}

</script>
<link rel="stylesheet" type="text/css" href="../stylesheets/tabledesign.css">
<title>Time Table</title>
</head>
<body onload="myfunction();">
<input type="hidden" id="faculty_sr" value="<?php echo $faculty_sr;?>">

<center>
<h2>
Kamla Nehru Institute of Technology<br>
Time Table <br>
<?php
$st="select * from teacher where id='".$faculty_sr."';";
$result=mysqli_query($conn,$st);
while($res=mysqli_fetch_assoc($result))
{
	echo 'Faculty code: '.$res['faculty_code'].' , Faculty Name: '.$res['faculty_name'];
}
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
		echo '<td rowspan="6" border="1">Lunch</td>';
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