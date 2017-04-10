<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>

function checkusername() {
	var str=String(document.getElementById("username").value);
	if (str.length==0) {
    	    document.getElementById("usernameAvail").innerHTML = "";
    	    return;
    	} else { 
    	   if (window.XMLHttpRequest) {
    	   // code for IE7+, Firefox, Chrome, Opera, Safari
    	    xmlhttp = new XMLHttpRequest();
    		} else {
    		  // code for IE6, IE5
    		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    		}
    		xmlhttp.onreadystatechange = function() {
    		   if (this.readyState == 4 && this.status == 200) {
    		       document.getElementById("usernameAvail").innerHTML=this.responseText;    		       
    		   }
    		};
    		var table=String(document.getElementById("table").value);    		
    			xmlhttp.open("GET", "./ajax/checkusername.php?q="+str+"&table="+table, true);
  				xmlhttp.send();    		
     	}
}
</script>
<style type="text/css">
	@media screen and (max-width: 1014px) {
		#loginput1{
			width:100px;
		}
		#loginput2{
			width:100px;
		}
	}
	#reginput0{
		/*margin-top: 12%;*/
	}
	@media screen and (max-width: 1400px){
		#registrationform{
			margin-top: 10%;
		}
	}
	@media screen and (max-width: 880px){
		#registrationform{
			margin-top: 12%;
		}
	}
	@media screen and (max-width: 768px){
		#reginput0{	
		   	margin-top: 10%;
    		margin-bottom: -12%;
		}
		#reginput1{	
		   margin-top: -12%;
		}
		#reginput2{
			margin-top: -12%;
		}
		#reginput3{
			margin-top: -12%;
		}		
		#reginput5{
			margin-top: -12%;
		}
	}
</style>
</head>
<body style="background-image: url('./img/index1.jpg');">

<!--Navbar-->
<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: transparent;border-color: transparent; ">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" style="background-color: black;">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">WebCods</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse" style="border-color: transparent;">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="index.php">Home</a></li>
        <li class="dropdown">
          <a id="abc" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: black;background-color: white;">Login <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="stud_login.php">Student Login</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="faculty_login.php">Faculty Login</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!--/Navbar-->


<br>
<br>
<!--Registration Form-->
<form class="form-inline" action="./database/register.php" id="registrationform" style="float: right;margin-right: 12%;" onsubmit="return check()" method="post">
	<input type="text" id="reginput0" onchange="checkusername()" name="name" class="form-control" placeholder="Name" required=""><br><br>
	<input id="username" type="text" name="username" class="form-control" onkeyup="checkusername()" placeholder="UserName" required=""><br><br><div id="usernameAvail"></div>
	<input type="tel" name="number" onchange="checkusername()" onkeyup="checkPhone()" class="form-control" placeholder="Phone Number" pattern=".{10,}" required="" title="Enter a valid contact number including area code" id="reginput1"><br><br>
	<input type="Email" name="email" class="form-control" onchange="checkusername()" placeholder="Email ID" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="" id="reginput2"><br><br>
	<input type="password" name="password" class="form-control" onchange="checkusername()" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="" id="reginput3"><br><br>
    <select name="table" id="table" onchange="checkusername()">
  		<option value="faculty">Faculty</option>
  		<option value="student_details">Student</option>
    </select><br>
	<div class="checkbox" id="reginput4">
    	<label style="color:white;"><input type="checkbox"> Remember me</label>
  	</div><br><br>
	<input type="submit" name="register" class="btn btn-success" id="reg" value="Register" id="reginput5">
</form>
<!--/Registration Form-->
</body>
</html>
