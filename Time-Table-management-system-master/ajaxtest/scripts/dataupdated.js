function setValue(d,s,c)
{
	var sem=document.getElementById('sem').value;
	var course=document.getElementById('course').value;
	var branch=document.getElementById('branch').value;
	var subject_sr=document.getElementById(d+''+s+''+c).value;
	var mydata=new XMLHttpRequest();
	alert(subject_sr);
	mydata.open("GET","time_table_helper.php?type=setvalue&subject_sr="+subject_sr+"&d="+d+"&c="+c+"&s="+s+"&sem="+sem+"&course="+course+"&branch="+branch,false);
	mydata.send(null);
	updateOptions();
}
function updateOptions()
{
	var sem=document.getElementById('sem').value;
	var course=document.getElementById('course').value;
	var branch=document.getElementById('branch').value;
	var mydata=new XMLHttpRequest();
	for(var i=1;i<=6;i++)
	for(var j=1;j<=7;j++)
	{
		mydata.open("GET","time_table_helper.php?type=update&d="+i+"&s="+j+"&sem="+sem+"&course="+course+"&branch="+branch,false);
		mydata.send(null);
		document.getElementById(i+''+j).innerHTML=mydata.responseText;
		//alert(mydata.responseText);
	}
	
	
}