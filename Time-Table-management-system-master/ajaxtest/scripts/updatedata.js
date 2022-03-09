function setValue(id)
{
	console.log(id);
	var sem=document.getElementById('sem').value;
	var course=document.getElementById('course').value;
	var branch=document.getElementById('branch').value;
	var shift=id%10;
	var day=Math.floor(id/10);
	//var subject_sr=document.getElementById(id).value;
	var subject_sr=1;
	var mydata=new XMLHttpRequest();
	alert(subject_sr);
	mydata.open("GET","myweb.php?type=setvalue&subject_sr="+subject_sr+"&ds="+i+j+"&sem="+sem+"&course="+course+"&branch="+branch,true);
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
		mydata.open("GET","myweb.php?type=update&ds="+(i+j)+"&sem="+sem+"&course="+course+"&branch="+branch+"",true);
		mydata.send(null);
		
		document.getElementById(i+''+j).innerHTML=mydata.responseText;
	}
	
}