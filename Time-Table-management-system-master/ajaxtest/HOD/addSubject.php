<?php
include '../includes/db.php';
?>
<?php session_start();?>
<?php
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
<style>

#sub
{
margin-left:auto;
margin-right:auto;
width:800px;

}

</style>
<title>Add Subject</title>
</head>
<body>
<div class="wrapper">
<?php 
include '../includes/header.php'; 
echo '<center>
	<hr class="title-cover">
    <span class="caption">Course: '.$course.' Branch: '.$branch.' Sem: '.$sem.'</span>
	 <hr class="title-cover"></center>
	 ';
?>
<div id="content" display="flexbox" align="center">
	<form action="../includes/processRequest.php" method="POST">
	<?php echo '<input type="hidden" name="branch" value="'.$branch.'"/>
	<input type="hidden" name="course" value="'.$course.'"/>
	<input type="hidden" name="sem" value="'.$sem.'"/>
	<input type="hidden" name="request_type" value="addSubject"/>
	';?>
		<table>
			<tr>
			<td>Subject Code: </td>
			<td><input type="text" class=" tfield col4" name="subject_code" size="20" required></td>
			</tr>
			<tr>
			<td>Subject Name: </td>
			<td><input type="text" name="subject_name" class=" tfield col8" size="50" required></td>
			</tr>
			<tr>
			<td>Subject Abbreviation: </td>
			<td><input type="text" name="shortform" class=" tfield col8" size="50" required></td>
			</tr>
			<tr>
			<td>Lecture Count: </td>
			<td><input type="number" name="class_count" class=" tfield col2" size="10" required></td>
			</tr>
			<tr>
			<td>Class Type: </td>
			<td><select name="class_type" class="col2 tfield">
			<option value="l">Lecture</option>
			<option value="t">Tutorial</option>
			<option value="p">Practical</option>
			</select>
			</td>
			</tr>
			<tr>
			<td>Batch: </td>
			<td><select name="batch" class="col2 tfield">
			<option value="a">Whole class</option>
			<option value="p1">Batch 1(p1)</option>
			<option value="p2">Batch 2(p2)</option>
			</select></td>
			</tr>
			<tr align="center">
			
			<td></td>
			<td><input type="Submit" name="Submit" class="col2 btn btn-success"><span width="100px">    </span>
			<input type="Reset" name="Reset" class="col2 btn btn-attention"></td>
			</tr>
		</table>
	</form>
</div>
<div>
	<div id="data">
	<hr>
	<hr>
	<?php
	echo '<center>
	<hr class="title-cover">
    <span class="caption">Current subjects for class</span>
	 <hr class="title-cover"></center>
	 ';?>
	<br>
		<table id="sub">
		<tr>
			<th>Subject Code
			<th>Abbreviation
			<th>Subject Name
			<th>Class Type
			<th>Batch
		</tr>
		<?php
			$st="select * from subject where branch='".$branch."' and course='".$course."' and sem='".$sem."' ;";
			$re=mysqli_query($conn,$st);
			while($res=mysqli_fetch_assoc($re))
			{
				echo '<td align="center">'.$res['subject_code'].'
				<td align="center">'.$res['shortform'].'
				<td align="center">'.$res['subject_name'].'
				<td align="center">'.$res['class_type'].'
				<td align="center">'.$res['batch'].'</tr>';
			}
		?>
		</table>
	</div>
</div>
</div>
<br>
<br>
<?php include '../includes/footer.php';?>
</body>
</html>