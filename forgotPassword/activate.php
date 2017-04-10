<?php
function mailnewpassword($str){
    header('Location: http://androidapplication.esy.es/Online%20Exam%20Portal/forgotPassword/mailnewpassword.php?newpassword='+$str);
    exit;
}
function somethingwrong(){
    header('Location: http://androidapplication.esy.es/Online%20Exam%20Portal/Error.html');
    exit;
}
function wrongcode(){
    header('Location: http://androidapplication.esy.es/Online%20Exam%20Portal/WrongActivationCode.html');
    exit;
}
include '../database/dbconnect.php';
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
if(isset($_POST["submit"])){
    if($_POST["ActivationCode"]==$_COOKIE[$cookie_name2]){
        $password=generateRandomPassword();
        $querynewpassword="UPDATE ".$_COOKIE[$cookie_name3]." SET password='".$password."' WHERE email='".$_COOKIE[$cookie_name1]."'";
        if($con->query($querynewpassword) === TRUE) {
            mailnewpassword($password);
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
<!DOCTYPE html>
<html>
    <head>
        <title>Portal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
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
      <a class="navbar-brand" href="#">WebCods</a>
    </div>    
  </div>
</nav>
<br>
<br><br>
<form class="form-horizontal" method="post">    
        <label for="ActivationCode">Activation Code</label>
        <input type="number" class="form-control" id="ActivationCode" name="ActivationCode" placeholder="Enter your Activation Code">
        <input type="submit" name="submit" value="Submit">
</form>
    </body>
</html>
<?php
}
?>