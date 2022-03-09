<?php session_start();?>
<?php

	
	 if($_SESSION['user']!="hod")
	 {
		
		header("Location:../error.php");
	 }
	 
	 ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../stylesheets/generalstylings.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/newtabledesign.css">

<link rel="stylesheet" type="text/css" href="../stylesheets/header_design.css">


<script>
function validateform()
{
	var code=document.getElementById("faculty_code");
	var name=document.getElementById("faculty_name");
	var dep=document.getElementById("dep");
	var ftype=document.getElementById("ftype");
	var pass=document.getElementById("pass");
	if(code.length==0||name.length==0||dep.selectedIndex==0||ftype.selectedIndex==0||pass.length==0)
		return false;
	else
		return true;
}

</script>
<title>Add Faculty</title>
</head>
<body>
<div class="wrapper">
<?php 
include '../includes/header.php';
echo '<center>
	<hr class="title-cover">
    <span class="caption">Add a new Faculty</span>
	 <hr class="title-cover"></center>
	 ';
 ?>
<div id="formbody" align="center">
	<form action="../includes/processRequest.php" onsubmit="return validateform()" method="POST">
	<input type="hidden" name="request_type" value="addFaculty"/>
		<table>
			<tr>
			<td>Faculty Code: </td>
			<td><input type="text" class=" tfield col4" id="faculty_code" name="faculty_code" size="20" required></td>
			</tr>
			<tr>
			<td>Faculty Name: </td>
			<td><input type="text" id="faculty_name" name="faculty_name" class=" tfield col8" size="50" required></td>
			</tr>
			<tr>
			<td>Department: </td>
			<td><select id="dep" name="dep" class="select">
			<option value="select">select</option>
			<option value="Computer Science">Computer Science</option>
			<option value="Computer Science">Civil</option>
			<option value="Computer Science">Mechanical</option>
			<option value="Computer Science">Information Technology</option>
			<option value="Computer Science">Electrical</option>
			</select></td>
			</tr>
			<tr>
			<td>Faculty Type: </td>
			<td><select id="ftype" name="ftype" class="select">
			<option value="select">select</option>
			<option value="Professor">Professor</option>
			<option value="Assitent Professor">Assitent Professor</option>
			<option value="Guest Faculty">Guest Faculty</option>
			<option value="Head of Department">Head of Department</option>
			</select></td>
			</tr>
			<tr>
			<td>Password: </td>
			<td><input type="password" id="pass" name="pass" class=" tfield col8" size="50" required></td>
			</tr>
			<tr align="center">
			<td><input type="Submit" name="Submit" class="col2 btn btn-success"></td>
			<td><input type="Reset" name="Reset" class="col2 btn btn-attention"></td>
			</tr>
		</table>
	</form>
</div>
</div>
<br>
<br>
<?php include '../includes/footer.php';?>
</body>
</html>