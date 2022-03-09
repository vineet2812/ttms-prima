<?php include 'db.php';
	$req=$_POST['request_type'];
	if($req=="addFaculty")
	{
		$faculty_code=$_POST['faculty_code'];
		$faculty_name=$_POST['faculty_name'];
		$dep=$_POST['dep'];
		$ftype=$_POST['ftype'];
		$pass=$_POST['pass'];
		
		/**********************
			Searching for duplicate faculty code or faculty 
			name in teacher table fail if already exists
		**********************/
		$st="select * from teacher where faculty_code='".$faculty_code."' or faculty_name='".$faculty_name."';";
		$res=mysqli_query($conn,$st);
		if(mysqli_num_rows($res)!=0)
		{
			echo 'teacher code or name already registered';
		}
		else
		{
			$st="insert into teacher values('','".$faculty_code."','".$faculty_name."','".$dep."','".$ftype."','".$pass."');";
			$res=mysqli_query($conn,$st);
			if($res==null)
				echo 'error in inserting';
			else
				echo 'successfull insertion';
		}
		echo '<br><hr><a href="addFaculty.php">Go back</a>';
	}
	else if($req=="addSubject")
	{
		$branch=$_POST['branch'];
		$course=$_POST['course'];
		$sem=$_POST['sem'];
		$subject_code=$_POST['subject_code'];
		$shortform=$_POST['shortform'];
		$subject_name=$_POST['subject_name'];
		$class_type=$_POST['class_type'];
		$class_count=$_POST['class_count'];
		$batch=$_POST['batch'];
		/**********************
		Query for searching whether the given subject is already registered 
		failed if any duplicate record found
		**********************/
		$st="select * from subject where class_type='".$class_type."' 
		and subject_code='".$subject_code."' and sem='".$sem."' 
		and	subject_name='".$subject_name."' and branch='".$branch."' and batch='".$batch."';";
		$res=mysqli_query($conn,$st);
		if(mysqli_num_rows($res)!=0)
			echo 'subject already exist';
		else
		{
			$st="insert into subject values('','".$branch."','".$course."','".$sem."'
			,'".$subject_code."','".$subject_name."','".$shortform."','".$class_count."','".$class_type."'
			,'".$batch."');";
			$res=mysqli_query($conn,$st);
			if($res==null)
				echo 'error in insertion';
			else
				echo 'successfull insertion';
		}
		echo '<br><hr><a href="addSubject.php">Go back</a>';
	
	}
	
	else if($req=="assignFaculty")
	{
		$branch=$_POST['branch'];
		$course=$_POST['course'];
		$sem=$_POST['sem'];
		$faculty_sr=$_POST['faculty_sr'];
		$subject_code=$_POST['subject_code'];
		$class_type=$_POST['class_type'];
		$batch=$_POST['batch'];
		
		/*********************
			finding the subject sr no with the help of given data that sr. no 
			will be inserted in faculy assigned table if the duplicate data
			is not found
		
		**********************/
		$st="select * from subject where course='".$course."' and
		subject_code='".$subject_code."' and sem= '".$sem."' and class_type=
		'".$class_type."' and batch='".$batch."' and branch='".$branch."';";
		$res=mysqli_query($conn,$st);
		$subject_sr=0;
			while($result=mysqli_fetch_assoc($res))
			{
					$subject_sr=$result['Sr'];
			}
		$st="select * from faculty_assigned where faculty_sr='".$faculty_sr."' and subject_sr='".$subject_sr."';";
		$res=mysqli_query($conn,$st);
		echo $faculty_sr."  ".$subject_sr;
		if(mysqli_num_rows($res)!=0)
		{
			echo 'duplicate entry is attempted';
		}
		else
		{
			$st="insert into faculty_assigned values('',".$faculty_sr.",".$subject_sr.");";
			$res=mysqli_query($conn,$st);
			if($res==null)
				echo 'error in insertion';
			else
				echo 'insertion succesfull';
			
		}
		echo '<br><hr><a href="assignFaculty.php">go back</a>';
	}
	
?>