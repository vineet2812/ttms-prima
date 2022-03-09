<?php session_start();?>
<?php

	
	 if($_SESSION['user']!="hod")
	 {
		
		header("Location:../error.php");
	 }
	 
	 ?>
<html>
<head>
	<title>HOD Portal</title>
	<style>
	
	</style>
	
	<link rel="stylesheet" type="text/css" href="../stylesheets/Hod_control_panel_design.css">
	<link rel="stylesheet" type="text/css" href="../stylesheets/header_design.css">
	<link rel="stylesheet" type="text/css" href="../stylesheets/generalstylings.css">
	<link href="https://fonts.googleapis.com/css?family=Bungee Shade" rel="stylesheet">
	<script src="../scripts/innerselections.js" type="text/javascript"></script>
	<script>
	function viewbox(boxid)
	{
		document.getElementById(boxid).style.display="block";
	}
	function closebox(boxid)
	{
		document.getElementById(boxid).style.display="none";
	}
	
	</script>
 
</head>
<body>
<div class="wrapper">
<?php  include '../includes/header.php';?>
<div id="add_subject" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <a href="javascript:void(0)" class="close" onclick="closebox('add_subject')">&times;</a>
	<div class="formcontainer">
    <form name="addsubjectform" method="POST" action="./addSubject.php" onsubmit="return validateSel('addsubjectform')">
	<table style="text-align:left; font-size:20px; font-family:Calibri light;" width="100%"  cellspacing="5px">
		<tr><td width="auto">Course: </td>
			<td><select id="course" name="course" name="course" onchange="updatebranch('mandatory','addsubjectform')&updatesem('mandatory','addsubjectform')">
			<option  value="all">select</option>
			</select>
			
			</td>
			</tr>
			<tr>
			<td>Branch: </td>
			<td><select id="branch"  name="branch" name="branch" onchange="updatesem('mandatory','addsubjectform')">
			<option value="select">select</option>
			</select>
			</td>
			</tr>
			<tr>
			<td>Sem: </td>
			<td><select name="sem" id="sem" name="sem">
			<option value="select">select</option>
			</select>
			</td>
		</tr><tr><td></td></tr>
			<tr><td></td></tr>
			<tr><td></td></tr>
		<tr>
			<td align="center" >
				<input type="submit" value="Submit">
			</td>
			<td align="center" >
				<input type="reset" value="Reset">
			</td>
		</tr>
	</table>
	</form>
	</div>
  </div>

</div>
<div id="view_del_subject" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <a href="javascript:void(0)" class="close" onclick="closebox('view_del_subject')">&times;</a>
	<div class="formcontainer">
    <form name="viewdelsubjectform" method="POST" action="./viewHodSubject.php">
	<table style="text-align:left; font-size:20px; font-family:Calibri light;" width="100%"  cellspacing="5px">
		<tr><td>Course: </td>
			<td><select id="course" name="course" onchange="updatebranch('casual','viewdelsubjectform')&updatesem('casual','viewdelsubjectform')">
			<option  value="all">all</option>
			</select>
			
			</td>
			</tr>
			<tr>
			<td>Branch: </td>
			<td><select id="branch" name="branch" onchange="updatesem('casual','viewdelsubjectform')">
			<option value="all">all</option>
			</select>
			</td>
			</tr>
			<tr>
			<td>Sem: </td>
			<td><select id="sem" name="sem">
			<option value="all">all</option>
			</select>
			</td>
		</tr><tr><td></td></tr>
			<tr><td></td></tr>
			<tr><td></td></tr>
		<tr>
			<td align="center" >
				<input type="submit" value="Submit">
			</td>
			<td align="center" >
				<input type="reset" value="Reset">
			</td>
		</tr>
	</table>
	</form>
	</div>
  </div>

</div>
<div id="tt_faculty" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <a href="javascript:void(0)" class="close" onclick="closebox('tt_faculty')">&times;</a>
	<div class="formcontainer">
    <form name="viewttfaculty" method="POST" onsubmit="return validatefac('viewttfaculty')" action="../faculty/faculty_time_table.php">
	<table style="text-align:left; font-size:20px; font-family:Calibri light;" width="100%"  cellspacing="5px">
		<tr><td>Faculty: </td>
			<td><select id="faculty" name="faculty" class="fac">
			<option  value="all">all</option>
			</select>
			
			</td>
			</tr>
			<tr><td></td></tr>
			<tr><td></td></tr>
			<tr><td></td></tr>
		<tr>
			<td align="center" >
				<input type="submit" value="Submit">
			</td>
			<td align="center" >
				<input type="reset" value="Reset">
			</td>
		</tr>
	</table>
	</form>
	</div>
  </div>

</div>
<div id="tt_student" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <a href="javascript:void(0)" class="close" onclick="closebox('tt_student')">&times;</a>
	<div class="formcontainer">
    <form name="student_tt" method="POST" action="../student/student_time_table.php" onsubmit="return validateSel('student_tt')">
	<table style="text-align:left; font-size:20px; font-family:Calibri light;" width="100%"  cellspacing="5px">
		<tr><td>Course: </td>
			<td><select id="course" name="course" onchange="updatebranch('mandatory','student_tt')&updatesem('mandatory','student_tt')">
			<option  value="all">select</option>
			</select>
			
			</td>
			</tr>
			<tr>
			<td>Branch: </td>
			<td><select id="branch" name="branch" onchange="updatesem('mandatory','student_tt')">
			<option value="select">select</option>
			</select>
			</td>
			</tr>
			<tr>
			<td>Sem: </td>
			<td><select id="sem" name="sem">
			<option value="select">select</option>
			</select>
			</td>
		</tr><tr><td></td></tr>
			<tr><td></td></tr>
			<tr><td></td></tr>
		<tr>
			<td align="center" >
				<input type="submit" value="Submit">
			</td>
			<td align="center" >
				<input type="reset" value="Reset">
			</td>
		</tr>
	</table>
	</form>
	</div>
  </div>
</div>
<div id="update_tt_student" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <a href="javascript:void(0)" class="close" onclick="closebox('update_tt_student')">&times;</a>
	<div class="formcontainer">
    <form name="update_student_tt" method="POST" action="./set_time_table.php" onsubmit="return validateSel('update_student_tt')">
	<table style="text-align:left; font-size:20px; font-family:Calibri light;" width="100%"  cellspacing="5px">
		<tr><td>Course: </td>
			<td><select id="course" name="course" onchange="updatebranch('tt','update_student_tt')&updatesem('tt','update_student_tt')">
			<option  value="all">select</option>
			</select>
			
			</td>
			</tr>
			<tr>
			<td>Branch: </td>
			<td><select id="branch" name="branch" name="branch" name="branch" onchange="updatesem('tt','update_student_tt')">
			<option value="select">select</option>
			</select>
			</td>
			</tr>
			<tr>
			<td>Sem: </td>
			<td><select id="sem" name="sem">
			<option value="select">select</option>
			</select>
			</td>
		</tr><tr><td></td></tr>
			<tr><td></td></tr>
			<tr><td></td></tr>
		<tr>
			<td align="center" >
				<input type="submit" value="Submit">
			</td>
			<td align="center" >
				<input type="reset" value="Reset">
			</td>
		</tr>
	</table>
	</form>
	</div>
  </div>
</div>
<div id="new_tt_student" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <a href="javascript:void(0)" class="close" onclick="closebox('new_tt_student')">&times;</a>
	<div class="formcontainer">
    <form name="new_tt_form" method="POST" action="./set_time_table.php" onsubmit="return validateSel('new_tt_form')">
	<table style="text-align:left; font-size:20px; font-family:Calibri light;" width="100%"  cellspacing="5px">
		<tr><td>Course: </td>
			<td><select id="course" name="course" onchange="updatebranch('mandatory','new_tt_form')&updatesem('mandatory','new_tt_form')">
			<option  value="all">select</option>
			</select>
			
			</td>
			</tr>
			<tr>
			<td>Branch: </td>
			<td><select id="branch" name="branch" name="branch" name="branch" onchange="updatesem('mandatory','new_tt_form')">
			<option value="select">select</option>
			</select>
			</td>
			</tr>
			<tr>
			<td>Sem: </td>
			<td><select id="sem" name="sem">
			<option value="select">select</option>
			</select>
			</td>
		</tr><tr><td></td></tr>
			<tr><td></td></tr>
			<tr><td></td></tr>
		<tr>
			<td align="center" >
				<input type="submit" value="Submit">
			</td>
			<td align="center" >
				<input type="reset" value="Reset">
			</td>
		</tr>
	</table>
	</form>
	</div>
  </div>

</div>
<div id="view_all_fac" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <a href="javascript:void(0)" class="close" onclick="closebox('view_all_fac')">&times;</a>
	<div class="formcontainer">
    <form name="allfacultyform" method="POST" action="./viewFacultyassigned.php">
	<table style="text-align:left; font-size:20px; font-family:Calibri light;" width="100%"  cellspacing="5px">
		<tr><td>Course: </td>
			<td><select id="course" name="course" onchange="updatebranch('casual','allfacultyform')& updatesem('casual','allfacultyform')">
			<option  value="all">all</option>
			</select>
			
			</td>
			</tr>
			<tr>
			<td>Branch: </td>
			<td><select id="branch" name="branch" name="branch" name="branch" onchange="updatesem('casual','allfacultyform')">
			<option value="all">all</option>
			</select>
			</td>
			</tr>
			<tr>
			<td>Sem: </td>
			<td><select id="sem" name="sem">
			<option value="all">all</option>
			</select>
			</td>
		</tr><tr><td></td></tr>
			<tr><td></td></tr>
			<tr><td></td></tr>
		<tr>
			<td align="center" >
				<input type="submit" value="Submit">
			</td>
			<td align="center" >
				<input type="reset" value="Reset">
			</td>
		</tr>
	</table>
	</form>
	</div>
  </div>

</div>	
<div id="fac_all_subjects" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <a href="javascript:void(0)" class="close" onclick="closebox('fac_all_subjects')">&times;</a>
	<div class="formcontainer">
    <form name="allfacultysubjects" method="POST" onsubmit="return validatefac('allfacultysubjects')" action="../HOD/viewunallocatesubjects.php">
	<table style="text-align:left; font-size:20px; font-family:Calibri light;" width="100%"  cellspacing="5px">
		<tr><td>Faculty: </td>
			<td><select id="faculty" name="faculty" class="fac">
			<option  value="select">select</option>
			</select>
			
			</td>
			</tr>
			<tr><td></td></tr>
			<tr><td></td></tr>
			<tr><td></td></tr>
		<tr>
			<td align="center" >
				<input type="submit" value="Submit">
			</td>
			<td align="center" >
				<input type="reset" value="Reset">
			</td>
		</tr>
	</table>
	</form>
	</div>
  </div>

</div>	
<div id="assignfaculty" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <a href="javascript:void(0)" class="close" onclick="closebox('assignfaculty')">&times;</a>
	<div class="formcontainer">
    <form name="assignfacultyform" method="POST" action="./assignFaculty.php" onsubmit="return validateSel('assignfacultyform')">
	<table style="text-align:left; font-size:20px; font-family:Calibri light;" width="100%"  cellspacing="5px">
		<tr><td>Course: </td>
			<td><select id="course" name="course" onchange="updatebranch('mandatory','assignfacultyform')&updatesem('mandatory','assignfacultyform')">
			<option  value="all">select</option>
			</select>
			
			</td>
			</tr>
			<tr>
			<td>Branch: </td>
			<td><select id="branch" name="branch" name="branch" name="branch" onchange="updatesem('mandatory','assignfacultyform')">
			<option value="select">select</option>
			</select>
			</td>
			</tr>
			<tr>
			<td>Sem: </td>
			<td><select id="sem" name="sem">
			<option value="select">select</option>
			</select>
			</td>
		</tr><tr><td></td></tr>
			<tr><td></td></tr>
			<tr><td></td></tr>
		<tr>
			<td align="center" >
				<input type="submit" value="Submit">
			</td>
			<td align="center" >
				<input type="reset" value="Reset">
			</td>
		</tr>
	</table>
	</form>
	</div>
  </div>

</div>	
<div id="timeslot" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <a href="javascript:void(0)" class="close" onclick="closebox('timeslot')">&times;</a>
	<div class="formcontainer">
    <form name="timeslotfaculty" method="POST" onsubmit="return validatefac('timeslotfaculty')" action="../HOD/faculty_timeslot.php">
	<table style="text-align:left; font-size:20px; font-family:Calibri light;" width="100%"  cellspacing="5px">
		<tr><td>Faculty: </td>
			<td><select id="faculty" name="faculty" class="fac">
			<option  value="all">all</option>
			</select>
			
			</td>
			</tr>
			<tr><td></td></tr>
			<tr><td></td></tr>
			<tr><td></td></tr>
		<tr>
			<td align="center" >
				<input type="submit" value="Submit">
			</td>
			<td align="center" >
				<input type="reset" value="Reset">
			</td>
		</tr>
	</table>
	</form>
	</div>
  </div>

</div>
	 <center>
	<hr class="title-cover">
    <span class="caption">Head Of Department Control Panel</span>
	 <hr class="title-cover"></center>
	 <br>
	 <br>
<center>
<table cellspacing="30px">
	<tr>
		<td>
			<div class="container img1">
		<div class="title-text">Manage Subjects</div>
		<div class="middle">
		<table class="tt">
		<tr><td class="inner_button"><button onclick="viewbox('add_subject')& updatecourse('mandatory','addsubjectform') " class="button" name="button">Add Subject</button></td></tr>
		<tr><td class="inner_button"><button onclick="viewbox('view_del_subject') & updatecourse('casual','viewdelsubjectform')" class="button" name="button">View/Delete Subject</button></td></tr>
		<tr><td class="inner_button"><button onclick="viewbox('assignfaculty') & updatecourse('mandatory','assignfacultyform')" class="button" name="button">Assign Faculty<br>to a Subject</button></td></tr>
		</table>
		</div>
      </div>
		</td>
		<td width="100px"></td>
		<td >
			<div class="container img2">
		<div class="title-text">Manage TimeTable</div>
		<div class="middle" align="center" bgcolor="red">
		<table class="tt">
		<tr><td class="inner_button"><button onclick="viewbox('tt_faculty') & updatefaculty('viewttfaculty')" class="button" name="button">View TimeTable of Faculty</button></td></tr>
		<tr><td class="inner_button"><button onclick="viewbox('tt_student') & updatecourse('mandatory','student_tt')" class="button" name="button">View TimeTable of Class</button></td></tr>
		<tr><td class="inner_button"><button onclick="viewbox('update_tt_student') & updatecourse('tt','update_student_tt')" class="button" name="button">Update TimeTable of Class</button></td></tr>
		<tr><td class="inner_button"><button onclick="viewbox('new_tt_student') & updatecourse('mandatory', 'new_tt_form')" class="button" name="button">Set New TimeTable</button></td></tr>
		</table>
		</div>
      </div>
		</td>
		<td width="100px"></td>
		<td>
			<div class="container img3" >
	
		<div class="title-text">Manage Faculty</div>
		<div class="middle">
		<table class="tt">
		<tr><td class="inner_button"><button onclick="document.location.href='./addfaculty.php'" class="button" name="button">Add Faculty</button></td></tr>
		<tr><td class="inner_button"><button onclick="document.location.href='./viewdeletefaculty.php'" class="button" name="button">Display/Remove Faculty</button></td></tr>
		<tr><td class="inner_button"><button onclick="viewbox('view_all_fac') & updatecourse('casual','allfacultyform')" class="button" name="button">View/Unassign Faculty<br>Assigned To A Class</button></td></tr>
		<tr><td class="inner_button"><button onclick="viewbox('fac_all_subjects') & updatefaculty('allfacultysubjects')" class="button" name="button">View/Unassign Classes<br>Assigned To A Faculty</button></td></tr>
		<tr><td class="inner_button"><button onclick="viewbox('timeslot') & updatefaculty('timeslotfaculty')" class="button" name="button">Unallocate timeslots<br>of a faculty</button></td></tr>
		
		</table>
		</div>
      </div>
		</td>
	
		
	</tr>
	
</table>
</center>
</div>
<?php include '../includes/footer.php';?>
</body>
</html>