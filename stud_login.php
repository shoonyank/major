<!DOCTYPE html>
<html>
<head>
	<title>Student Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
  #abc:hover{
    font-family: Monotype Corsiva;
    font-size: large;
  }
  .con{
    margin-top: 15%;
    margin-left: 29%;
    width: 40%;
  }
  @media screen and (max-width: 450px) {
    .con {
        margin-top: 40%;
        margin-left: 20%;
        width: 62%;
    }
}
#forgot_password{

}
@media screen and (max-width: 950px) {
    #forgot_password{
      margin-top: 2%;
  }
}
body {
        background-image: url('./img/stufac.jpg');
    }
@media screen and (max-width: 950px) {
    body {
        background-image: url('./img/stufac1.jpg');
    }
}
</style>
</head>
<body style="background-repeat: no-repeat;background-size: cover;">
<!--Navbar-->
<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #335571;border-color: transparent; ">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="color: white;">WebCods</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse" style="border-color: transparent;">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="index.php">Home</a></li>        
        <li class="dropdown">
          <a id="abc" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" style="background-color:#335571; color:white; " aria-haspopup="true" aria-expanded="false">Login <span class="caret"></span></a>
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

<div class="container con" style="background-color: #335571;border-radius: 25px;">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			
<!--Login Form-->
<form action="database/student_login.php" method="POST" style="margin-left: 0%;margin-right: 0%;margin-top: 2%;margin-bottom: 2%;">
<legend style="color:white">Student Login</legend>
	<input type="Email" name="email" class="form-control" placeholder="Email" id="loginput1"><br>
	<input type="password" name="password" class="form-control" placeholder="Password" id="loginput2"><br>
	<input type="submit" name="login" class="btn btn-success" value="Login">
  <a href="forgot_password.php"><input id="forgot_password" type="button" class="btn btn-success" value="Forgot Password"></a>
</form>
<!--/Login Form-->

		</div>
	</div>
</div>
</body>
</html>