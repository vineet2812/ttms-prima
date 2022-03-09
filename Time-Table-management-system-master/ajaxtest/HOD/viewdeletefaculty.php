<?php
include '../includes/db.php';
 session_start();
	
	 if($_SESSION['user']!="hod")
	 {
		
		header("Location:../error.php");
	 }
	 
$st="select * from teacher";
$result=mysqli_query($conn,$st);	
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../stylesheets/generalstylings.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/newtabledesign.css">

<link rel="stylesheet" type="text/css" href="../stylesheets/header_design.css">
<script type="text/javascript">
function deletefac(a)
{
	var mydata=new XMLHttpRequest();
	if(confirm("Removing the faculty from main db will cause all data lost including subject assignments and time slot alloted. it will also affect his/her respective classes. Do you really wish to continue"))
	{
		mydata.open("GET","../includes/processAction.php?request_type=deleteFaculty&faculty_id="+a,false);
		mydata.send(null);
		alert(mydata.responseText);
	}
}
</script>
<title>
Faculty
</title>
</head>
<body>
<div class="wrapper">
<?php 
include '../includes/header.php';
echo '<center>
	<hr class="title-cover">
    <span class="caption">View/Remove a faculty</span>
	 <hr class="title-cover"></center>
	 ';
 ?>
<div id="message" name="message">
</div>
<div id="content" align="center">
<table id="facultytable" width="700px">
<tr>
	<th>Faculty Code
	<th>Faculty	Name
	<th>Department
	<th>Delete
</tr>
<?php
	while($res=mysqli_fetch_assoc($result))
	{
		echo '
		<tr>
			<td> '.$res['faculty_code'].'
			<td> '.$res['faculty_name'].'
			<td> '.$res['department'].'
			<td> <button name="delete" class="col2 btn btn-alert" onclick="deletefac('.$res['id'].')">Remove</Button>
		</tr>
		
		';
	}

?>
</table>
</div >
</div>
<br>
<br>
<?php include '../includes/footer.php';?>
</body>
</html>