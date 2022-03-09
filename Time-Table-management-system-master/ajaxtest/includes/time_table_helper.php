<?php
include 'db.php';
$type=$_GET['type'];
if($type=="setvalue")
{
	$shift=$_GET['s'];
	$day=$_GET['d'];
	$col=$_GET['c'];
	$branch=$_GET['branch'];
	$course=$_GET['course'];
	$sem=$_GET['sem'];
	$subject_sr=$_GET['subject_sr'];
	$st="select * from student_timetable where day='".$day."' and shift='".$shift."' and branch='".$branch."' and course='".$course."' and col='".$col."' and sem='".$sem."';";
	$res=mysqli_query($conn,$st);
		
		while($result=mysqli_fetch_assoc($res))
		{
		/*************
		 at very first we are checking if any subject is already present therer 
		 if yes then we first fetch that subject_sr increase the count by one
		 and then delete the record from that particular entry from tt
		**************/
		
			$st="update subject set class_count=class_count+1 where Sr='".$result['subject_sr']."';";
			
			$rest=mysqli_query($conn,$st);
			$st1="select * from subject where Sr='".$result['subject_sr']."';";
			$res1=mysqli_query($conn,$st1);
			while($ress=mysqli_fetch_assoc($res1))
			{
			
			/*******************
			in case of lab we have to delete it from table where shift is i,i+1,i+2
			as it occupy 3 lectures in case of mca and 2 lecturer in case of btech
			*******************/
				if($ress['class_type']=='p')
				{
					if($course=='MCA')
					{
						$st2="delete from student_timetable where col='".$col."' and subject_sr='".$result['subject_sr']."' and day='".$day."' and (shift='".$shift."' or shift='".($shift+1)."' or shift='".($shift+2)."');";
						$ret=mysqli_query($conn,$st2);
					}
					else
					{
						$st2="delete from student_timetable where col='".$col."' and subject_sr='".$result['subject_sr']."' and day='".$day."' and (shift='".$shift."' or shift='".($shift+1)."');";
						$ret=mysqli_query($conn,$st2);
					}
				}
				else
				{
					$st2="delete from student_timetable where subject_sr='".$result['subject_sr']."' and day='".$day."' and shift='".$shift."';";
					$ret=mysqli_query($conn,$st2);
				}
			}
			
			
		}
		//if there is a selection we are sent a subject sr which is unique and is curre
		//ntly being selected by user
	if($subject_sr!="select")
	{
	//updating the subject table and decreasing its count by 1
		$st="update subject set class_count=class_count-1 where Sr='".$subject_sr."';";
	
		$st1="select * from faculty_assigned where subject_sr='".$subject_sr."';";
	//This ^ query is for searching the faculty sr no. with respect to that subject
		$res=mysqli_query($conn,$st);
		$res=mysqli_query($conn,$st1);
		$fac="";
		while($res=mysqli_fetch_assoc($res))
			$fac=$res['faculty_sr'];
		$st2="select class_type from subject where Sr='".$subject_sr."';";
		/*********
		the above ^ query is for checking for the class type of the subject we have selected
		if the subject we have selected is practical 
		so in case of MCA we have to insert into timetable entries thrise for shift i,i+1,i+2
		in case of BTEch we insert twice i,i+1;
		because mca lab occupy 3 lecture and btech 2
		*******/
		$res2=mysqli_query($conn,$st2);
		while($ress1=mysqli_fetch_assoc($res2))
		{
			if($ress1['class_type']=="p")
			{
				if($course=="MCA")
				////^MCA case insert thrice;
				{
					for($i=0;$i<3;$i++)
					{
						$st="insert into student_timetable values('','".$day."','".($shift+$i)."'
					,'".$fac."','".$subject_sr."','".$branch."',
					'".$course."','".$sem."','".$col."');";
					$res=mysqli_query($conn,$st);
					}
				}
				else
				{
				/////btech case insert twise
					for($i=0;$i<2;$i++)
					{
						$st="insert into student_timetable values('','".$day."','".($shift+$i)."'
					,'".$fac."','".$subject_sr."','".$branch."',
					'".$course."','".$sem."','".$col."');";
					$res=mysqli_query($conn,$st);
					}
				
				}
			}
			else
			{
			//normal case no lab case only lecture or tute only one entry is needed
				
					$st="insert into student_timetable values('','".$day."','".$shift."'
					,'".$fac."','".$subject_sr."','".$branch."',
					'".$course."','".$sem."','".$col."');";
					$res=mysqli_query($conn,$st);
				
			}
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
	/***********
	To show the options we are sending the whole select box with id(sdc) and action setValue(s,d,c)
	to the main page which is set to respective cell
	whenever we make any selection the above logic in this page for data update will be done
	***********/
	$st="select * from student_timetable where shift='".$shift."' and day='".$day."' and branch='".$branch."' and course='".$course."' and sem='".$sem."' order by col;";
	//above^ query is to find data on the cell s,d ie the class occured on that day shift
	$res=mysqli_query($conn,$st);
	/****************************
		
	******************************/
	
	if(mysqli_num_rows($res)==0)
	// ^it means no classes held on that day shift so we send only one select box with id s,d and col=1
 	{
	
		echo '<select id="'.($day).''.$shift.'1'.'" onchange="setValue('.$day.','.$shift.',1)">';
		echo '<option value="select">select</option>';
	
		/******************************
		The below query will return all the subjects whoose classes are
		remaining and also the teachers along with their respective subjects.
		******************************/
		
		$st1="select * from subject inner join
		faculty_assigned on subject.Sr=faculty_assigned.subject_sr 
		where branch = '".$branch."' and course = '".$course."' and sem = '".$sem."' and class_count > 0;";
		$res1=mysqli_query($conn,$st1);
	
		
		//now for each subject we are giving this logic
		while($result=mysqli_fetch_assoc($res1))
		{
			if($result['class_type']=='p')
			/*
			in case of lab we have to check for that respective faculty and the
			class both should be free for proceeding 2 class as lab needs 3 consecutive lectures
			*/
			{
				$st="";
				if($course=='MCA')
				{
					if($shift==1 or $shift==2 or $shift==5)
					//^ only possible places for mca
					{
					$st="select * from student_timetable where ((faculty_sr='".$result['faculty_sr']."') or 
					(course='".$course."' and branch='".$branch."' and sem='".$sem."')) and
					day='".$day."' and (shift='".$shift."' or shift='".($shift+1)."' or shift='".($shift+2)."') ;";
					//^query to check free faculty and class for 3 consecutive lectures
					$re=mysqli_query($conn,$st);
					if(mysqli_num_rows($re)==0)
					//^no data found ie we can assign that lab so this can be a possible option
					{
							echo '<option value="'.$result['subject_sr'].'">'.$result['subject_code'].' '.($result['subject_name']).'('.$result['class_type'].')'.'('.$result['batch'].')'.'</option>';
					}
					}
				}
				else
				{
				if($shift!=4 and $shift!= 7)
				//^for btech only places where lab cannot be assigned is 4 and 7
				{
				
					$st="select * from student_timetable where ((faculty_sr='".$result['faculty_sr']."') or 
					(course='".$course."' and branch='".$branch."' and sem='".$sem."')) and
					day='".$day."' and (shift='".$shift."' or shift='".($shift+1)."');";
					//same query as for mca except here we are checking 2 consecutive lectures
					$re=mysqli_query($conn,$st);
					if(mysqli_num_rows($re)==0)
					{
							echo '<option value="'.$result['subject_sr'].'">'.$result['subject_code'].' '.($result['subject_name']).'('.$result['class_type'].')'.'('.$result['batch'].')'.'</option>';
					}
					
				}
				}
			}
			else
			{
			
				$sst1="select * from student_timetable where shift='".$shift."' and day='".$day."' and
				faculty_sr='".$result['faculty_sr']."';";
				//^normal case when only checking the faculty is free for that day and shift			
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
		echo '</select>';
	}
	
	else if(mysqli_num_rows($res)==1)
	{
	//^ when there is a subject assigned to that day and shift
		while($result=mysqli_fetch_assoc($res))
		{
			$st1="select * from subject where Sr='".$result['subject_sr']."';";
			$result1=mysqli_query($conn,$st1);
			while($res1=mysqli_fetch_assoc($result1))
			{
				if($res1['class_type']=="p")
				//if class type is practical we have to check in which cell it is assigned by
				//col name if one then is upper if 2 then is lower case
				{
					if($result['col']==1)
					{
					//upper case
						echo '<select id="'.($day).''.$shift.'1'.'" onchange="setValue('.$day.','.$shift.',1)">';
						echo '<option value="'.$result['subject_sr'].'">'.$res1['subject_code'].' '.($res1['subject_name']).'('.$res1['class_type'].')'.$res1['batch'].'</option>';
						echo '<option value="select">select</option>';
						$st2="select * from subject inner join
							faculty_assigned on subject.Sr=faculty_assigned.subject_sr 
							where branch = '".$branch."' and course = '".$course."' and sem = '".$sem."' and subject.Sr!='".$result['subject_sr']."' and class_type='p' and class_count > 0 ;";
					// finding remaining subjects for options same logic as above
						$result2=mysqli_query($conn,$st2);
						while($res2=mysqli_fetch_assoc($result2))
						{
							$st3="";
							if($course=="MCA")
							{
								$st3="select * from student_timetable where faculty_sr='".$res2['faculty_sr']."' and
					day='".$day."' and (shift='".$shift."' or shift='".($shift+1)."' or shift='".($shift+2)."');";
							}
							else
							{
								$st3="select * from student_timetable where (faculty_sr='".$res2['faculty_sr']."') and
							day='".$day."' and (shift='".$shift."' or shift='".($shift+1)."');";
							}
							$re=mysqli_query($conn,$st3);
							if(mysqli_num_rows($re)==0)
							{
									echo '<option value="'.$res2['subject_sr'].'">'.$res2['subject_code'].' '.($res2['subject_name']).'('.$res2['class_type'].')'.'('.$res2['batch'].')'.'</option>';
							}
							else
							echo '<option>'.$result['faculty_sr'].'</option>';
						}
						echo '</select>';
						
						echo '<select id="'.($day).''.$shift.'2'.'" onchange="setValue('.$day.','.$shift.',2)">';
						//^the second select box for another practical to assigned as if
						//there is practical so another subject will also be practical so we will
						//show only those subject where class type is practicle
						echo '<option value="select">select</option>';
						$st2="select * from subject inner join
								faculty_assigned on subject.Sr=faculty_assigned.subject_sr 
								where branch = '".$branch."' and course = '".$course."' and sem = '".$sem."' and subject.Sr!='".$result['subject_sr']."' and class_type='p' and class_count > 0 ;";
						
						$result2=mysqli_query($conn,$st2);
						while($res2=mysqli_fetch_assoc($result2))
						{
							$st3="";
							if($course=="MCA")
							{
								$st3="select * from student_timetable where (faculty_sr='".$res2['faculty_sr']."' and
					day='".$day."' and (shift='".$shift."' or shift='".($shift+1)."' or shift='".($shift+2)."'));";
							}
							else
							{
								$st3="select * from student_timetable where (faculty_sr='".$res2['faculty_sr']."' and
					day='".$day."' and (shift='".$shift."' or shift='".($shift+1)."'));";
							}
							$re=mysqli_query($conn,$st3);
							if(mysqli_num_rows($re)==0)
							{
									
									echo '<option value="'.$res2['subject_sr'].'">'.$res2['subject_code'].' '.($res2['subject_name']).'('.$res2['class_type'].')'.'('.$res2['batch'].')'.'</option>';
							}
						}
						echo '</select>';
					
					}
					
					else
					{
					//the lower case the selected subject will be second select and
					//free box will be first subject display logic is same as above
						echo '<select id="'.($day).''.$shift.'1'.'" onchange="setValue('.$day.','.$shift.',1)">';
							echo '<option value="select">select</option>';
						$st2="select * from subject inner join
								faculty_assigned on subject.Sr=faculty_assigned.subject_sr 
								where branch = '".$branch."' and course = '".$course."' and sem = '".$sem."' and subject.Sr!='".$result['subject_sr']."' and class_type='p' and class_count > 0 ;";
						
						$result2=mysqli_query($conn,$st2);
						while($res2=mysqli_fetch_assoc($result2))
						{
							$st3="";
							if($course=="MCA")
							{
								$st3="select * from student_timetable where faculty_sr='".$res2['faculty_sr']."' and
					day='".$day."' and (shift='".$shift."' or shift='".($shift+1)."' or shift='".($shift+2)."');";
							}
							else
							{
								$st3="select * from student_timetable where faculty_sr='".$res2['faculty_sr']."' and
					day='".$day."' and (shift='".$shift."' or shift='".($shift+1)."');";
							}
							$re=mysqli_query($conn,$st3);
							if(mysqli_num_rows($re)==0)
							{
									echo '<option value="'.$res2['subject_sr'].'">'.$res2['subject_code'].' '.($res2['subject_name']).'('.$res2['class_type'].')'.'('.$res2['batch'].')'.'</option>';
							}
						}
						echo '</select>';

					
						echo '<select id="'.($day).''.$shift.'2'.'" onchange="setValue('.$day.','.$shift.',2)">';
						echo '<option value="'.$result['subject_sr'].'">'.$res1['subject_code'].' '.($res1['subject_name']).'('.$res1['class_type'].')'.$res1['batch'].'</option>';
						echo '<option value="select">select</option>';
						$st2="select * from subject inner join
							faculty_assigned on subject.Sr=faculty_assigned.subject_sr 
							where branch = '".$branch."' and course = '".$course."' and sem = '".$sem."' and subject.Sr!='".$result['subject_sr']."' and class_type='p' and class_count > 0 ;";
					
						$result2=mysqli_query($conn,$st2);
						while($res2=mysqli_fetch_assoc($result2))
						{
							$st3="";
							if($course=="MCA")
							{
								$st3="select * from student_timetable where faculty_sr='".$res2['faculty_sr']."' and
					day='".$day."' and (shift='".$shift."' or shift='".($shift+1)."' or shift='".($shift+2)."');";
							}
							else
							{
							$st3="select * from student_timetable where faculty_sr='".$res2['faculty_sr']."' and
					day='".$day."' and (shift='".$shift."' or shift='".($shift+1)."');";
							}
							$re=mysqli_query($conn,$st3);
							if(mysqli_num_rows($re)==0)
							{
									echo '<option value="'.$res2['subject_sr'].'">'.$res2['subject_code'].' '.($res2['subject_name']).'('.$res2['class_type'].')'.'('.$res2['batch'].')'.'</option>';
							}
						}
						echo '</select>';
					
					}
				}
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				else
				{
				//normal case when a subject is selected which is not practical we have to
				//display it and then the subject display is same as above
					echo '<select id="'.($day).''.$shift.'1'.'" onchange="setValue('.$day.','.$shift.',1)">';
					$batch='';
					if($res1['batch']!='a')
									$batch='('.$res1['batch'].')';
					echo '<option value="'.$res1['Sr'].'">'.$res1['subject_code'].' '.($res1['subject_name']).'('.$res1['class_type'].')'.$batch.'</option>';
					echo '<option value="select">select</option>';
					
					/******************************
					The below query will return all the subjects whoose classes are
					remaining and also the teachers along with their respective subjects.
					******************************/
					
					$st1="select * from subject inner join
					faculty_assigned on subject.Sr=faculty_assigned.subject_sr 
					where branch = '".$branch."' and course = '".$course."' and sem = '".$sem."' and class_count > 0 ;";
					$res1=mysqli_query($conn,$st1);

					while($result=mysqli_fetch_assoc($res1))
					{
						if($result['class_type']=='p')
						{
							$st="";
							if($course=='MCA')
							{
								if($shift==1 or $shift==2 or $shift==5)
								{
								$st="select * from student_timetable where (faculty_sr='".$result['faculty_sr']."' or 
					(course='".$course."' and branch='".$branch."' and sem='".$sem."')) and
					day='".$day."' and (shift='".$shift."' or shift='".($shift+1)."' or shift='".($shift+2)."');";
								$re=mysqli_query($conn,$st);
								if(mysqli_num_rows($re)==0)
								{
										echo '<option value="'.$result['subject_sr'].'">'.$result['subject_code'].' '.($result['subject_name']).'('.$result['class_type'].')'.'('.$result['batch'].')'.'</option>';
								}
								}
							}
							else
							{
							if($shift!=4 and $shift!= 7)
							{
							
									$st="select * from student_timetable where (faculty_sr='".$result['faculty_sr']."' or 
					(course='".$course."' and branch='".$branch."' and sem='".$sem."')) and
					day='".$day."' and (shift='".$shift."' or shift='".($shift+1)."');";
								$re=mysqli_query($conn,$st);
								if(mysqli_num_rows($re)==0)
								{
										echo '<option value="'.$result['subject_sr'].'">'.$result['subject_code'].' '.($result['subject_name']).'('.$result['class_type'].')'.'('.$result['batch'].')'.'</option>';
								}
								
							}
							}
						}
						else
						{
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
					echo '</select>';
					
				}
			}
		}
	}
	
	else if(mysqli_num_rows($res)==2)
	{
	//this is the case when two subject are found on same day and shift in this case it is only posssible
	//that both are practical so we are displaying it and also only practical type options are 
	// availble for make selection in these boxes
		while($result=mysqli_fetch_assoc($res))
		{
			$st1="select * from subject where Sr='".$result['subject_sr']."';";
			$result1=mysqli_query($conn,$st1);
			while($res1=mysqli_fetch_assoc($result1))
			{
					echo '<select id="'.($day).''.$shift.''.$result['col'].'" onchange="setValue('.$day.','.$shift.','.$result['col'].')">';
						echo '<option value="'.$result['subject_sr'].'">'.$res1['subject_code'].' '.($res1['subject_name']).'('.$res1['class_type'].')'.$res1['batch'].'</option>';
						echo '<option value="select">select</option>';
						$st2="select * from subject inner join
							faculty_assigned on subject.Sr=faculty_assigned.subject_sr 
							where branch = '".$branch."' and course = '".$course."' and sem = '".$sem."' and subject.Sr!='".$result['subject_sr']."' and class_type='p' and class_count > 0 ;";
					
						$result2=mysqli_query($conn,$st2);
						while($res2=mysqli_fetch_assoc($result2))
						{
							$st3="";
							if($course=="MCA")
							{
								$st3="select * from student_timetable where day='".$day."' and
								faculty_sr='".$res2['faculty_sr']."'and 
								shift='".$shift."' or shift='".($shift+1)."' or shift='".($shift+2)."';";
							}
							else
							{
								$st3="select * from student_timetable where day='".$day."' and
								faculty_sr='".$res2['faculty_sr']."'and 
								shift='".$shift."' or shift='".($shift+1)."';";
							}
							$re=mysqli_query($conn,$st3);
							if(mysqli_num_rows($re)==0)
							{
									echo '<option value="'.$res2['subject_sr'].'">'.$res2['subject_code'].' '.($res2['subject_name']).'('.$res2['class_type'].')'.'('.$res2['batch'].')'.'</option>';
							}
						}
						echo '</select>';
			
			}
			
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		

}
?>
