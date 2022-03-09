
	function validatefac(formname)
	{
		var form=document.forms[formname];
		var fac=form.elements["faculty"];
		if(fac.selectedIndex==0)
		{
			alert("please make a valid selection");
			return false;
		}
	}
	function validateSel(formname)
	{
		
		var form=document.forms[formname];
		var branch=form.elements['branch'];
		var course=form.elements['course'];
		var sem=form.elements['sem'];
		
		if(branch.selectedIndex==0 || course.selectedIndex==0 || sem.selectedIndex==0)
		{
			alert("please make a valid selection");
			return false;
		}
	}
	function updatefaculty(formname)
	{
	var form=document.forms[formname];
	var sel=form.elements["faculty"];
		var mydata=new XMLHttpRequest();
		mydata.open("GET","../includes/processAction.php?request_type=facultyselection",false);
		mydata.send(null);
		
		sel.innerHTML=mydata.responseText;
	}
	function updatecourse(need,formname)
	{
	var form=document.forms[formname];
	var mydata=new XMLHttpRequest();
	
	mydata.open("GET","../includes/processAction.php?request_type=selections&data=getcourse&need="+need+"",false);
	mydata.send(null);
	
	var sel=form.elements["course"];
	
	sel.innerHTML=mydata.responseText;
	
	}
	function updatebranch(need,formname)
	{
	var form=document.forms[formname];
	var e = form.elements["course"];
	var course = e.options[e.selectedIndex].value;

	var mydata=new XMLHttpRequest();
	mydata.open("GET","../includes/processAction.php?request_type=selections&data=getbranch&course="+course+"&need="+need+"",false);
	mydata.send(null);
	var sel=form.elements["branch"];
	sel.innerHTML=mydata.responseText;
	}
	function updatesem(need,formname)
	{
	var form=document.forms[formname];
	var e = form.elements["branch"];
	var branch = e.options[e.selectedIndex].value;
	var mydata=new XMLHttpRequest();
	mydata.open("GET","../includes/processAction.php?request_type=selections&data=getsem&branch="+branch+"&need="+need+"",false);
	mydata.send(null);
	var sel=form.elements["sem"];
	sel.innerHTML=mydata.responseText;
	}
	
