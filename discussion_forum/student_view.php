<?php
session_start();
include 'dbconnect.php';

if($con->connect_error)
{
  echo "Error: could not establish database connection";
}
if(isset($_SESSION["sid"])){
}
else{
  exit("Please Sign In to continue");
}
function getpages(){
  include 'dbconnect.php';
  $query="Select count(distinct page) as pages from questions where shown_to='student'";
  $result=$con->query($query);
  $totalpages=0;
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $totalpages=$row["pages"];
    }
  }
  return $totalpages;
}
$totalpages=getpages();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    /* make sidebar nav vertical */ 
  @media (min-width: 768px) {
    .sidebar-nav .navbar .navbar-collapse {
      padding: 0;
      max-height: none;
    }
    .sidebar-nav .navbar ul {
      float: none;
      display: block;
    }
    .sidebar-nav .navbar li {
      float: none;
      display: block;
    }
    .sidebar-nav .navbar li a {
      padding-top: 12px;
      padding-bottom: 12px;
    }
  }
  #form1, #form2, #form3, #form4, #form5{
    visibility: hidden;
  }
  #form11, #form22, #form33, #form44, #form55{
    visibility: hidden;
  }
  </style>
  <script type="text/javascript">
    function fetchquestions(no,q){
      var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                data=JSON.parse(this.responseText);
                if (!$.trim(data)){   
                  document.getElementById("q"+no).innerHTML="";
                }
                else{
                switch(no){
                  case 0:
                    document.getElementById("q1").value = q;
                    document.getElementById("form1").style.visibility = "visible";
                    document.getElementById("q11").value = q;
                    document.getElementById("form11").style.visibility = "visible";
                    document.getElementById("prime_tag1").innerHTML = data.prime_tag;
                    document.getElementById("question1").innerHTML = data.question;
                    document.getElementById("timestamp1").innerHTML = data.timestamp;
                    document.getElementById("postby1").innerHTML = data.posted_by;
                  break;
                  case 1:
                    document.getElementById("q2").value = q;
                    document.getElementById("form2").style.visibility = "visible";
                    document.getElementById("q22").value = q;
                    document.getElementById("form22").style.visibility = "visible";
                    document.getElementById("prime_tag2").innerHTML = data.prime_tag;
                    document.getElementById("question2").innerHTML = data.question;
                    document.getElementById("timestamp2").innerHTML = data.timestamp;
                    document.getElementById("postby2").innerHTML = data.posted_by;
                  break;
                  case 2:
                    document.getElementById("q3").value = q;
                    document.getElementById("form3").style.visibility = "visible";
                    document.getElementById("q33").value = q;
                    document.getElementById("form33").style.visibility = "visible";
                    document.getElementById("prime_tag3").innerHTML = data.prime_tag;
                    document.getElementById("question3").innerHTML = data.question;
                    document.getElementById("timestamp3").innerHTML = data.timestamp;
                    document.getElementById("postby3").innerHTML = data.posted_by;
                  break;
                  case 3:
                    document.getElementById("q4").value = q;
                    document.getElementById("form4").style.visibility = "visible";
                    document.getElementById("q44").value = q;
                    document.getElementById("form44").style.visibility = "visible";
                    document.getElementById("prime_tag4").innerHTML = data.prime_tag;
                    document.getElementById("question4").innerHTML = data.question;
                    document.getElementById("timestamp4").innerHTML = data.timestamp;
                    document.getElementById("postby4").innerHTML = data.posted_by;
                  break;
                  case 4:
                    document.getElementById("q5").value = q;
                    document.getElementById("form5").style.visibility = "visible";
                    document.getElementById("q55").value = q;
                    document.getElementById("form55").style.visibility = "visible";
                    document.getElementById("prime_tag5").innerHTML = data.prime_tag;
                    document.getElementById("question5").innerHTML = data.question;
                    document.getElementById("timestamp5").innerHTML = data.timestamp;
                    document.getElementById("postby5").innerHTML = data.posted_by;
                  break;
                }
              }
            }
        };
        xmlhttp.open("GET", "showquestion.php?fname=fetchquestion&q=" + q, true);
        xmlhttp.send();
    }
    function showquestion(a){
      var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                data=JSON.parse(this.responseText);
                if (!$.trim(data)){   
                  document.getElementById("main_content").innerHTML="";
                  document.getElementById("nothin").innerHTML="No questions to show.";
                }
                else{
                  fetchquestions(0,data[0]);
                  fetchquestions(1,data[1]);
                  fetchquestions(2,data[2]);
                  fetchquestions(3,data[3]);
                  fetchquestions(4,data[4]);
                }
            }
        };
        xmlhttp.open("GET", "showquestion.php?fname=getqid&a="+a+"&snf=student", true);
        xmlhttp.send();
    }
  </script>
</head>
<body onload="showquestion(1)">
        <!-- Fixed navbar -->
<?php
  include 'navbar.php';
?>
<!--Navbar-->

<!--Vertical Navbar-->
<div class="container" style="margin-top: 5%;">
<div class="row">
  <div class="col-sm-3">
    <div class="sidebar-nav">
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="visible-xs navbar-brand">Sidebar menu</span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="student_view.php">New Questions</a></li>
            <li><a href="yourquestion.php">Submit a question</a></li>
            <li><a href="#">Total Questions <span class="badge">
            <?php
              $total;
              $query="Select count(qid) from questions where shown_to='student'";
              $result = $con->query($query);
              if ($result->num_rows > 0) {    
                  while($row = $result->fetch_assoc()) {
                      $total=$row["count(qid)"];
                  }
              }
              echo $total;
            ?>              
            </span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>  
  <h3 id='nothin'></h3>
  <div class="col-sm-9" id="main_content">
      <div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-body"><p id="question1"></p>
    <form method="get" action="insert_answer.php" id="form1">
      <input type="hidden" name="q" id="q1">
      <input type="text" name="answer" placeholder="Your Answer">
      <input type="Submit" name="submit">
    </form>
    <br>
    <form method="get" action="show_answers.php" id="form11">
      <input type="hidden" name="q" id="q11">
      <input type="submit" name="submit" value="View All Answers" class="btn btn-primary">
    </form>
    <br>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-body"><p id="prime_tag1"></p><p id="timestamp1"></p><p id="postby1"></p></div>
  </div>
</div>
<!--q2-->
<div id="q2">
<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-body"><p id="question2"></p>
    <form method="get" action="insert_answer.php" id="form2">
      <input type="hidden" name="q" id="q2">
      <input type="text" name="answer" placeholder="Your Answer">
      <input type="Submit" name="submit">
    </form>
    <br>
    <form method="get" action="show_answers.php" id="form22">
      <input type="hidden" name="q" id="q22">
      <input type="submit" name="submit" value="View All Answers" class="btn btn-primary">
    </form>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-body"><p id="prime_tag2"></p><p id="timestamp2"></p><p id="postby2"></p></div>
  </div>
</div>
</div>
<!--q3-->
<div id="q3">
<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-body"><p id="question3"></p>
    <form method="get" action="insert_answer.php" id="form3">
      <input type="hidden" name="q" id="q3">
      <input type="text" name="answer" placeholder="Your Answer">
      <input type="Submit" name="submit">
    </form>
    <br>
    <form method="get" action="show_answers.php" id="form33">
      <input type="hidden" name="q" id="q33">
      <input type="submit" name="submit" value="View All Answers" class="btn btn-primary">
    </form>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-body"><p id="prime_tag3"></p><p id="timestamp3"></p><p id="postby3"></p></div>
  </div>
</div>
</div>
<!--q4-->
<div id="q4">
<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-body"><p id="question4"></p>
    <form method="get" action="insert_answer.php" id="form4">
      <input type="hidden" name="q" id="q4">
      <input type="text" name="answer" placeholder="Your Answer">
      <input type="Submit" name="submit">
    </form>
    <br>
    <form method="get" action="show_answers.php" id="form44">
      <input type="hidden" name="q" id="q44">
      <input type="submit" name="submit" value="View All Answers" class="btn btn-primary">
    </form>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-body"><p id="prime_tag4"></p><p id="timestamp4"></p><p id="postby4"></p></div>
  </div>
</div>
</div>
<!--q5-->
<div id="q5">
<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-body"><p id="question5"></p>
      <form method="get" action="insert_answer.php" id="form5">
      <input type="hidden" name="q" id="q5">
      <input type="text" name="answer" placeholder="Your Answer">
      <input type="Submit" name="submit">
    </form>
    <br>
    <form method="get" action="show_answers.php" id="form55">
      <input type="hidden" name="q" id="q55">
      <input type="submit" name="submit" value="View All Answers" class="btn btn-primary">
    </form>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-body"><p id="prime_tag5"></p><p id="timestamp5"></p><p id="postby5"></p></div>
  </div>
</div>
</div>
</div>
</div>
<!--Vertical Navbar-->
<!--Go to page-->
    <ul class="pagination">
      <?php
      for ($i=1; $i <= $totalpages; $i++) { 
        echo "<li><a href='#' onclick='showquestion(".$i.")'>".$i."</a></li>";
      }
      ?>
    </ul>
  </body>
</html>