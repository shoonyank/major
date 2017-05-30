<?php
include 'dbconnect.php';
function faculty_go(){
	header('Location: http://localhost/Major%20Project/Online%20Exam%20Portal/faculty_page.php');
	exit;
}
function student_go(){
	header('Location: http://localhost/Major%20Project/Online%20Exam%20Portal/dashboard.php');
	exit;
}
$query1="Select username,phone,email from ".$_POST["table"];
$result1=$con->query($query1);
$counter=0;
if($result1->num_rows > 0){
	while ($row = $result1->fetch_assoc()) {
		if($row['username']==$_POST['username']){
			//set counter to 1 if username already registered
			$counter=1;
		}
		elseif ($row['email']==$_POST['email']) {
			//set counter to 2 if email already registered
			$counter=2;
		}
		elseif ($row['phone']==$_POST['number']) {
			//set counter to 3 if phone number already registered
			$counter=3;
		}
	}
}
//if it is a new user, insert his details in a temporary table
if($counter==0){
	$query="INSERT INTO ".$_POST["table"]."(name, email, phone, username, password) VALUES('".$_POST['name']."','".$_POST['email']."',".$_POST['number'].",'".$_POST['username']."','".$_POST['password']."')";
	if ($con->query($query) === TRUE) {
		//on successfull insertion start session
		session_start();
		$_SESSION["username"] = $_POST['username'];
		$_SESSION["name"] = $_POST['name'];
		$_SESSION["email"]=$_POST['email'];
		$_SESSION["table"]=$_POST['table'];
		//extract id of the individual to verify his email address via activation code and other details for session management

		if($_POST["table"]=="faculty"){
			$query2="Select fid,name from faculty where email='".$_POST['email']."' and password='".$_POST['password']."'";
			$result2 = mysqli_query($con, $query2);
			if (mysqli_num_rows($result2) > 0) {	
   				/* fetch associative array */
   				while ($row2 = mysqli_fetch_assoc($result2)) {    	        
       				$_SESSION["fid"]=$row2["fid"];
   				}
   				/* free result set */
   				$result2->free();
			}			
		}
		else{
			$query3="Select sid,name from student_details where email='".$_POST['email']."' and password='".$_POST['password']."'";
			$result3 = mysqli_query($con, $query3);
			if (mysqli_num_rows($result3) > 0) {	
   				/* fetch associative array */
   				while ($row3 = mysqli_fetch_assoc($result3)) {        
       				$_SESSION["sid"]=$row3["sid"];        
   				}
   				/* free result set */
   				$result3->free();
			}	    	
		}
		if(isset($_SESSION["fid"])){
	    	faculty_go();
	    }
	    if(isset($_SESSION["sid"])){
	    	student_go();
	    }
	}else{
		echo $con->error;
	}
}//end of insertion
	else{
			switch ($counter) {
    		case 1:
    	    ?>
    	    <!DOCTYPE html>
<html>
<head>
	<title></title>
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
    			xmlhttp.open("GET", "../ajax/checkusername.php?q="+str+"&table="+table, true);
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
	@media screen and (max-width: 768px){
		#reginput1{
			margin-top: -12%;
		}
		#reginput2{
			margin-top: -12%;
		}
		#reginput3{
			margin-top: -12%;
		}
		#reginput4{
			margin-top: -12%;
		}
		#reginput5{
			margin-top: -12%;
		}
	}
</style>
</head>
<body style="background-image: url('../img/index1.jpg');">

<!--Navbar-->
<nav class="navbar navbar-default" style="background-color: transparent;border-color: transparent; ">
  <div class="container-fluid">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        Login
      </button>
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>    
<div class="collapse navbar-collapse" id="myNavbar" style="border-color: transparent;">

<!--Login Form-->
<form action="./database/login.php" method="POST" class="navbar-form navbar-right" id="loginform" style="border-color: transparent; ">
	<input type="Email" name="email" class="form-control" placeholder="Email" id="loginput1">
	<input type="password" name="password" class="form-control" placeholder="Password" id="loginput2">
	<input type="submit" name="login" class="btn btn-success" value="Login">
</form>
<!--/Login Form-->

</div>
  </div>
</nav>
<!--/Navbar-->



<!--Registration Form-->
<form class="form-inline" action="./register.php" id="registrationform" style="float: right;margin-right: 12%;" onsubmit="return check()" method="post">
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
<p id="txtHint">
	
    	    <?php
    	    echo "Username already registered";
    	    $counter=0;
    	    break;
    	case 2:
       		echo "email already registered";
       		$counter=0;
        	break;
    	case 3:
	        echo "phone number already registered";
	        $counter=0;
    	    break;
		}
	}
$con->close();
?>
</p>
<footer style="margin-top: 39%;">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<strong>Powered by:</strong><b><a href="http://www.webcods.in">WebCods</a></b>
		</div>
	</div>
</div>	
</footer>

</body>
</html>