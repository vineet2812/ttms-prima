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
<link rel="stylesheet" type="text/css" href="../stylesheets/header_design.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/newtabledesign.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/generalstylings.css">
<style>

.card
{
	float:left;
	width:48%;
	height:auto;
	margin-left:1%;
	
	border:2px solid white;
}

tdd
{
	text-align:center;
}
</style>
<title>Assign Subject</title>
</head>
<body>
<div class="wrapper">
<?php
include '../includes/header.php';
echo'
 <center>
	<hr class="title-cover">
    <span class="caption">Course: '.$course.' Branch: '.$branch.' Sem: '.$sem.'</span>
	 <hr class="title-cover"></center>';
//echo '<center><h2>Course: '.$course.' Branch: '.$branch.' Sem: '.$sem.'</h2></center><hr><hr>'
?>

<div id="content" display="flex-box" align="center" justify content="center">
	<form action="../includes/processRequest.php" method="POST">
		<?php echo '<input type="hidden" name="branch" value="'.$branch.'"/>
	<input type="hidden" name="course" value="'.$course.'"/>
	<input type="hidden" name="sem" value="'.$sem.'"/>
	<input type="hidden" name="request_type" value="assignFaculty"/>
	';?>
		<table  width="25%">
		<tr>
		<th>Fields</th>
		<th>Values</th>
		</tr>
			<tr align="left">
			<td align="left">Faculty : </td>
			<td align="left"><select class=" tfield col4" id="faculty_sr" name="faculty_sr" >
			<option value="select">select</option>
				<?php
					$st="Select * from teacher;";
					$res=mysqli_query($conn,$st);
					
					while($result=mysqli_fetch_assoc($res))
					{
				
					echo '<option value="'.$result['id'].'">'.$result['faculty_code'].' , '.$result['faculty_name'].'</option>';
					}
					
				?>
				
				</select>
				
			</td>
			</tr>
			<tr>
			<td align="left">Subject : </td>
			<td align="left"><select name="subject_code" class=" tfield col4" >
			<option value="select">select</option>
				<?php
					$st="Select distinct subject_code,subject_name from subject where branch='".$branch."' and course='".$course."' and sem='".$sem."' ;";
					$res=mysqli_query($conn,$st);
					
					while($result=mysqli_fetch_assoc($res))
					{
				
					echo '<option value="'.$result['subject_code'].'">'.$result['subject_code'].' , '.$result['subject_name'].'</option>';
					}
					
				?>
			</select>
			</td>
			</tr>
			<tr>
			<td align="left">Class type: </td>
			<td align="left" ><select name="class_type" class=" tfield col2" >
				<option value="select">Select</option>
				<option value="l">Lecture</option>
				<option value="t">Tutorial</option>
				<option value="p">Practical</option>
			</select>
			</td>
			</tr>
			<tr>
			<td align="left">Batch: </td>
			<td align="left"><select name="batch" class=" tfield col2" >
				<option value="select">Select</option>
				<option value="a">Whole class</option>
				<option value="p1">Batch 1(p1)</option>
				<option value="p2">Batch 2(p2)</option>
			</select>
			</td>
			</tr>
			
			<tr align="center">
			<td><input type="Submit" name="Submit" class="col2 btn btn-success"></td>
			<td><input type="Reset" name="Reset" class="col2 btn btn-attention"></td>
			</tr>
		</table>
	</form>
</div>
<br>
<hr>
<hr>
<br>
<div>
	<div class="card">
	
		
		<?php
		echo'
 <center>
	<hr class="title-cover">
    <span class="caption">Subject Left to be Assigned</span>
	 <hr class="title-cover"></center>';
		$st="select subject_code,subject_name,class_type,batch from subject left join faculty_assigned on subject.Sr=faculty_assigned.subject_sr where branch='".$branch."' and course='".$course."' and sem='".$sem."' and faculty_assigned.subject_sr is null;";
		$re=mysqli_query($conn,$st);
		echo '<table width="100%" >
		<tr>
			<th>Subject Code
			<th>Subject Name
			<th>Class Type
			<th>Batch
		</tr>
		
		';
		while($rs=mysqli_fetch_assoc($re))
		{
			echo '<tr>
			<td align="center">'.$rs['subject_code'].'
			<td align="center">'.$rs['subject_name'].'
			<td align="center">'.$rs['class_type'].'
			<td align="center">'.$rs['batch'].'
			</tr>';
		}
		echo'</table>';
		?>
	</div>
	<div class="card">
		
		
		<?php
		echo '
		<center>
	<hr class="title-cover">
    <span class="caption">Subject Already assigned</span>
	 <hr class="title-cover"></center>';
		$st="select * from subject right outer join faculty_assigned on subject.Sr=faculty_assigned.subject_sr where branch='".$branch."' and course='".$course."' and sem='".$sem."';";
		$re=mysqli_query($conn,$st);
		echo '<table width="100%" >
		<tr>
			<th>Subject Code
			<th>Subject Name
			<th>Faculty Code
			<th>Faculty Name
			<th>Class Type
			<th>Batch
		</tr>
		
		';
		while($rs=mysqli_fetch_assoc($re))
		{
		$st="select * from teacher where id='".$rs['faculty_sr']."';";
		$re1=mysqli_query($conn,$st);
		while($res=mysqli_fetch_assoc($re1))
		{
			echo '<tr>
			<td align="center">'.$rs['subject_code'].'
			<td align="center">'.$rs['subject_name'].'
			<td align="center">'.$res['faculty_code'].'
			<td align="center">'.$res['faculty_name'].'
			<td align="center">'.$rs['class_type'].'
			<td align="center">'.$rs['batch'].'
			</tr>';
		}
		}
		echo'</table>';
		?>
	</div>
</div>
</div>
<br>
<br>
<?php include '../includes/footer.php';?>



</body>
</html>