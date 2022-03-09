<?php
	$server='localhost';
	$user='root';
	$password='';
	$db='timetable';
	$conn=mysqli_connect($server,$user,$password,$db);
	if(!$conn)
	{
		die("conn fail: ".mysqli_connect_error());
	}
?>