<?php
include 'db.php';
$type=$_GET['type'];
if($type=="setvalue")
{
	$shift=$_GET['s'];
	$day=$_GET['d'];
	$branch=$_GET['branch'];
	$course=$_GET['course'];
	$sem=$_GET['sem'];
	$subject_sr=$_GET['subject_sr'];
	$st="select * from student_timetable where day='".$day."' and shift='".$shift."' and branch='".$branch."' and course='".$course."' and sem='".$sem."';";
	$res=mysqli_query($conn,$st);
		
		while($result=mysqli_fetch_assoc($res))
		{
		/*************
		 at very first we are checking if any subject is already present therer 
		 if yes then we first fetch that subject_sr increase the count by one
		 and then delete the record from that particular entry from tt
		**************/
		
			$st="update subject set class_count=class_count+1 where Sr='".$result['subject_sr']."';";
			$st2="delete from student_timetable where subject_sr='".$result['subject_sr']."' and day='".$day."' and shift='".$shift."';";
			$rest=mysqli_query($conn,$st);
			
			$ret=mysqli_query($conn,$st2);
			
		}
	if($subject_sr!="select")
	{
		$st="update subject set class_count=class_count-1 where Sr='".$subject_sr."';";
		$st1="select * from faculty_assigned where subject_sr='".$subject_sr."';";
		$res=mysqli_query($conn,$st);
		$res=mysqli_query($conn,$st1);
		while($result=mysqli_fetch_assoc($res))
		{
			$st="insert into student_timetable values('','".$day."','".$shift."'
			,'".$result['faculty_sr']."','".$subject_sr."','".$branch."',
			'".$course."','".$sem."');";
			$res=mysqli_query($conn,$st);
		}
	}
	
	
	
}
else
{
	$shift=$_GET['s'];
	$day=$_GET['d'];
	$branch=$_GET['branch'];
	$course=$_GET['course'];
	$sem=$_GET['sem'];
	
	$st="select * from student_timetable where shift='".$shift."' and day='".$day."' and branch='".$branch."' and course='".$course."' and sem='".$sem."';";
	$res=mysqli_query($conn,$st);
	/****************************
		populating all selection box by the previous assigned subjects 
		searching for subjects of branch course sem on that day and shift
		if no lecture found we simple add a select option with no value
		else we will add that subject detail ontime table
	******************************/
	if(mysqli_num_rows($res)==0)
	{
		echo '<option value="select">Select</option>';
	}
	else
	{
		while($result=mysqli_fetch_assoc($res))
		{
			$st="select * from subject where Sr='".$result['subject_sr']."';";
			$rest=mysqli_query($conn,$st);
			while($ress=mysqli_fetch_assoc($rest))
			{
				$batch="";
				if($ress['batch']!='a')
					$batch='('.$ress['batch'].')';
				echo '<option value='.$ress['subject_sr'].' selected>'.$ress['subject_code'].' '.$ress['subject_name'].'('.$ress['class_type'].')'.$batch.'</option>';
			}
		}
		echo '<option value="select">Select</option>';
	}
		$st1="select * from subject inner join
		faculty_assigned on subject.Sr=faculty_assigned.subject_sr 
		where branch = '".$branch."' and course = '".$course."' and sem = '".$sem."' and class_count > 0 ;";
		$res1=mysqli_query($conn,$st1);

		while($result=mysqli_fetch_assoc($res1))
		{
				//echo '<option value="arsh">ARkjbgsh</option>';
			$sst1="select * from student_timetable where shift='".$shift."' and day='".$day."' and
			faculty_sr='".$result['faculty_sr']."';";
			$batch="";
			
			$rest=mysqli_query($conn,$sst1);
			if(mysqli_num_rows($rest)==0)
			{
				if($result['batch']!='a')
					$batch='('.$result['batch'].')';
				echo '<option value="'.$result['subject_sr'].'">'.$result['subject_code'].' '.($result['subject_name']).'('.$result['class_type'].')'.$batch.'</option>';
			}
		}
		

}
?>