<?php
function gotoindex(){
    header('Location: http://androidapplication.esy.es/Online%20Exam%20Portal/index.php');
    exit;
}
function wrongcode(){
    header('Location: http://androidapplication.esy.es/Online%20Exam%20Portal/WrongActivationCode.html');
    exit;
}
function mailnewpassword($str){
    header('Location: http://androidapplication.esy.es/Online%20Exam%20Portal/forgotPassword/mailnewpassword.php?newpassword='+$str);
    exit;
}
function somethingwrong(){
    header('Location: http://androidapplication.esy.es/Online%20Exam%20Portal/Error.html');
    exit;
}
function generateRandomPassword(){
    $SMALLalphabets = array("a", "b", "c","d", "e", "f","g", "h", "i","j", "k", "l","m", "n", "o","p", "q", "r","s", "t", "u","v", "w", "x","y","z");
    $BIGalphabets = array("A", "B", "C","D", "E", "F","G", "H", "I","J", "K", "L","M", "N", "O","P", "Q", "R","S", "T", "U","V", "W", "X","Y","Z");
    $specialcharacters= array("!","@","#","$","%","/","?","&","=","-");
    $numbers= array("0","1","2","3","4","5","6","7","8","9");
    $one=$SMALLalphabets[rand(0,25)];
    $one .=$BIGalphabets[rand(0,25)];
    $one .=$specialcharacters[rand(0,9)];
    $one .=$BIGalphabets[rand(0,25)];
    $one .=$SMALLalphabets[rand(0,25)];
    $one .=$BIGalphabets[rand(0,25)];
    $one .=$specialcharacters[rand(0,9)];
    $one .=$numbers[rand(0,9)];
    $one .=$SMALLalphabets[rand(0,25)];
    return $one;
}
$email="";
$table="";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
<?php
$code;
$activation_code=rand(1000, 9999);
  if(isset($_POST["submit"])){
    // include page which will mail authentication code and set cookie values of email and table
    $table=$_POST["table"];
    $email=$_POST["email"];
    $to=$email;
    $subject='Authentication Code';
    $message='<h1>Your authentication code is '.$activation_code.'</h1>';
    $headers="From:www.webcods.in\r\n";
    $headers .="Reply-To:reply@webcods.in\r\n";
    $headers .="Content-type:text/html\r\n";
    $code=$activation_code;
    mail($to,$subject,$message,$headers);
    ?>
    <form method="post" style="margin-top: 5%;margin-left: 5%;">
      <input type="number" name="code" placeholder="Enter Authentication Code sent to your mail id" required="" >
      <input type="Submit" name="submit1" value="Submit">
    </form>
    <?php

      
  }
  else if(isset($_POST["submit1"])){
    if($_POST["code"]==$code){
      /*code is right, update password and send to mail new password*/
      $password=generateRandomPassword();
        $querynewpassword="UPDATE ".$table." SET password='".$password."' WHERE email='".$email."'";
        if($con->query($querynewpassword) === TRUE) {
          $to=$_COOKIE[$cookie_name1];
          $subject='Authentication Code';
          $message='<h1>Your new password is '.$password.'</h1>';
          $headers="From:www.webcods.in\r\n";
          $headers .="Reply-To:noreply@webcods.in\r\n";
          $headers .="Content-type:text/html\r\n";
          mail($to,$subject,$message,$headers);
          gotoindex();
        }
      else{
          somethingwrong();
        }
      }
      else{        
        wrongcode();
      }
  }
  else{
?>

<!--/Navbar-->
<form method="post" style="margin-top: 5%;margin-left: 5%;">
	<input type="Email" name="email" placeholder="Email ID" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="" >
	<select name="table" id="table">
  		<option value="faculty">Faculty</option>
  		<option value="student_details">Student</option>
    </select>
    <input type="Submit" name="submit" value="Submit">
</form>
</body>
</html>
<?php
}
?>