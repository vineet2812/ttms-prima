<?php include '../includes/db.php';
session_start();

	 if($_SESSION['user']!="hod")
	 {
		
		header("Location:../error.php");
	 }
$fid=$_POST['faculty'];


?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../stylesheets/generalstylings.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/newtabledesign.css">

<link rel="stylesheet" type="text/css" href="../stylesheets/header_design.css">
<script>
function freetimeslot(fid,sid,d,s,col)
{
	alert("error");
	var mydata=new XMLHttpRequest();
	mydata.open("GET","../includes/processAction.php?request_type=unallocate&facid="+fid+"&subid="+sid+"&day="+d+"&shift="+s+"&col="+col,false);
	mydata.send(null);
	alert(mydata.responseText);
}
</script>
<link rel="stylesheet" type="text/css" href="../stylesheets/header_design.css">
<title>
</title>
</head>
<body>
<div class="wrapper">
<?php 
include '../includes/header.php';

 ?>
	<?php
	
	$st1="select * from teacher where id='".$fid."';";
	$res=mysqli_query($conn,$st1);
	while($result=mysqli_fetch_assoc($res))
	{
	echo '<center>
	<hr class="title-cover">
    <span class="caption">'.$result['faculty_code']." :: ".$result['faculty_name'].'</span>
	 <hr class="title-cover"></center><br>
	 ';
		
	}
	$days=['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
	$shift=['9:30-10:20','10:20-11:10','11:10-12:00','12:00-12:50','02:00-02:50','02:50-03:40','03:40-04:30'];
	$st="select * from student_timetable inner join subject on student_timetable.subject_sr=subject.Sr where faculty_sr='".$fid."';";
	$rs=mysqli_query($conn,$st);
	?>
	<table align="center" width="1000px">
		<tr>
			<th>Branch
			<th>Course
			<th>Semester
			<th>Subject code
			<th>Subject Name
			<th>day
			<th>shift
			<th>class type
			<th>batch
			<th>Action
			
		</tr>
		<?php
			while($re=mysqli_fetch_assoc($rs))
			{
				echo'
				<td>'.$re['branch'].'
				<td>'.$re['course'].'
				<td>'.$re['sem'].'
				<td>'.$re['subject_code'].'
				<td>'.$re['subject_name'].'
				<td>'.$days[$re['day']-1].'
				<td>'.$shift[$re['shift']-1].'
				<td>'.$re['class_type'].'
				<td>'.$re['batch'].'
				<td><button class="reset" value="reset" onclick="freetimeslot('.$fid.','.$re['Sr'].','.$re['day'].','.$re['shift'].','.$re['col'].')">UnAllocate</button>
				
				</tr>
				
				
				';
			}
		
		
		?>
	</table>
	</div>
<br>
<br>
<?php include '../includes/footer.php';?>

</body>
</html>