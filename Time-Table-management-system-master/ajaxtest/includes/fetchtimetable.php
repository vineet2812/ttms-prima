<?php
include 'db.php';
$user=$_GET['user'];
if($user=="student")
{
	$course=$_GET['branch'];
	$branch=$_GET['course'];
	$sem=$_GET['sem'];
	$st="select * from student_timetable inner join subject on student_timetable.subject_sr=subject.Sr
	INNER JOIN teacher on student_timetable.faculty_sr=teacher.id 
	where student_timetable.branch='".$branch."' and student_timetable.course='".$course."' and student_timetable.sem='".$sem."';";
	$res=mysqli_query($conn,$st);
	$jarray=array();
	while($result=mysqli_fetch_array($res))
	{
		if($result!=NULL)
		$jarray[]=$result;
	}
	echo json_encode($jarray);
	
}
else if($user=='faculty')
{
	$faculty_sr=$_GET['faculty_sr'];
	$st="select * from student_timetable inner join subject on student_timetable.subject_sr=subject.Sr
	INNER JOIN teacher on student_timetable.faculty_sr=teacher.id 
	where teacher.id='".$faculty_sr."';";
	$res=mysqli_query($conn,$st);
	$jarray=array();
	while($result=mysqli_fetch_array($res))
	{
		if($result!=NULL)
		$jarray[]=$result;
	}
	echo json_encode($jarray);
}
else
{

}


?>