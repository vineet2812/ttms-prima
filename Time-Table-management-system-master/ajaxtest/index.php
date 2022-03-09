<?php session_start();
	  session_destroy();
	  session_start();
?>
<html>
<head>
	<title>Welcome</title>
	<link href='https://fonts.googleapis.com/css?family=Bungee Shade' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="./stylesheets/index_design.css">
	<link rel="stylesheet" type="text/css" href="./stylesheets/generalstylings.css">
	<link rel="stylesheet" type="text/css" href="./stylesheets/header_design.css">
	<script src="./scripts/selections.js" type="text/javascript"></script>

</head>


<style>
.login
{
	margin-left:auto;
	margin-right:auto;
	height:500px;
	position:relative;
	width:400px;
	background-color:white;
	border-radius:5px;
	transform:translate(0% , -30%);
}

.icon
{
	position:relative;
	margin-left:auto;
	margin-right:auto;
	transform:translate(0%,-50%);
	height:100px;
	width:100px;
	border:1px solid black;
	border-radius:100px;
	overflow:hidden;
}

.logincontent
{
	margin-left:auto;
	margin-right:auto;
	position:relative;
	top:60px;
	width:90%;
	border:1px solid black;
}
</style>
<div class="wrapper">
<body margin-bottom="-100px">
<div id="header">
<div class="logo">
<img src="./media/logo.jpg" height="100%" width="100%">
</div>
<div id="title-line">
Shri Ramdeobaba College of Engineering and Management, Nagpur
</div>
<div id="right-content" >
Welcome User, Please Login
</div>
</div>
	    <center>
	<hr class="title-cover-main">
    <span class="caption-main">TimeTable Management</span>
	 <hr class="title-cover-main"></center>
	 <br>
	 <br>
<center>	    
<div class="container">
  <img src="media/faculty.jpg" alt="Avatar" class="image" style="width:100%">
  <div class="middle">
  <button class="button"><span style="cursor:pointer" onclick="openNav('FACULTY')"> FACULTY</span><img src=""></button>
  </div>
</div>
<div class="container">
  <img src="./media/student.jpg" alt="Avatar" class="image" style="width:100%">
  <div class="middle">
    <button class="button"><span style="cursor:pointer" onclick="openNav('STUDENT') & updatecourse('mandatory','classselection')"> STUDENT</span></button>
  </div>
</div>
<div class="container">
  <img src="./media/hod.jpg" alt="Avatar" class="image" style="margin-top:10px;width:90%;height:90%">
  <div class="middle">
    <button class="button"><span style="cursor:pointer" onclick="openNav('HOD')"> ADMIN LOGIN </span> <img src=""></button>	   
  </div>
</div>



</center>
<!--HOD login Overlay start here!-->
<div id="HOD" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav('HOD')">&times;</a>
  <div class="overlay-content">
   <div class="login">
	<br>
	<hr>
	<center>
    <span style="color: red;">ADMIN LOGIN PAGE</span>
    </center>
	<hr>
	<div id="background">
	</div>
	<div class="logincontent">
	<div class="icon">
	<img src="./media/hod.jpg" height="100%"  width="100%">
	</div>

	<form name="hodlogin" method="POST" action="./HOD/hod_control_panel.php" onsubmit="return validatehodlogin('hodlogin')">
	<table style="text-align:left; font-size:20px; font-family:Calibri light;" width="100%"  cellspacing="5px">
		<tr><td align="center"colspan="2"><div id="msg"></div></td></tr>
		<tr><td>Admin Id: </td>
			<td><input type="text" id="hid" placeholder="Enter hod id" />
			</td>
			</tr><tr><td>Password: </td>
			<td><input type="password" id="pass" placeholder="Enter password" />
			</td>
			</tr>
		<tr></tr>
		<tr></tr>
		<tr>
			<td align="center" colspan="2">
				<input type="submit" value="Submit">
			</td>
			
		</tr>
	</table>
	</form>
<br>

	</div>
	</div>
	</div>
    

  </div>



<center></center>

<!--FACULTY login Overlay start here!-->
<div id="FACULTY" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav('FACULTY')">&times;</a>
  <div class="overlay-content">
   <div class="login">
	<br>
	<hr>
	<center>
    <span style="color: red;">FACULTY LOGIN PAGE</span>
    </center>
	<hr>
	<div id="background">
	</div>
	<div class="logincontent">
	<div class="icon">
	<img src="./media/faculty.jpg" height="100%"  width="100%">
	</div>

	<form name="facultylogin" method="POST" action="./faculty/faculty_control_panel.php" onsubmit="return validatefaclogin('facultylogin')">
	<table style="text-align:left; font-size:20px; font-family:Calibri light;" width="100%"  cellspacing="5px">
		<tr><td align="center"colspan="2"><div id="msg"></div></td></tr>
		<tr><td>Faculty Id: </td>
			<td><input type="text" id="facultyid" class="fac" placeholder="Enter faculty id" />
			</td>
			</tr>
		<tr></tr>
		<tr></tr>
		<tr>
			<td align="center" colspan="2">
				<input type="submit" value="Submit">
			</td>
			
		</tr>
	</table>
	</form>
<br>

	</div>
	</div>
	</div>
    

  </div>


<center></center>

<!--Student login Overlay start here!-->
<div id="STUDENT" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav('STUDENT')">&times;</a>
  <div class="overlay-content">
  
	<div class="login">
	<br>
	<hr>
	<center>
    <span style="color: red;">STUDENT LOGIN PAGE</span>
    </center>
	<hr>
	<div id="background">
	</div>
	<div class="logincontent">
	<div class="icon">
	<img src="./media/student.jpg" height="100%"  width="100%">
	</div>

	<form name="classselection" method="POST" action="./student/Student_control_panel.php" onsubmit="return validateSel('classselection')">
	<table style="text-align:left; font-size:20px; font-family:Calibri light;" width="100%"  cellspacing="5px">
		<tr><td align="center"colspan="2"><div id="msg"></div></td></tr>
		<tr><td>Course: </td>
			<td><select id="course" name="course" onchange="updatebranch('mandatory','classselection')&updatesem('mandatory','classselection')">
			<option  value="all">select</option>
			</select>
			
			</td>
			</tr>
			<tr>
			<td>Branch: </td>
			<td><select id="branch" name="branch" onchange="updatesem('mandatory','classselection')">
			<option value="select">select</option>
			</select>
			</td>
			</tr>
			<tr>
			<td>Sem: </td>
			<td><select name="sem" id="sem">
			<option value="select">select</option>
			</select>
			</td>
		</tr>
		<tr></tr>
		<tr></tr>
		<tr>
			<td align="center" colspan="2">
				<input type="submit" value="Submit">
			</td>
			
		</tr>
	</table>
	</form>
<br>

	</div>
	</div>
	</div>
  </div>
</div>
<center></center>
<script>


function closeNav(id) {
  document.getElementById(id).style.width = "0%";
}

function openNav(id) {
  document.getElementById(id).style.width = "100%";
}
</script>
</div>
<?php include './includes/footer.php';?>
</body>

</html>