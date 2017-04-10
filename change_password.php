<?php
session_start();

function getpassword(){
  $server     = 'mysql.hostinger.in';
  $username = 'u342164714_porta';
  $password = 'platicane';
  $database = 'u342164714_porta';
  $con=new mysqli($server,$username,$password,$database);

  if($con->connect_error)
  {
    echo "Error: could not establish database connection";
  }
  $getpassword="Select password from ".$_SESSION["table"]." where email='".$_SESSION["email"]."'";
  $result = $conn->query($sql);
  $password="";
  if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $password=$row["password"];
    }
  }
  return $password;
}
?><!DOCTYPE html>
<html>
<head>
  <title>Change Password</title>
      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<!--Navbar-->
<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="color: white;">WebCods</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="faculty_page.php" style="color: white;">Home</a></li>
        <li><a href="faculty_profile.php" style="color: white;">Profile</a></li>
        <li><a href="change_password.php" style="color: white;">Change Password</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">Academics<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="provide_assignments.php" style="color: black;">Assignments</a></li>
            <li><a href="alter_noticeboard.php" style="color: black;">NoticeBoard</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header" style="color: black;">Alter Mock Tests</li>
            <li><a href="alter_mock_test.php" style="color:black;">Create a Mock test</a></li>
          </ul>
        </li>
        <li><a href="database/logout.php" style="color: white;">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- Fixed navbar -->
<?php
if(isset($_POST["submit"])){
  if($_POST["oldpassword"]==getpassword()){
    $querynewpassword="UPDATE ".$_SESSION["table"]." SET password='".$_POST["newpassword"]."' WHERE email='".$_SESSION["email"]."'";
    if($con->query($querynewpassword) === TRUE){
      echo "<h1 style='margin-top:5%;margin-left:5%'>Password has been changed.</h1>";
    }
    else{
      echo "<h1 style='margin-top:5%;margin-left:5%'>something went wrong.</h1>";
    }
  }
  else{
    echo "<h1 style='margin-top:5%;margin-left:5%'>Wrong Password entered.</h1>";
  }
}
else{
?>
<form class="form-inline" style="float: right;margin-right: 12%;" method="post">
<input type="password" name="newpassword" class="form-control" placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required=""><br><br>
<input type="password" name="oldpassword" class="form-control" placeholder="Old Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required=""><br><br>
<input type="submit" name="submit" value="Submit" class="btn btn-success">
</form>
<?php
}
?>
</body>
</html>