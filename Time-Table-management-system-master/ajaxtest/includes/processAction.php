<?php include 'db.php';
session_start();
	$req=$_GET['request_type'];
	if($req=="deleteFaculty")
	{
		$faculty_sr=$_GET['faculty_id'];
		$st="select subject_sr from student_timetable where faculty_sr='".$faculty_sr."';";
		$res=mysqli_query($conn,$st);
		while($re=mysqli_fetch_assoc($res))
		{
			$st1="select * from subject where Sr='".$re['subject_sr']."';";
			$re1=mysqli_query($conn,$st1);
			while($rs1=mysqli_fetch_assoc($re1))
			{
				if($rs1['class_type']=='p')
				{
					$st2="update subject set class_count='1' where Sr='".$rs1['Sr']."';";
					mysqli_query($conn,$st2);
				}
				else
				{
					$st2="update subject set class_count=class_count+1 where Sr='".$rs1['Sr']."';";
					mysqli_query($conn,$st2);
				}
			}
		}
		
			$sql="delete from student_timetable where faculty_sr='".$faculty_sr."';";
			mysqli_query($conn,$sql);
			$sql="delete from faculty_assigned where faculty_sr='".$faculty_sr."';";
			mysqli_query($conn,$sql);
			$sql="delete from teacher where id='".$faculty_sr."';";
			$res=mysqli_query($conn,$sql);
			if($res==false)
				echo 'Error in Removing Faculty you might have trying to remove a faculty who is corrently assigned to any class make sure you set the faculty free from all his duty first';
			else
				echo 'Faculty Remove success please refresh the page for the updated content';
	}
	else if($req=='removeSubject')
	{
		$sr=$_GET['subject_sr'];
		$st="delete from student_timetable where subject_sr='".$sr."';";
		$res=mysqli_query($conn,$st);
		$st="delete from faculty_assigned where subject_sr='".$sr."';";
		$res=mysqli_query($conn,$st);
		$st="delete from subject where Sr='".$sr."';";
		$res=mysqli_query($conn,$st);
		if($res==false)
			echo 'Error in removing subject it might be possible that the subject is already assigned to any teacher please free up the subject';
		else
			echo 'Subject remove success please refresh the page for the update content';
	}
	else if($req=="selections")
	{
	
		$need=$_GET['need'];
		$data=$_GET['data'];
		if($need=='mandatory')
		{
			echo '<option value="select">select</option>';
			if($data=='getcourse')
			{
				$st="select distinct course from classes;";
				$rs=mysqli_query($conn,$st);
				while($re=mysqli_fetch_assoc($rs))
				{
					echo '<option value="'.$re['course'].'">'.$re['course'].'</option>';
				}
			}
			else if($data=='getbranch')
			{
				$course=$_GET['course'];
				$st="select distinct branch from classes where course='".$course."';";
				$rs=mysqli_query($conn,$st);
				while($re=mysqli_fetch_assoc($rs))
				{
					echo '<option value="'.$re['branch'].'">'.$re['branch'].'</option>';
				}
			}	
			else if($data=='getsem')
			{
				$branch=$_GET['branch'];
				$st="select distinct sem from classes where branch='".$branch."';";
				$rs=mysqli_query($conn,$st);
				while($re=mysqli_fetch_assoc($rs))
				{
					echo '<option value="'.$re['sem'].'">'.$re['sem'].'</option>';
				}
			}
		}
		else if($need=='casual')
		{
			echo '<option value="all">all</option>';
			if($data=='getcourse')
			{
				$st="select distinct course from classes;";
				$rs=mysqli_query($conn,$st);
				while($re=mysqli_fetch_assoc($rs))
				{
					echo '<option value="'.$re['course'].'">'.$re['course'].'</option>';
				}
			}
			else if($data=='getbranch')
			{
				$course=$_GET['course'];
				$st="select distinct branch from classes where course='".$course."';";
				$rs=mysqli_query($conn,$st);
				while($re=mysqli_fetch_assoc($rs))
				{
					echo '<option value="'.$re['branch'].'">'.$re['branch'].'</option>';
				}
			}	
			else if($data=='getsem')
			{
				$branch=$_GET['branch'];
				$st="select distinct sem from classes where branch='".$branch."';";
				$rs=mysqli_query($conn,$st);
				while($re=mysqli_fetch_assoc($rs))
				{
					echo '<option value="'.$re['sem'].'">'.$re['sem'].'</option>';
				}
			}
		}
		else if($need=='tt')
		{
			echo '<option value="select">select</option>';
			if($data=='getcourse')
			{
				$st="select distinct course from student_timetable;";
				$rs=mysqli_query($conn,$st);
				while($re=mysqli_fetch_assoc($rs))
				{
					echo '<option value="'.$re['course'].'">'.$re['course'].'</option>';
				}
			}
			else if($data=='getbranch')
			{
				$course=$_GET['course'];
				$st="select distinct branch from student_timetable where course='".$course."';";
				$rs=mysqli_query($conn,$st);
				while($re=mysqli_fetch_assoc($rs))
				{
					echo '<option value="'.$re['branch'].'">'.$re['branch'].'</option>';
				}
			}	
			else if($data=='getsem')
			{
				$branch=$_GET['branch'];
				$st="select distinct sem from student_timetable where branch='".$branch."';";
				$rs=mysqli_query($conn,$st);
				while($re=mysqli_fetch_assoc($rs))
				{
					echo '<option value="'.$re['sem'].'">'.$re['sem'].'</option>';
				}
			}
		}
	}
	else if($req=="facultyselection")
	{
	echo '<option value="select">select</option>';
		$st="select * from teacher;";
		$re=mysqli_query($conn,$st);
		while($rs=mysqli_fetch_assoc($re))
		{
			echo '<option value="'.$rs['id'].'">'.$rs['faculty_code'].' '.$rs['faculty_name'].'</option>';
		}
	}
	else if($req=="faclogin")
	{
		$id=$_GET['fid'];
		$st="select * from teacher where faculty_code='".$id."';";
		$re=mysqli_query($conn,$st);
		if(mysqli_num_rows($re)==0)
			echo 'false';
		else
		{
			while($ress=mysqli_fetch_assoc($re))
			{
			$_SESSION['user']="faculty";
			$_SESSION['fid']=$id;
			$_SESSION['fsr']=$ress['id'];
			echo 'true';
			}
		}
	}
	else if($req=="hodlogin")
	{
		$id=$_GET['hid'];
		$pass=$_GET['pass'];
	 
		$st="select * from teacher where faculty_code='".$id."' and password='".$pass."';";
		$re=mysqli_query($conn,$st);
		if(mysqli_num_rows($re)==0)
			echo 'false';
		else
		{
			while($rs=mysqli_fetch_assoc($re))
			{
			
			$_SESSION['user']="hod";
			$_SESSION['hid']=$id;
			$_SESSION['hname']=$rs['faculty_name'];
			$_SESSION['hdep']=$rs['department'];
			}
			echo 'true';
		}
			
	}
	else if($req=="unassignsub")
	{
		$fid=$_GET['facid'];
		$sid=$_GET['subid'];
		echo $fid." ".$sid;
		$st="select subject_sr from student_timetable where subject_sr='".$sid."';";
		echo 'here';
		$res=mysqli_query($conn,$st);
		while($re=mysqli_fetch_assoc($res))
		{
			$st1="select * from subject where Sr='".$re['subject_sr']."';";
			$re1=mysqli_query($conn,$st1);
			echo mysqli_num_rows($re1);
			while($rs1=mysqli_fetch_assoc($re1))
			{
				if($rs1['class_type']=='p')
				{
					$st2="update subject set class_count='1' where Sr='".$rs1['Sr']."';";
					mysqli_query($conn,$st2);
				}
				else
				{
					$st2="update subject set class_count=class_count+1 where Sr='".$rs1['Sr']."';";
					mysqli_query($conn,$st2);
				}
			}
		}
		
			$sql="delete from student_timetable where faculty_sr='".$fid."' and subject_sr='".$sid."';";
			mysqli_query($conn,$sql);
			$sql="delete from faculty_assigned where faculty_sr='".$fid."' and subject_sr='".$sid."';";
			$res=mysqli_query($conn,$sql);
			if($res==false)
				echo 'Error in Removing Faculty you might have trying to remove a faculty who is corrently assigned to any class make sure you set the faculty free from all his duty first';
			else
				echo 'Faculty Remove success please refresh the page for the updated content';
	}
	else if($req=="unallocate")
	{
		$fid=$_GET['facid'];
		$sid=$_GET['subid'];
		$day=$_GET['day'];
		$col=$_GET['col'];
		$shift=$_GET['shift'];
			$st1="select * from subject where Sr='".$sid."';";
			$re1=mysqli_query($conn,$st1);
			echo mysqli_num_rows($re1);
			while($rs1=mysqli_fetch_assoc($re1))
			{
				if($rs1['class_type']=='p')
				{
					$st2="update subject set class_count='1' where Sr='".$rs1['Sr']."';";
					mysqli_query($conn,$st2);
					$sql="delete from student_timetable where faculty_sr='".$fid."' and subject_sr='".$sid."' and day='".$day."' and col='".$col."';";
					$res=mysqli_query($conn,$sql);
					if($res==false)
						echo 'Error in Removing Faculty you might have trying to remove a faculty who is corrently assigned to any class make sure you set the faculty free from all his duty first';
					else
						echo 'Faculty Remove success please refresh the page for the updated content';
				}
				else
				{
					$st2="update subject set class_count=class_count+1 where Sr='".$rs1['Sr']."';";
					mysqli_query($conn,$st2);
					$sql="delete from student_timetable where faculty_sr='".$fid."' and subject_sr='".$sid."' and day='".$day."' and shift='".$shift."';";
					$res=mysqli_query($conn,$sql);
					if($res==false)
						echo 'Error in Removing Faculty you might have trying to remove a faculty who is corrently assigned to any class make sure you set the faculty free from all his duty first';
					else
						echo 'Faculty Remove success please refresh the page for the updated content';
				}
			}
		}
		
	else if($req=="logout")
	{
		session_destroy();
		header("Location:../index.php");
	}
	else if($req=="studentlogin")
	{
		$_SESSION['user']="student";
		$_SESSION['course']=$_GET['course'];
		$_SESSION['branch']=$_GET['branch'];
		$_SESSION['sem']=$_GET['sem'];
	}
	
	
?>