<?php
session_start();
?>
<!DOCTYPE html>
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
        <?php
        include './navbar.php';
        ?>
<!-- Fixed navbar -->
<?php
if(isset($_POST["submit"])){
  $server     = 'mysql.hostinger.in';
  $username = 'u342164714_porta';
  $password = 'platicane';
  $database = 'u342164714_porta';
  $con=new mysqli($server,$username,$password,$database);
  if($con->connect_error)
  {
    echo "Error: could not establish database connection";
  }
  $getpassword="Select password from student_details where fid='".$_SESSION["sid"]."'";
  $result = $con->query($getpassword);
  $password="";
  if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $password=$row["password"];
    }
  }
  if($_POST["oldpassword"]==$password){
    $querynewpassword="UPDATE student_details SET password='".$_POST["newpassword"]."' WHERE sid=".$_SESSION["sid"];
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
<form class="form-inline" style="float: right;margin-right: 12%;margin-top:5%;" method="post">
<input type="password" name="newpassword" class="form-control" placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required=""><br><br>
<input type="password" name="oldpassword" class="form-control" placeholder="Old Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required=""><br><br>
<input type="submit" name="submit" value="Submit" class="btn btn-success">
</form>
<?php
}
?>
</body>
</html>